@props([
    'href' => false,
    'static' => false,
    'active' => false,
    'icon' => null,
    'iconPosition' => null,
    'iconSpacing' => 8,
    'disabled' => null,
    'inverse' => false,
])

@php
    $classes = [
        'f-ui-3',
        'text-primary' => !$inverse,
        'text-inverse' => $inverse,
        'underline',
        'underline-transparent',
        'hover:underline-inherit',
        'underline-thickness-1',
        'underline-offset-4',
        'active:underline-transparent',
        'disabled:opacity-30',
        'text-left'
    ];
@endphp

<x-vui-button
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :icon-spacing="$iconSpacing"
    {{ $attributes->class($classes) }}
>
    {{ $slot }}
</x-vui-button>
