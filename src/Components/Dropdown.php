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
    public $label;

    /** @var string */
    public $listlabelId;

    public function __construct(
        $headingLevel = 3,
        $label = null,
    )
    {
        $this->headingLevel = $headingLevel;
        $this->label = $label ?? __('fe.select_an_option');
        $this->listlabelId = 'DropdownLabel'. Str::random(5);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.dropdown.dropdown');
    }
}
