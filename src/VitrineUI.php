<?php

namespace A17\VitrineUI;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;

class VitrineUI
{
    public static function ui($component, $keys = 'base', $options = [], $customUI = null): string
    {
        if (!isset($component)) {
            throw new Exception('Component name is required');
        }

        // fixme: $ui array should be already build and cached
        $baseUIPath = __DIR__ . '/../resources/frontend/vitrine-ui.json';

        $ui = [];
        $classes = [];

        if (file_exists($baseUIPath)) {
            $ui = json_decode(file_get_contents($baseUIPath), true);
        }

        // load global custom theme
        $vitrine_path = self::removeTrailingSlash(config('vitrine-ui.vitrine_path', ''));
        $theme_path = $vitrine_path . '/' . config('vitrine-ui.theme_file');

        if (file_exists($theme_path)) {
            $theme = json_decode(file_get_contents($theme_path), true);
            $ui = array_replace_recursive($ui, $theme);
        }

        // load specific custom component preset file
        if ($component && ($ui[$component] ?? false)) {
            $custom_component_path = $vitrine_path . '/' . $component . '.json';
            if (file_exists($custom_component_path)) {
                $component_theme = json_decode(file_get_contents($custom_component_path), true);
                $ui[$component] = array_replace_recursive($ui[$component], $component_theme);
            }
        }

        // add local component preset passed by props
        if (is_array($customUI)) {
            $ui = array_replace_recursive($ui, $customUI);
        }

        $uiComponent = $ui[$component] ?? false;

        if ($uiComponent) {
            // Set classes from keys
            $keys = Arr::wrap($keys);
            foreach ($keys as $key) {
                if ($key && ($uiComponent[$key] ?? false)) {
                    $classes[] = $uiComponent[$key];
                }
            }

            foreach ($options as $option => $value) {
                // set classes from options
                if ($value && ($uiComponent[$option][$value] ?? false)) {
                    $classes[] = $uiComponent[$option][$value];
                } else {
                    // fallback to default value if exists
                    $defaultValue = $uiComponent['default'][$option] ?? false;
                    if ($defaultValue && ($uiComponent[$option][$defaultValue] ?? false)) {
                        $classes[] = $uiComponent[$option][$defaultValue];
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
        if (Str::endsWith($string, '/')) {
            $string = Str::replaceLast('/', '', $string);
        }

        return $string;
    }
}
