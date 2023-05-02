<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class MapMapBox extends VitrineComponent
{
    /** @var string */
    public $lat;

    /** @var string */
    public $lng;



    public function __construct(
        $lat = null,
        $lng = null,
    )
    {
        $this->lat = $lat;
        $this->lng = $lng;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.map-mapbox.mapbox');
    }
}
