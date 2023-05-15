<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Datepicker extends VitrineComponent
{
    /** @var string */
    public $target;

    /** @var string */
    public $align;

    /** @var bool */
    public $range;

    /** @var string */
    public $minDate;

    /** @var string */
    public $maxDate;

    /** @var bool */
    public $showLabel;

    protected static $assets = [
        'npm' => ['wc-datepicker', 'focus-trap'],
        'js' => 'behaviors/Datepicker.js',
        'css' => 'components/date-picker.css',
    ];

    public function __construct(
        $target = '',
        $align = 'right',
        $range = false,
        $minDate = '',
        $maxDate = '',
        $showLabel = false,
    )
    {
        $this->target = $target;
        $this->align = $align;
        $this->range = $range;
        $this->minDate = $minDate;
        $this->maxDate = $maxDate;
        $this->showLabel = $showLabel;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.datepicker.datepicker');
    }
}
