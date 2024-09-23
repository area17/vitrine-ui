@storybook([
    'args' => [
        'lat' => '40.7106967',
        'lng' => '-73.9928989',
    ],
    'argTypes' => [
        'lat' => [
            'description' => 'Latitude coordinates to center the map. The value is converted to a number in the JS behavior.',
            'defaultValue' => ['summary' => ''],
        ],
        'lng' => [
            'description' => 'Longitude coordinates to center the map. The value is converted to a number in the JS behavior.',
            'defaultValue' => ['summary' => ''],
        ],
    ],
])

<div class="w-312">
    <x-vui-map-mapbox class="aspect-1/1"
                      :lat="$lat ?? null"
                      :lng="$lng ?? null" />
</div>
