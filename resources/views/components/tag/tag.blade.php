{{-- todo: refactor me --}}
@php
    $classes = [
        'py-6',
        'px-12',
        'rounded-px',
        'border',
        'border-primary',
        'f-ui-1',
        'text-primary',
        'hover:text-secondary' => $href,
        'bg-transparent',
        'hover:bg-accent-3' => $href,
        'disabled:opacity-30',
        'text-left',
        'whitespace-nowrap',
    ];
@endphp

<x-vui-button :href="$href ?? null"
              :icon="$cancellable ? 'close-16' : null"
              icon-position="after"
              :icon-spacing="8"
              :static="!$href"
              {{ $attributes->class($classes) }}>
    {{ $slot }}
</x-vui-button>
