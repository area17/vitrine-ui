<?php

namespace A17\VitrineUI;

use Exception;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use function PHPUnit\Framework\isEmpty;

class VitrineUI
{
    public static function ui($component, $key = null, $options = []): string
    {
        // fixme: $ui array should be already build and cached
        $baseUIPath = __DIR__ . '/../resources/frontend/vitrine-ui.json';

        $ui = [];

        $classes = [];

        if (file_exists($baseUIPath)) {
            // todo: add merge with outside config file
            $ui = json_decode(file_get_contents($baseUIPath), true);
        }

        $uiComponent = $ui[$component] ?? false;

        if ($uiComponent) {
            // Set base / key
            if ($key && ($uiComponent[$key] ?? false)) {
                $classes[] = $uiComponent[$key];
            }

            foreach ($options as $option => $value) {
                if ($value && $uiComponent[$option][$value] ?? false) {
                    $classes[] = $uiComponent[$option][$value];
                } else {
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
}
