<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use Illuminate\View\Component;

abstract class VitrineComponent extends Component
{
    /** @var array */
    protected static $assets = [];

    public static function assets(): array
    {
        return static::$assets;
    }

    public function isExternalUrl($url): bool
    {
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
    }
}
