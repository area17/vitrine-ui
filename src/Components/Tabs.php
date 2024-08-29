<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use Illuminate\View\View;

class Tabs extends VitrineComponent
{
    public ?string $ariaLabel;

    public ?string $title;
    public int $titleLevel = 3;


    public int $startIndex = 0;

    public array $tabsNames = [];
    public ?string $name;

    public ?string $tabButtonVariant;

    public string $tabListId;

    public function __construct(
        $ariaLabel = null,
        $tabsNames = [],
        $startIndex = 0,
        $name = '',
        $title = null,
        $titleLevel = 3,
        $tabButtonVariant = 'primary',
        $ui = []
    )
    {
        $this->ariaLabel = $ariaLabel;
        $this->startIndex = $startIndex;
        $this->name = $name;
        $this->title = $title;
        $this->titleLevel = min(6, max(1, $titleLevel));
        $this->tabListId = 'tabs-' . Str::random(6);
        $this->tabsNames = $tabsNames;
        $this->tabButtonVariant = $tabButtonVariant;

        parent::__construct($ui);
    }

    public function shouldRender(): bool
    {
        return count($this->tabsNames) > 0;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.tabs.tabs');
    }
}
