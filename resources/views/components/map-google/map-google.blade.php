@props([
    'lat' => null,
    'lng' => null,
])

<div data-behavior="GoogleMaps"
     data-GoogleMaps-lat="{{ $lat }}"
     data-GoogleMaps-lng="{{ $lng }}"
     {{ $attributes }}>
    <div class="h-full w-full"
         data-GoogleMaps-canvas="">
    </div>
</div>
