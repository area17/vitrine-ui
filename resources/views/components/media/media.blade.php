<{{ $element() }} {{ $attributes->class($classes) }}
    @if(app()->environment(['local', 'development']))
        data-preset="{{ $imagePreset }}"
    @endif

    @if (isset($video) && $video)
        data-behavior="ShowVideo"
        data-ShowVideo-videoid="{{ $video['id'] }}"
        data-ShowVideo-videotype="{{ $video['type'] }}"
        data-ShowVideo-autoplay="{{ $video['autoplay'] ?? 0 }}"
        @if(isset($video['params']))
            @foreach ($video['params'] as $key => $value)
                data-ShowVideo-videoparam-{{ $key }}="{{ $value }}"
            @endforeach
        @endif
    @endif
>

    @if (isset($backgroundVideo) && !empty($backgroundVideo))
        <x-vui-video-background
            :aspect-ratio="$backgroundVideo['aspectRatio'] ?? null"
            :sources="$backgroundVideo['sources'] ?? null"
            :control-mute="$backgroundVideo['controlMute'] ?? null"
        />
    @else
        @if (isset($video) && $video)
            <div
                class="relative h-full cursor-pointer group overflow-hidden"
                data-ShowVideo-media-container
            >
        @else
            <div
                class="relative h-full overflow-hidden"
            >
        @endif

            @if ($image instanceof A17\Twill\Image\Models\Image)
                {!! $image->preset($imagePreset)->render($imageOptions); !!}
            @elseif (Arr::has($image, '_static'))

                {!! TwillStaticImage::make($staticSettings)->render($imageOptions); !!}
            @elseif (is_array($image) && array_key_exists('src', $image))
                <img src="{{ $image['src'] }}" alt="{{ $image['alt'] }}" class="{{ Arr::has($imageOptions, 'class') ? $imageOptions['class'] : '' }}" />
            @elseif($usePlaceholder)
                <div {{ $attributes->class(['image-placeholder', $imageOptions['class'] ?? null]) }}>
                </div>
            @endif

            {{ $slot ?? null }}

            @if (isset($video) && $video)
                <x-vui-button-icon
                    :static="true"
                    icon="play-96"
                    size="large"
                    class="absolute z-10 top-1/2 left-1/2 transform -translate-y-1/2 -translate-x-1/2"
                    aria-label="{{ __('fe.play_video') }}"
                />

                <div class="hidden absolute inset-0 z-30 w-full h-full" data-ShowVideo-player></div>
            @endif
        </div>
    @endif


    {{--
        Use the $captionSlot when you need to pass markup to the caption element or if you need to use other attributes on the wrapping caption element
    --}}
    @if(isset($captionSlot) && !empty($captionSlot))
        <figcaption {{ $captionSlot->attributes ?? null }}>
            {{ isset($captionSlot) && !$captionSlot->isEmpty() ? $mediaCaption : '' }}
        </figcaption>
    @elseif(isset($caption) && !empty($caption))
        <figcaption class="mt-12 lg:mt-16 text-primary f-ui-1">
            {!! $caption !!}
        </figcaption>
    @endif
</{{ $element() }}>
