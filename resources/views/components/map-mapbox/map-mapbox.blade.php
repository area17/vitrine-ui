@props([
    'lat' => null,
    'lng' => null
])

<div
    {{ $attributes }}
    data-behavior="MapBoxMaps"
    data-MapBoxMaps-lat="{{ $lat }}"
    data-MapBoxMaps-lng="{{ $lng }}"
>
    <div
        id="map"
        class="w-full h-full"
        data-MapBoxMaps-canvas=""
    ></div>
</div>
