@push('modals')

<div
    id="{{ $id }}"
    role="dialog"
    aria-labelledby="{{ $id .'_title' }}"
    aria-modal="true"
    data-behavior="Modal"
    {!! $panel ? 'data-Modal-panel="true"' : '' !!}
    {{ $attributes->class($classes) }}
>
    <div
        class="{{ Arr::toCssClasses(['o-modal-wrapper', '3xl:!w-panel-max' => $panel]) }}"
        data-Modal-focus-trap
        tabindex="-1"
    >
        @if (isset($closeButton) && !$closeButton->isEmpty())
            {{ $closeButton }}
        @elseif($showClose)
            <x-atoms.button.icon
                icon="close-32"
                size="medium"
                class="o-modal-close"
                aria-label="{{ __('fe.close_modal') }}"
                data-Modal-close-trigger
            />
        @endif

        @isset($title)
            <x-vui-heading
                :level="1"
                id="{{ $id }}_title"
                class="sr-only"
                tabindex="-1"
                data-Modal-initial-focus
            >
                {{ $title }}
            </x-vui-heading>
        @endisset

        {!! $slot !!}
    </div>
</div>

@endpush
