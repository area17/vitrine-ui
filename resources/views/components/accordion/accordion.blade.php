@if (!$slot->isEmpty())
    @php
        $id = $id ?? Str::uuid();
        $headingId = 'accordionLabel' . $id;
        $accordion_id = 'accordion' . $id;
    @endphp

    <div {{ $attributes->class(VitrineUI::setPrefixedClass('accordion')) }}>
        <x-vui-heading class="sr-only"
                       id="{{ $headingId }}"
                       :level="$headingLevel">
            {{ $a11yLabel }}
        </x-vui-heading>

        <ul class="{{ VitrineUI::setPrefixedClass('accordion-list') }}"
            data-behavior="Accordion"
            aria-labelledby="{{ $headingId }}"
            {{ $scrollOnOpen ? 'data-accordion-scroll-open="true"' : '' }}>
            {!! $slot !!}
        </ul>
    </div>
@endif
