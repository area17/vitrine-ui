<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class MapMapbox extends VitrineComponent
{
    public ?string $lat;

    public ?string $lng;

    protected static array $assets = [
        'npm' => ['mapbox-gl'],
        'js' => ['behaviors/MapboxMaps.js'],
        'css' => ['components/map-mapbox.css'],
    ];

    public function __construct(string $lat = null, string $lng = null, array $ui = [])
    {
        $this->lat = $lat;
        $this->lng = $lng;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.map-mapbox.map-mapbox');
    }
}
