<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Card extends VitrineComponent
{
    /** @var array */
    public $variant;

    /** @var string */
    public $tag;

    public function __construct(
        $tag = 'article',
        $variant = null,
        $ui = []
    )
    {
        $this->tag = $tag;
        $this->variant = $variant;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.card.card');
    }
}
