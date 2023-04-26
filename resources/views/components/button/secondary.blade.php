@props([
    'icon' => false,
    'iconPosition' => 'after',
    'href' => false,
    'static' => false,
    'active' => false,
])

@php
    $classes = [
        'py-12',
        'px-12' => !$slot->isNotEmpty(),
        'px-20' => $slot->isNotEmpty(),
        'border',
        'f-ui-2',
        'border-primary',
        'hover:border-transparent',
        'bg-primary',
        'hover:bg-tertiary',
        'active:bg-tertiary',
        'text-primary',
        'hover:text-inverse',
        'active:text-inverse',
        'disabled:bg-primary',
        'disabled:opacity-30',
        'whitespace-nowrap',
    ];
@endphp

<x-atoms.button
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :icon-spacing="8"
    {{ $attributes->class($classes) }}
>
    {{ $slot }}
</x-atoms.button>
