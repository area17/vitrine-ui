<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Breadcrumbs extends VitrineComponent
{
    /** @var array */
    public $items;

    public function __construct(
        $items = null,
    )
    {
        $this->items = $items;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.breadcrumbs.breadcrumbs');
    }
}
