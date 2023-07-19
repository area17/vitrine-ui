<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Dropdown extends VitrineComponent
{
    /** @var int */
    public $headingLevel;

    /** @var string */
    public $ariaLabel;

    /** @var string */
    public $label;

    /** @var string */
    public $listlabelId;

    protected static array $assets = [
        'js' => 'behaviors/Dropdown.js',
    ];

    public function __construct(
        $headingLevel = 3,
        $ariaLabel = null,
        $label = null,
        $ui = []
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
