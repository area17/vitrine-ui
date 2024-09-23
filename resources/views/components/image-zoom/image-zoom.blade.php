@isset($sources)
    @if (count($sources) > 0)
        <div class="bg-inverse-primary-strong relative h-screen w-screen"
             data-behavior="ImageZoom"
             data-ImageZoom-auto-init="{{ $autoInit ? 'true' : 'false' }}"
             data-ImageZoom-sources="{{ json_encode($sources) }}">
            <div class="absolute bottom-16 right-16 z-10 flex flex-col lg:bottom-32 lg:right-32"
                 id="{{ $id . 'image-zoom-toolbar' }}">
                <x-vui-button id="{{ $id . '-image-zoom-zoom-in' }}"
                              aria-label="{{ __('vitrine-ui::fe.zoom_in') }}"
                              icon-only
                              icon="plus-32"
                              size="medium" />
                <x-vui-button class="mt-4"
                              id="{{ $id . '-image-zoom-zoom-out' }}"
                              aria-label="{{ __('vitrine-ui::fe.zoom_out') }}"
                              icon-only
                              icon="minus-32"
                              size="medium" />

                @if (count($sources) > 1)
                    <x-vui-button class="mt-4 rotate-180 transform"
                                  id="{{ $id . '-image-zoom-nav-prev' }}"
                                  aria-label="{{ __('vitrine-ui::fe.previous') }}"
                                  icon="arrow-right-32"
                                  icon-only
                                  size="medium" />
                    <x-vui-button class="mt-4"
                                  id="{{ $id . '-image-zoom-nav-next' }}"
                                  aria-label="{{ __('vitrine-ui::fe.next') }}"
                                  icon="arrow-right-32"
                                  size="medium"
                                  icon />
                @endif
            </div>

            <div  id="{{ $id }}"
                 data-ImageZoom-canvas
                 {{ $attributes->twMerge('w-full h-full') }}>
            </div>
        </div>
    @endif
@endisset
