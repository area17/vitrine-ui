<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Breadcrumbs extends VitrineComponent
{
    public array $items;

    public string $tag;

    public function __construct(?string $tag = 'nav', array $items = [], array $ui = [])
    {
        $this->tag = $tag;
        $this->items = $items;

        parent::__construct($ui);
    }

    public function shouldRender(): bool
    {
        return count($this->items) > 0;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.breadcrumbs.breadcrumbs');
    }
}
