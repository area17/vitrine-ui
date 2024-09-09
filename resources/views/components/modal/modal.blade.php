@push($modalsStack)

    <div
            id="{{ $id }}"
            role="dialog"
            aria-labelledby="{{ $id .'_title' }}"
            aria-modal="true"
            data-behavior="Modal"
            {!! $panel ? 'data-Modal-panel="true"' : '' !!}
            {!! $clickOutsideToClose ? 'data-Modal-clickOutside="true"' : '' !!}
            {{ $attributes->twMerge($ui('modal', ['base'])) }}
    >
        <div
                class="{{ $ui('modal', '', ['wrapper' => $variant]) }}"
                data-Modal-focus-trap
                tabindex="-1"
        >
            @if (isset($closeButton) && !$closeButton->isEmpty())
                {{ $closeButton }}
            @elseif($showClose)
                <x-vui-button
                        icon="close-32"
                        icon-only
                        class="{{ $ui('modal', 'close') }}"
                        aria-label="{{ __('vitrine-ui::fe.close_modal') }}"
                        data-Modal-close-trigger
                />
            @endif

            @isset($title)
                @if($setInitialFocus)
                    <x-vui-heading
                            :level="1"
                            id="{{ $id }}_title"
                            class="{{ $ui('modal', 'title') }}"
                            tabindex="-1"
                            data-Modal-initial-focus=""
                    >
                        {{ $title }}
                    </x-vui-heading>
                @else
                    <x-vui-heading
                            :level="1"
                            id="{{ $id }}_title"
                            class="{{ $ui('modal', 'title') }}"
                            tabindex="-1"
                    >
                        {{ $title }}
                    </x-vui-heading>
                @endif
            @endisset

            {!! $slot !!}
        </div>
    </div>

@endpush
