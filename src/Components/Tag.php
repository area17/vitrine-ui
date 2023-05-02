<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Tag extends VitrineComponent
{
    /** @var string */
    public $href;

    /** @var bool */
    public $active;

    /** @var bool */
    public $cancellable;

    public function __construct(
        $href = null,
        $active = false,
        $cancellable = false,
    )
    {
        $this->href = $href;
        $this->active = $active;
        $this->cancellable = $cancellable;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.tag.tag');
    }
}
