<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class CardLink extends VitrineComponent
{

    /** @var string */
    public $href;

    /** @var string|bool */
    public $target;

    public $uiKeyComponent = 'card-link';

    /** @var string */
    public $tag;

    public function __construct(
        $href = null,
        $target = null,
        $size = null,
        $tag = null,
        $ui = []
    )
    {
        $this->href = $href;
        $this->size = $size;
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
