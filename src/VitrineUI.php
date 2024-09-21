<?php

namespace A17\VitrineUI;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use TailwindMerge\Laravel\Facades\TailwindMerge;


class VitrineUI
{
    /**
     * Get global Vitrine theme from local configuration and external config file
     * @return array
     */
    public static function getBaseVitrineTheme(): array
    {
        return once(function () {
            $baseUIPath = __DIR__ . '/../resources/frontend/theme/vitrine-ui.json';

            $ui = [];

            if (file_exists($baseUIPath)) {
                $ui = json_decode(file_get_contents($baseUIPath), true);
            }

            // load global custom theme
            $vitrine_path = self::removeTrailingSlash(config('vitrine-ui.vitrine_path', ''));
            $theme_path = $vitrine_path . '/' . config('vitrine-ui.theme_file');

            if (file_exists($theme_path)) {
                $theme = json_decode(file_get_contents($theme_path), true);
                if (is_array($theme)) {
                    $ui = array_replace_recursive($ui, $theme);
                }
            }

            return $ui;
        });
    }

    /**
     * Get and merge specific custom component preset from local and custom config file
     * @param array $ui
     * @param string $component
     * @return array
     * @throws Exception
     */
    private static function getComponentPreset(array $ui, string $component): array
    {
        return once(function () use ($ui, $component) {
            // load local component
            if (!$component) {
                throw new Exception('Component name is required');
            }

            $baseComponentPath = __DIR__ . '/../resources/frontend/theme/components/' . $component . '.json';
            if (file_exists($baseComponentPath)) {
                $baseComponent = json_decode(file_get_contents($baseComponentPath), true);
                if (is_array($baseComponent)) {
                    $ui[$component] = $baseComponent;
                }
            }

            // load specific custom component preset file
            $vitrine_path = self::removeTrailingSlash(config('vitrine-ui.vitrine_path', ''));
            $custom_component_path = $vitrine_path . '/' . $component . '.json';

            if (file_exists($custom_component_path)) {
                $component_theme = json_decode(file_get_contents($custom_component_path), true);
                if (is_array($component_theme)) {
                    $ui = self::mergeOrReplaceComponentPreset($ui, $component, $component_theme);
                }
            }

            return $ui;
        });
    }

    /**
     * Return classes associated to specified component and keys
     * @param string|null $component string required - Request component ui
     * @param $keys array|string (optional) - Keys to use for applying component tokens
     * @param $options array (optional) - key/value array for applying specific variants tokens: ex ['size' => 'sm', 'variant' => 'primary']
     * @param $customUI array|null (optional) - External theme merged with current theme
     * @return string
     * @throws Exception
     */
    public static function ui(?string $component, array|string $keys = 'base', array $options = [], array $customUI = null): string
    {
        if (!isset($component)) {
            throw new Exception('Component name is required');
        }

        $ui = self::getBaseVitrineTheme();

        // TBD: Should we do that per component or should we preload all custom and local components?
        $ui = self::getComponentPreset($ui, $component);

        // add local component preset passed by props
        if (is_array($customUI)) {
            $ui = self::applyCustomUiProps($ui, $customUI);
        }

        $uiComponent = $ui[$component] ?? false;
        $classes = [];

        if ($uiComponent) {
            // Set classes from keys
            // Set classes from keys
            $keys = Arr::wrap($keys);
            foreach ($keys as $key) {
                $key = (string)$key;
                if ($key && ($uiComponent[$key] ?? false)) {
                    $classes[] = is_array($uiComponent[$key]) ? join(' ', $uiComponent[$key]) : $uiComponent[$key];
                }
            }

            foreach ($options as $option => $value) {
                // set classes from options
                if ($value ?? null) {
                    $value = (string)$value;
                }

                if ($value && ($uiComponent[$option][$value] ?? false)) {
                    if (is_array($uiComponent[$option][$value])) {
                        $classes[] = join(' ', $uiComponent[$option][$value]);
                    } else {
                        $classes[] = $uiComponent[$option][$value];
                    }
                } else {
                    // fallback to default value if exists
                    $defaultValue = $uiComponent['default'][$option] ?? false;
                    if ($defaultValue && ($uiComponent[$option][$defaultValue] ?? false)) {
                        if (is_array($uiComponent[$option][$defaultValue])) {
                            $classes[] = join(' ', $uiComponent[$option][$defaultValue]);
                        } else {
                            $classes[] = $uiComponent[$option][$defaultValue];
                        }
                    }
                }
            }
        }

        return join(' ', $classes);
    }

    /**
     * @throws Exception
     */
    public static function setPrefixedClass($classes = []): string
    {
        if (!is_array($classes) && !is_string($classes)) {
            throw new Exception('setPrefixedClass() expects an array of string or a string');
        }

        $classes = Arr::wrap($classes);

        $prefix = config('vitrine-ui.css_class_prefix', '');
        $prefix = $prefix ? "{$prefix}-" : '';

        $class = '';

        foreach ($classes as $key => $value) {
            if (is_int($key)) {
                $class .= $prefix . $value . ' ';
            } else if (isset($value) && $value) {
                $class .= $prefix . $key . ' ';
            }
        }

        return trim($class);
    }

    public static function removeTrailingSlash($string = '')
    {
        return once(function () use ($string) {
            if (Str::endsWith($string, '/')) {
                $string = Str::replaceLast('/', '', $string);
            }

            return $string;
        });
    }

    public static function isExternalUrl($url): bool
    {
        return once(function () use ($url) {
            $url = (string)$url;

            if (blank($url)) {
                return false;
            }

            if (Str::startsWith($url, ['#', '/'])) {
                return false;
            }

            $home = url('/');

            if (Str::startsWith($url, $home)) {
                return false;
            }

            return true;
        });
    }

    public static function setAttributes(array $attributes): string
    {

        return implode(' ', array_map(
            function ($v, $k) {
                if (is_array($v)) {
                    return $k . '[]=' . implode('&' . $k . '[]=', $v);
                } else {
                    return $k .'=' .'"'.$v.'"';
                }
            },
            $attributes,
            array_keys($attributes)
        ));
    }

    private static function applyCustomUiProps(array $ui, array $customUI)
    {
        return once(function () use ($ui, $customUI) {
            if(is_array($customUI)) {
                foreach ($customUI as $key => $theme) {
                    $ui = self::mergeOrReplaceComponentPreset($ui, $key, $theme);
                }
            }
            return $ui;
        });
    }

    private static function mergeOrReplaceComponentPreset($ui, $component, $component_theme): array
    {
        if ($component_theme['rules']['merge'] ?? false) {
            foreach ($component_theme as $key => $value) {
                if ($key !== 'rules') {
                    if (in_array($key, $component_theme['rules']['merge'] ?? [])) {
                        // merge
                        $val = is_array($value) ? join(' ', $value) : $value;
                        $existingVal = isset($ui[$component]) && is_array($ui[$component][$key] ?? []) ? join(' ', $ui[$component][$key]) : $ui[$component][$key] ?? '';
                        if (config('vitrine-ui.css_preset', 'tailwindcss') === 'tailwindcss') {
                            $ui[$component][$key] = TailwindMerge::merge($existingVal, $val);
                        } else {
                            $ui[$component][$key] = $existingVal . ' ' . $val;
                        }
                    } else {
                        // replace value
                        $val = is_array($value) ? join(' ', $value) : $value;
                        $ui[$component][$key] = $val;
                    }
                }
            }
        } else {
            $ui[$component] = array_replace_recursive($ui[$component] ?? [], $component_theme);
        }

        return $ui;
    }

    /**
     * Return component preset from config file
     * @param string|null $component string required - Request component ui
     * @return array
     * @throws Exception
     */
    public static function getComponentConfig(?string $component): array
    {
        if (!isset($component)) {
            throw new Exception('Component name is required');
        }

        $ui = self::getBaseVitrineTheme();

        return self::getComponentPreset($ui, $component);
    }

}
