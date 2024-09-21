<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class CardLink extends VitrineComponent
{

    public ?string $href;

    public ?string $target;

    public string $tag;

    public function __construct(
        $href = null,
        $target = null,
        $tag = null,
        $ui = []
    )
    {
        $this->href = $href;
        $this->tag = $tag ?? empty($href) ? 'span' : 'a';

        $isExternalUrl = $this->isExternalUrl($href);
        $this->target = $target ?? $isExternalUrl ? '_blank' : false;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.card.link');
    }
}
