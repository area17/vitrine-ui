{{-- Image, Video Background, Video or Placeholder with media base and media container classes --}}
@php
    $hasCaptionSlot = isset($slotCaption) && !$slotCaption->isEmpty();
    $wrapper = $element($hasCaptionSlot);
@endphp
<{{ $wrapper }} {{ $attributes->twMerge(
    array_merge(
        [
            $ui('media', 'base', [
                'cover' => $cover ? 'true' : 'false',
            ]),
        ],
        $classes,
    ),
) }}
                     @if (isset($video) && $video) data-behavior="ShowVideo"
    data-ShowVideo-id="{{ $video['id'] }}"
    data-ShowVideo-type="{{ $video['type'] }}"
    data-ShowVideo-autoplay="{{ $video['autoplay'] ?? 1 }}" @endif>

    {{-- BackgroundVideo, Video or Image --}}
    @if (isset($backgroundVideo) && !empty($backgroundVideo))
        <x-vui-video-background :sources="$backgroundVideo['sources'] ?? null"
                                :control-mute="$backgroundVideo['controlMute'] ?? false"
                                :native="$backgroundVideo['native'] ?? true">
            {{ $slot ?? null }}
        </x-vui-video-background>
    @else
        @if (isset($video) && $video)
            <div class="{{ $ui('media', 'video-wrapper') }}"
                 data-ShowVideo-media-container>
                <x-vui-button class="{{ $ui('media', 'video-play-button') }}"
                              aria-label="{{ __('vitrine-ui::fe.play_video') }}"
                              :icon-only="true"
                              :icon="$videoPlayIcon ?? 'play-96'"
                              size="large" />

                <div class="{{ $ui('media', 'video-player') }}"
                     data-ShowVideo-player></div>
                {{ $slot ?? null }}
            </div>
        @else
            <div class="{{ $ui('media', 'image-wrapper') }}">
                <x-vui-image :image="$image" />
                {{ $slot ?? null }}
            </div>
        @endif
    @endif
    {{--
        Use the $slotCaption when you need to pass markup to the caption element or if you need to use other attributes on the wrapping caption element
    --}}
    @if ($hasCaptionSlot)
        <figcaption {{ $slotCaption->attributes }}>
            {{ $slotCaption }}
        </figcaption>
    @elseif(isset($caption) && !empty($caption))
        <figcaption class="{{ $ui('media', 'caption') }}">
            {!! $caption !!}
        </figcaption>
    @endif
    </{{ $wrapper }}>
