<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\VitrineUI;
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

    public function __construct($ui = [])
    {
        $this->ui = $ui;
    }

    public function isExternalUrl($url): bool
    {
        return VitrineUI::isExternalUrl($url);
    }

    public function ui($component, $key = 'base', $options = [], ): string
    {
        try {
            return VitrineUI::ui($component, $key, $options, $this->ui);
        } catch (\Exception $e) {
            report($e);
            return '';
        }
    }

    public function setAttributes($attributes): string
    {
        return VitrineUI::setAttributes($attributes);
    }
}
