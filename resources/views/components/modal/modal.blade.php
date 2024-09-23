@push($modalsStack)

    <div id="{{ $id }}"
         data-behavior="Modal"
         role="dialog"
         aria-labelledby="{{ $id . '_title' }}"
         aria-modal="true"
         {!! $panel ? 'data-Modal-panel="true"' : '' !!}
         {!! $clickOutsideToClose ? 'data-Modal-clickOutside="true"' : '' !!}
         {{ $attributes->class($ui('modal', ['base'])) }}>
        <div class="{{ $ui('modal', '', ['wrapper' => $variant]) }}"
             data-Modal-focus-trap
             tabindex="-1">
            @if (isset($closeButton) && !$closeButton->isEmpty())
                {{ $closeButton }}
            @elseif($showClose)
                <x-vui-button class="{{ $ui('modal', 'close') }}"
                              data-Modal-close-trigger
                              aria-label="{{ __('vitrine-ui::fe.close_modal') }}"
                              icon="close-32"
                              icon-only />
            @endif

            @isset($title)
                @if ($setInitialFocus)
                    <x-vui-heading class="{{ $ui('modal', 'title') }}"
                                   id="{{ $id }}_title"
                                   data-Modal-initial-focus=""
                                   tabindex="-1"
                                   :level="1">
                        {{ $title }}
                    </x-vui-heading>
                @else
                    <x-vui-heading class="{{ $ui('modal', 'title') }}"
                                   id="{{ $id }}_title"
                                   tabindex="-1"
                                   :level="1">
                        {{ $title }}
                    </x-vui-heading>
                @endif
            @endisset

            {!! $slot !!}
        </div>
    </div>

@endpush
