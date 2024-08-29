<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use Illuminate\View\View;

class TabList extends VitrineComponent
{
    public ?string $ariaLabel;

    public int $selectedIndex = 0;

    public array $tabsNames = [];

    public ?string $tabButtonVariant;

    public ?string $tabListId;
    public ?string $name;

    public function __construct(
        $ariaLabel = null,
        $selectedIndex = 0,
        $tabListId = null,
        $tabButtonVariant = 'primary',
        $tabsNames = [],
        $name = '',
        $ui = []
    )
    {
        $this->name = $name.'_tab';
        $this->ariaLabel = $ariaLabel;
        $this->selectedIndex = $selectedIndex;
        $this->tabListId = $tabListId;
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
        return view('vitrine-ui::components.tabs.tablist');
    }
}
