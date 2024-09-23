<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Accordion extends VitrineComponent
{
    public ?string $a11yLabel;

    public int $headingLevel;

    public bool $scrollOnOpen;

    public bool $exclusive;

    protected static array $assets = [
        'js' => 'behaviors/Accordion.js',
    ];

    public function __construct(
        ?string $a11yLabel = null,
        int $headingLevel = 3,
        bool $scrollOnOpen = false,
        bool $exclusive = false,
        array $ui = [],
    ) {
        $this->a11yLabel = $a11yLabel;
        $this->headingLevel = $headingLevel;
        $this->scrollOnOpen = $scrollOnOpen;
        $this->exclusive = $exclusive;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.accordion.accordion');
    }
}
