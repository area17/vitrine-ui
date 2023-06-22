<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Accordion extends VitrineComponent
{
    /** @var string */
    public $a11yLabel;

    /** @var int */
    public $headingLevel;

    /** @var bool */
    public $scrollOnOpen;

    protected static array $assets = [
        'js' => 'behaviors/Accordion.js',
        'css' => 'components/accordion.css',
    ];

    public function __construct(
        $a11yLabel = null,
        $headingLevel = 3,
        $scrollOnOpen = false,
    )
    {
        $this->a11yLabel = $a11yLabel;
        $this->headingLevel = $headingLevel;
        $this->scrollOnOpen = $scrollOnOpen;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.accordion.accordion');
    }
}
