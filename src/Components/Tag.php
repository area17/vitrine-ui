<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Tag extends VitrineComponent
{
    public ?string $href;

    public bool $active;

    public bool $cancellable;

    public function __construct(
        ?string $href = null,
        bool $active = false,
        bool $cancellable = false,
        array $ui = []
    )
    {
        $this->href = $href;
        $this->active = $active;
        $this->cancellable = $cancellable;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.tag.tag');
    }
}
