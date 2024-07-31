<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class MapGoogle extends VitrineComponent
{
    /** @var string */
    public $lat;

    /** @var string */
    public $lng;

    protected static array $assets = [
        'npm' => [
            '@googlemaps/js-api-loader'
        ],
        'js' => [
            'behaviors/GoogleMaps.js'
        ]
    ];

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
        return view('vitrine-ui::components.map-google.map-google');
    }
}
