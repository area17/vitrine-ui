@props([
    'lat' => null,
    'lng' => null,
])

<div data-behavior="MapBoxMaps"
     data-MapBoxMaps-lat="{{ $lat }}"
     data-MapBoxMaps-lng="{{ $lng }}"
     {{ $attributes }}>
    <div class="h-full w-full"
         id="map"
         data-MapBoxMaps-canvas=""></div>
</div>
