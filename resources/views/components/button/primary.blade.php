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
        'f-ui-2',
        'border',
        'border-primary',
        'bg-tertiary focus:bg-tertiary disabled:bg-tertiary text-inverse focus:text-inverse',
        'hover:bg-primary',
        'active:bg-primary',
        'hover:text-primary',
        'active:text-primary',
        'focus:outline-2',
        'focus:outline-offset-2',
        'focus:outline-highlight',
        'disabled:opacity-30',
        'disabled:text-inverse',
        'whitespace-nowrap',
    ];
@endphp

<x-vui-button
    :href="$href ?? null"
    :icon="$icon ?? null"
    :icon-position="$iconPosition ?? null"
    :static="$static ?? null"
    :disabled="$disabled ?? null"
    :icon-spacing="8"
    {{ $attributes->class($classes) }}
>
    {{ $slot }}
</x-vui-button>
