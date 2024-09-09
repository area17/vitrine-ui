@if (!$slot->isEmpty())
    @php
        $id = $id ?? Str::uuid();
        $headingId = 'accordionLabel' . $id;
        $accordion_id = 'accordion' . $id;
    @endphp

    <div {{ $attributes->twMerge($ui('accordion')) }}>
        <x-vui-heading class="sr-only"
                       id="{{ $headingId }}"
                       :level="$headingLevel">
            {{ $a11yLabel }}
        </x-vui-heading>

        <ul class="{{ $ui('accordion','list') }}"
            data-behavior="Accordion"
            aria-labelledby="{{ $headingId }}"
            {!! $exclusive ? 'data-accordion-exclusive="true"' : '' !!}
            {!! $scrollOnOpen ? 'data-accordion-scroll-open="true"' : '' !!}>
            {!! $slot !!}
        </ul>
    </div>
@endif
