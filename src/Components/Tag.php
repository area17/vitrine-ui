<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Tag extends VitrineComponent
{
    public ?string $href;

    public bool $active;

    public bool $cancellable;

    public bool $static;

    public function __construct(
        ?string $href = null,
        bool $active = false,
        bool $cancellable = false,
        array $ui = [],
        bool $static = false,
    ) {
        $this->href = $href;
        $this->active = $active;
        $this->cancellable = $cancellable;
        $this->static = $static;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.tag.tag');
    }
}
