@props([
    'lat' => null,
    'lng' => null
])

<div
    {{ $attributes }}
    data-behavior="GoogleMaps"
    data-GoogleMaps-lat="{{ $lat }}"
    data-GoogleMaps-lng="{{ $lng }}"
>
    <div
        class="w-full h-full"
        data-GoogleMaps-canvas=""
    >
    </div>
</div>
