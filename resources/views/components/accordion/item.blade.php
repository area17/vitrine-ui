@props([
    'index' => false,
    'title' => false,
    'headingLevel' => 3,
    'setFixedHeight' => true,
    'iconClosed' => 'plus-32',
    'iconOpen' => 'minus-32',
])

@php
    $id = Str::random(9);
    $item_id = 'AccordionItem'. $id. $index;
    $label_id = 'AccordionLabel'. $id. $index;

@endphp

<li {{ $attributes }} data-accordion-item class="border-b border-quaternary">
    <x-vui-heading :level="$headingLevel">
        <button
            id="{{ $label_id }}"
            class="
                relative flex justify-start  w-full py-12
                lg:py-32 f-subhead-3 text-left
                underline-thickness-1 underline-transparent underline-offset-4 hover:underline-text-primary
                transition-all
                "
            aria-expanded="false"
            aria-controls="{{ $item_id }}"
            data-Accordion-trigger
            data-Accordion-index="{{ $index }}"
            data-Accordion-size="large"
        >
            <span class="relative flex">
                <div class="relative bg-quaternary mr-16">
                    <div class="top-0 left-0 w-24 h-24 lg:w-32 lg:h-32 pointer-events-none">
                        <x-vui-icon
                            :name="$iconClosed"
                            class="w-24 h-24 lg:w-32 lg:h-32 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 absolute transform transition-all pointer-events-none "
                            aria-hidden="true"
                            data-Accordion-trigger-icon
                        />

                        <x-vui-icon
                            :name="$iconOpen"
                            class="w-24 h-24 lg:w-32 lg:h-32 top-1/2 left-1/2 -translate-y-1/2 -translate-x-1/2 absolute transform transition-all pointer-events-none opacity-0"
                            aria-hidden="true"
                            data-Accordion-trigger-icon-active
                        />
                    </div>
                </div>

                {{ $title }}
            </span>
        </button>
    </x-vui-heading>

    <div
        id="{{ $item_id }}"
        class="hidden h-0 overflow-hidden transition-all duration-500 "
        role="region"
        aria-labelledby="{{ $label_id }}"
        aria-hidden="true"
        data-Accordion-content
        data-set-fixed-height="{{ $setFixedHeight ? 'true' : 'false' }}"
    >
        <div
            {{-- pt classes add to trigger padding to add up to space-7 --}}
            class="pt-8 lg:pt-16 pb-space-7 pl-[30px] lg:pl-[40px] pr-outer-gutter"
            data-Accordion-content-inner
        >
            {!! $slot !!}
        </div>
    </div>
</li>
