<{{ $element() }}
    {{ $attributes->class($classes) }}
                     @if (app()->environment(['local', 'development'])) data-preset="{{ $imagePreset }}" @endif
                     @if (isset($video) && $video) data-behavior="ShowVideo"
        data-ShowVideo-videoid="{{ $video['id'] }}"
        data-ShowVideo-videotype="{{ $video['type'] }}"
        data-ShowVideo-autoplay="{{ $video['autoplay'] ?? 0 }}"
        @if (isset($video['params']))
            @foreach ($video['params'] as $key => $value)
                data-ShowVideo-videoparam-{{ $key }}="{{ $value }}"
            @endforeach @endif
                     @endif>

    @if (isset($backgroundVideo) && !empty($backgroundVideo))
        <x-vui-video-background :aspect-ratio="$backgroundVideo['aspectRatio'] ?? null"
                                :sources="$backgroundVideo['sources'] ?? null"
                                :control-mute="$backgroundVideo['controlMute'] ?? null" />
    @else
        @if (isset($video) && $video)
            <div class="group relative h-full cursor-pointer overflow-hidden"
                 data-ShowVideo-media-container>
            @else
                <div class="relative h-full overflow-hidden">
        @endif

        @if ($image instanceof A17\Twill\Image\Models\Image)
            {!! $image->preset($imagePreset)->render($imageOptions) !!}
        @elseif (Arr::has($image, '_static'))
        {!!  A17\Twill\Image\Models\StaticImage::makeFromSrc($staticSettings)->render($imageOptions) !!}
        @elseif (is_array($image) && array_key_exists('src', $image))
            {{--            tbd: add lazyload and srcset support --}}
            <img class="{{ Arr::has($imageOptions, 'class') ? $imageOptions['class'] : '' }}"
                 src="{{ $image['src'] }}"
                 alt="{{ $image['alt'] }}" />
        @elseif($usePlaceholder)
            <div {{ $attributes->class(['image-placeholder', $imageOptions['class'] ?? null]) }}>
            </div>
        @endif

        {{ $slot ?? null }}

        @if (isset($video) && $video)
            <x-vui-button class="absolute left-1/2 top-1/2 z-10 -translate-x-1/2 -translate-y-1/2 transform"
                          aria-label="{{ __('vitrine-ui::fe.play_video') }}"
                          :icon-only="true"
                          icon="play-96"
                          size="large" />

            <div class="absolute inset-0 z-30 hidden h-full w-full"
                 data-ShowVideo-player></div>
        @endif
        </div>
    @endif

    {{--
        Use the $captionSlot when you need to pass markup to the caption element or if you need to use other attributes on the wrapping caption element
    --}}
    @if (isset($captionSlot) && !empty($captionSlot))
        <figcaption {{ $captionSlot->attributes ?? null }}>
            {{ isset($captionSlot) && !$captionSlot->isEmpty() ? $mediaCaption : '' }}
        </figcaption>
    @elseif(isset($caption) && !empty($caption))
        <figcaption class="f-ui-1 mt-12 text-primary lg:mt-16">
            {!! $caption !!}
        </figcaption>
    @endif
    </{{ $element() }}>
