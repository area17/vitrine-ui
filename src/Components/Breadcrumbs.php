<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Breadcrumbs extends VitrineComponent
{
    /** @var array */
    public $items;

    /** @var string */
    public $tag;

    public function __construct(
        $tag = 'nav',
        $items = null,
        $ui = []
    )
    {
        $this->tag = $tag;
        $this->items = $items;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.breadcrumbs.breadcrumbs');
    }
}
