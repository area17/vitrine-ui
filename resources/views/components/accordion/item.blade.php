@props([
    'index' => false,
    'title' => false,
    'headingLevel' => 3,
    'setFixedHeight' => true,
    'iconClosed' => 'plus-32',
    'iconOpen' => 'minus-32',
])

@php
    $id = $id ?? Str::uuid();
    $item_id = 'AccordionItem'. $id. $index;
    $label_id = 'AccordionLabel'. $id. $index;
    $isOpen = $open ?? false;
@endphp

<li {{ $attributes->class(VitrineUI::setPrefixedClass('accordion-item')) }} data-accordion-item>
    <x-vui-heading :level="$headingLevel">
        <button
                id="{{ $label_id }}"
                class="{{ VitrineUI::setPrefixedClass('accordion-item-trigger') }}"
                aria-expanded="{{ $isOpen ? 'true' : 'false' }}"
                aria-controls="{{ $item_id }}"
                data-accordion-trigger
                data-accordion-open="{{ $isOpen ? 'true' : 'false' }}"
                data-accordion-index="{{ $index }}"
        >
            @if ($slotTrigger ?? false)
                {{  $slotTrigger }}
            @else
                <span class="{{ VitrineUI::setPrefixedClass('accordion-item-title') }}">{{ $title }}</span>
                <div class="{{ VitrineUI::setPrefixedClass('accordion-item-icons') }}">
                    @if($iconClosed ?? false)
                        <x-vui-icon
                                :name="$iconClosed"
                                class="{{ VitrineUI::setPrefixedClass(['accordion-item-icon', 'accordion-item-icon--close']) }}"
                                aria-hidden="true"
                        />
                    @endif
                    @if($iconOpen ?? false)
                        <x-vui-icon
                                :name="$iconOpen"
                                class="{{ VitrineUI::setPrefixedClass(['accordion-item-icon', 'accordion-item-icon--open']) }}"
                                aria-hidden="true"
                        />
                    @endif
                </div>
            @endif
        </button>
    </x-vui-heading>

    <div
            id="{{ $item_id }}"
            class="{{  VitrineUI::setPrefixedClass('accordion-content') }}"
            role="region"
            aria-labelledby="{{ $label_id }}"
            aria-hidden="{{ $isOpen ? 'false' : 'true' }}"
            data-accordion-content
            data-accordion-open="{{ $isOpen ? 'true' : 'false' }}"
            data-set-fixed-height="{{ $setFixedHeight ? 'true' : 'false' }}"
    >
        <div
                class="{{VitrineUI::setPrefixedClass('accordion-content-inner')}}"
                data-accordion-content-inner
        >
            {!! $slot !!}
        </div>
    </div>
</li>
