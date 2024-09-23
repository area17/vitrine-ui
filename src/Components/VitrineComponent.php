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

    public array $ui = [];

    public function __construct(array $ui = [])
    {
        $this->ui = $ui;
    }

    public function isExternalUrl(?string $url): bool
    {
        return VitrineUI::isExternalUrl($url);
    }

    public function ui(?string $component, array|string $key = 'base', array $options = []): string
    {
        try {
            return VitrineUI::ui($component, $key, $options, $this->ui);
        } catch (\Exception $e) {
            report($e);

            return '';
        }
    }

    public function preset(?string $component): array
    {
        try {
            return VitrineUI::getComponentConfig($component);
        } catch (\Exception $e) {
            report($e);

            return [];
        }
    }

    public function setAttributes(array $attributes): string
    {
        return VitrineUI::setAttributes($attributes);
    }
}
