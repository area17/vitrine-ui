<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Datepicker extends VitrineComponent
{
    public ?string $target;

    public ?string $align;

    public bool $range;

    public ?string $minDate;

    public ?string $maxDate;

    public bool $showLabel;

    protected static array $assets = [
        'npm' => ['wc-datepicker', 'focus-trap'],
        'js' => 'behaviors/Datepicker.js',
        'css' => 'components/date-picker.css',
    ];

    public function __construct(
        string $target = null,
        string $align = 'right',
        bool $range = false,
        string $minDate = null,
        string $maxDate = null,
        bool $showLabel = false,
        array $ui = [],
    ) {
        $this->target = $target;
        $this->align = $align;
        $this->range = $range;
        $this->minDate = $minDate;
        $this->maxDate = $maxDate;
        $this->showLabel = $showLabel;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.datepicker.datepicker');
    }
}
