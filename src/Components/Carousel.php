<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use Illuminate\View\View;

class Carousel extends VitrineComponent
{

    public ?string $configuration;

    public array $items = [];

    public string $itemClass = '';

    public ?string $component;

    public ?string $controlsButtonVariant;

    public bool $asList = false;
    public bool $withControls = true;
    public bool $withPagination = true;

    public function __construct(
        $items = [],
        $itemClass = '',
        $component = null,
        $configuration = null,
        $controlsButtonVariant = '',
        $asList = false,
        $withControls = true,
        $withPagination = true,
        $ui = []
    )
    {
        $this->component = $component;
        $this->items = $items;
        $this->itemClass = $itemClass;
        $this->configuration = $configuration;
        $this->asList = $asList;
        $this->controlsButtonVariant = $controlsButtonVariant;
        $this->withControls = $withControls;
        $this->withPagination = $withPagination;

        parent::__construct($ui);
    }

    public function shouldRender(): bool
    {
        return count($this->items) > 0;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.carousel.carousel');
    }
}
