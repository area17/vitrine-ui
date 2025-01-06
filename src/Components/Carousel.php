<?php

namespace A17\VitrineUI\Components;

use Illuminate\View\View;

class Carousel extends VitrineComponent
{
    public ?string $configuration;

    public array $items = [];

    public string $itemClass = '';
    public string $swiperWrapperClass = '';

    public ?string $component;

    public ?string $controlsButtonVariant;

    public bool $asList = false;
    public bool $withControls = true;
    public bool $withPagination = false;

    public function __construct(
        array $items = [],
        string $itemClass = '',
        string $swiperWrapperClass = '',
        string $component = null,
        string $configuration = null,
        string $controlsButtonVariant = '',
        bool $asList = false,
        bool $withControls = true,
        bool $withPagination = false,
        array $ui = [],
    ) {
        $this->component = $component;
        $this->items = $items;
        $this->itemClass = $itemClass;
        $this->swiperWrapperClass = $swiperWrapperClass;
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
