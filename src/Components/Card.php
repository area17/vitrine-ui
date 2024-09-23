<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Card extends VitrineComponent
{
    public ?string $variant;

    public ?string $tag;

    public function __construct(string $tag = 'article', string $variant = null, array $ui = [])
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
