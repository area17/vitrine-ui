<?php

namespace A17\VitrineUI\Components;

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
        string $ariaLabel = null,
        int $selectedIndex = 0,
        string $tabListId = null,
        string $tabButtonVariant = 'primary',
        array $tabsNames = [],
        string $name = '',
        array $ui = [],
    ) {
        $this->name = $name . '_tab';
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
