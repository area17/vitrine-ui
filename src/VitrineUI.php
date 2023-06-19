<?php

namespace A17\VitrineUI;

use Exception;

class VitrineUI
{
    /**
     * @throws Exception
     */
    public static function setPrefixedClass($classes = []): string
    {
        if(!is_array($classes) && !is_string($classes)) {
            throw new Exception('setPrefixedClass() expects an array or string');
        }

        $classes = is_string($classes) ? [$classes] : $classes;

        $prefix = config('vitrine-ui.css_class_prefix', '');
        $prefix = $prefix ? "{$prefix}-" : '';

        $class = '';

        foreach ($classes as $key => $value) {
            if(is_int($key)) {
                $class .= $prefix.$value.' ';
            } else if(isset($value) && $value) {
                $class .= $prefix.$key.' ';
            }
        }

        return trim($class);
    }
}
