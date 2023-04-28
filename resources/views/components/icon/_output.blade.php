@props([
    'size' => 16,
    'ariaLabel' => null,
    'name' => null,
])

@php
    if(is_array($size)){
        $width = $size[0];
        $height = $size[1];
    }else{
        $width = $size;
        $height = $size;
    }
@endphp

<svg
    width="{{ $width }}"
    height="{{ $height }}"
    fill="none"
    @if(isset($attributes))
        {{ $attributes->class($class ?? null) }}
    @else
        class="{{ $class ?? null }}"
    @endif
    viewBox="0 0 {{ $width }} {{ $height }}"
    @if($ariaLabel)
        aria-label="{{ $ariaLabel }}"
    @else
        aria-hidden="true"
    @endif
>
    <use xlink:href="#{{ $name }}"></use>
</svg>
