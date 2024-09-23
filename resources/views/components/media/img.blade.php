@props([
    'img',
    'src' => null,
    'srcset' => null,
    'width' => null,
    'height' => null,
    'alt' => null,
    'sizes' => null,
    'loading' => 'lazy',
])

<img src="{{ $img['src'] ?? ($src ?? '') }}"
     alt="{{ $img['alt'] ?? '' }}"
     loading="{{ $loading }}"
     {{ $attributes }}
     @if ($img['srcSetWebp'] ?? ($img['srcset'] ?? ($img['srcSet'] ?? false))) srcset="{{ $img['srcSetWebp'] ?? ($img['srcset'] ?? $img['srcSet']) }}" @endif
     @if ($img['width'] ?? ($width ?? false)) width="{{ $img['width'] ?? $width }}" @endif
     @if ($img['height'] ?? ($height ?? false)) height="{{ $img['height'] ?? $height }}" @endif
     @if ($img['sizes'] ?? ($sizes ?? false)) sizes="{{ $img['sizes'] ?? $sizes }}" @endif />
