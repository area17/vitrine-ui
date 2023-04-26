<?php

namespace A17\VitrineUI\Components;

use Illuminate\View\Component;

abstract class VitrineComponent extends Component
{
    /** @var array */
    protected static $assets = [];

    public static function assets(): array
    {
        return static::$assets;
    }
}
