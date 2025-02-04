@props([
    'index' => false,
    'title' => false,
    'headingLevel' => 3,
    'setFixedHeight' => true,
    'iconClosed' => 'plus-32',
    'iconOpen' => 'minus-32',
    'open' => false,
    'ui' => [],
])

@php
    $id = $id ?? Str::uuid();
    $item_id = 'AccordionItem' . $id . $index;
    $label_id = 'AccordionLabel' . $id . $index;
    $isOpen = $open ?? false;
@endphp

<li data-accordion-item
    {{ $attributes->twMerge(VitrineUI::ui('accordion-item')) }}>
    <x-vui-heading class="{{ VitrineUI::ui('accordion-item', 'heading', [], $ui ?? []) }}"
                   :level="$headingLevel">
        <button class="{{ VitrineUI::ui('accordion-item', 'trigger', [], $ui ?? []) }}"
                id="{{ $label_id }}"
                data-accordion-trigger
                data-accordion-open="{{ $isOpen ? 'true' : 'false' }}"
                data-accordion-index="{{ $index }}"
                aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                aria-controls="{{ $item_id }}">
            @if ($slotTrigger ?? false)
                {{ $slotTrigger }}
            @else
                <span class="{{ VitrineUI::ui('accordion-item', 'title', [], $ui ?? []) }}">{{ $title }}</span>
                <div class="{{ VitrineUI::ui('accordion-item', 'icons', [], $ui ?? []) }}">
                    @if ($iconClosed ?? false)
                        <x-vui-icon class="{{ VitrineUI::ui('accordion-item', ['icon', 'icon-close']) }}"
                                    aria-hidden="true"
                                    :name="$iconClosed" />
                    @endif
                    @if ($iconOpen ?? false)
                        <x-vui-icon class="{{ VitrineUI::ui('accordion-item', ['icon', 'icon-open']) }}"
                                    aria-hidden="true"
                                    :name="$iconOpen" />
                    @endif
                </div>
            @endif
        </button>
    </x-vui-heading>

    <div class="{{ VitrineUI::ui('accordion-item', 'content', [], $ui ?? []) }}"
         id="{{ $item_id }}"
         data-accordion-content
         data-accordion-open="{{ $isOpen ? 'true' : 'false' }}"
         data-set-fixed-height="{{ $setFixedHeight ? 'true' : 'false' }}"
         role="region"
         aria-labelledby="{{ $label_id }}"
         aria-hidden="{{ $isOpen ? 'false' : 'true' }}"
         {{ !$isOpen ? 'inert' : '' }}>
        <div class="{{ VitrineUI::ui('accordion-item', 'content-inner', [], $ui ?? []) }}"
             data-accordion-content-inner>
            {!! $slot !!}
        </div>
    </div>
</li>
