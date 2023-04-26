@props([
    'icon' => false,
    'href' => false,
    'static' => false,
    'disabled' => false,
    'active' => false,
    'size' => 'small',
])

@php
    $classes = [
        'justify-center',
        'w-32 h-32' => $size === 'small',
        'w-52 h-52' => $size === 'medium',
        'w-96 h-96' => $size === 'large',
        'f-ui-2',
        'border',
        'bg-tertiary hover:bg-primary border-primary text-inverse hover:text-primary' => !$active,
        'bg-primary hover:bg-tertiary focus:bg-primary border-tertiary text-primary' => $active,
        'hover:text-primary',
        'rounded-full',
        'disabled:bg-primary',
        'disabled:opacity-30',
        'whitespace-nowrap',
    ];
@endphp

<x-atoms.button
    :href="$href ?? null"
    :icon="$icon ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :icon-spacing="0"
    {{ $attributes->class($classes) }}
>
    {!! $slot !!}
</x-atoms.button>
