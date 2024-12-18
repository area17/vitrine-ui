<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class CardLink extends VitrineComponent
{
    public ?string $href;

    public ?string $target;

    public string $tag;

    public function __construct(string $href = null, string $target = null, string $tag = null, array $ui = [])
    {
        $this->href = $href;
        $this->tag = $tag ? $tag : (empty($href) ? 'span' : 'a');

        $isExternalUrl = $this->isExternalUrl($href);
        $this->target = $target ?? $isExternalUrl ? '_blank' : false;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.card.link');
    }
}
