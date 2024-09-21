<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class MapGoogle extends VitrineComponent
{
    public ?string $lat;

    public ?string $lng;

    protected static array $assets = [
        'npm' => [
            '@googlemaps/js-api-loader'
        ],
        'js' => [
            'behaviors/GoogleMaps.js'
        ]
    ];

    public function __construct(
        string $lat = null,
        string $lng = null,
        array $ui = []
    )
    {
        $this->lat = $lat;
        $this->lng = $lng;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.map-google.map-google');
    }
}
