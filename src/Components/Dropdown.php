<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Dropdown extends VitrineComponent
{
    public int|string $headingLevel;

    public ?string $ariaLabel;

    public ?string $label;

    public string $listlabelId;

    protected static array $assets = [
        'js' => 'behaviors/Dropdown.js',
    ];

    public function __construct(
        int|string $headingLevel = 3,
        string $ariaLabel = null,
        string $label = null,
        array $ui = []
    )
    {
        $this->headingLevel = $headingLevel;
        $this->label = $label ?? __('fe.select_an_option');
        $this->ariaLabel = $ariaLabel ?? $label;
        $this->listlabelId = 'DropdownLabel'. Str::random(5);
        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.dropdown.dropdown');
    }
}
