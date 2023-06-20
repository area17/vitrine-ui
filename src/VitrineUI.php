<?php

namespace A17\VitrineUI;

use Exception;
use Illuminate\Support\Arr;

class VitrineUI
{
    /**
     * @throws Exception
     */
    public static function setPrefixedClass($classes = []): string
    {
        if(!is_array($classes) && !is_string($classes)) {
            throw new Exception('setPrefixedClass() expects an array of string or a string');
        }

        $classes = Arr::wrap($classes);

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
