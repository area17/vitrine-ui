<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\VitrineUI;
use Illuminate\Support\Str;
use Illuminate\View\Component;

abstract class VitrineComponent extends Component
{
    /** @var array */
    protected static array $assets = [];

    public static function assets(): array
    {
        return static::$assets;
    }

    /** @var array */
    protected array $ui = [];

    /** @var string|null */
    protected $uiComponentName;

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

    public function ui($component, $key = 'base', $options = [], ): string
    {
        return VitrineUI::ui($component, $key, $options, $this->ui);
    }
}
