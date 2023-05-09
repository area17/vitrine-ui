@if (!$slot->isEmpty())

@php
    $id = Str::random(9);
    $headingId = 'accordionLabel'. $id;
    $accordion_id = 'accordion'. $id;
@endphp

<div {{ $attributes }}>
    <x-vui-heading
        id="{{ $headingId }}"
        :level="$headingLevel"
        class="sr-only"
    >
        {{ $a11yLabel }}
    </x-vui-heading>

    <ul
        data-behavior="Accordion"
        {{ $scrollOnOpen ? 'data-accordion-scroll-open="true"' : '' }}
        aria-labelledby="{{ $headingId }}"
    >

        {!! $slot !!}

    </ul>
</div>
@endisset
