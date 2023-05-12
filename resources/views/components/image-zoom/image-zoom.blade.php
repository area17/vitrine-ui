@isset($sources)
    @if(count($sources) > 0)
        <div
            class="relative w-screen h-screen bg-inverse-primary-strong"
            data-behavior="ImageZoom"
            data-ImageZoom-auto-init="{{ $autoInit ? 'true' : 'false' }}"
            data-ImageZoom-sources="{{ json_encode($sources) }}"
        >
            <div id="{{ $id . 'image-zoom-toolbar' }}" class="absolute bottom-16 lg:bottom-32 right-16 lg:right-32 z-10 flex flex-col">
                <x-vui-button-icon
                    id="{{ $id . '-image-zoom-zoom-in'}}"
                    icon="plus-32"
                    size="medium"
                    aria-label="{{ __('vitrine-ui::fe.zoom_in') }}"
                />
                <x-vui-button-icon
                    id="{{ $id . '-image-zoom-zoom-out'}}"
                    icon="minus-32"
                    size="medium"
                    class="mt-4"
                    aria-label="{{ __('vitrine-ui::fe.zoom_out') }}"
                />

                @if(count($sources) > 1)
                    <x-vui-button-icon
                        id="{{ $id . '-image-zoom-nav-prev'}}"
                        icon="arrow-right-32"
                        size="medium"
                        class="mt-4 transform rotate-180"
                        aria-label="{{ __('vitrine-ui::fe.previous') }}"
                    />
                    <x-vui-button-icon
                        id="{{ $id . '-image-zoom-nav-next'}}"
                        icon="arrow-right-32"
                        size="medium"
                        class="mt-4"
                        aria-label="{{ __('vitrine-ui::fe.next') }}"
                    />
                @endif
            </div>

            <div
                {{ $attributes->class('w-full h-full') }}
                id="{{ $id }}"
                class="w-full h-full"
                data-ImageZoom-canvas
            >
            </div>
        </div>
    @endif
@endisset
