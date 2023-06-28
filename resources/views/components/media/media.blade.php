<{{ $element() }}
    {{ $attributes->class(array_merge([$ui('media', 'base', [
        "cover" => $cover ? 'true' : 'false',
    ])], $classes)) }}
    @if (app()->environment(['local', 'development'])) data-preset="{{ $imagePreset }}" @endif
@if (isset($video) && $video)
    data-behavior="ShowVideo"
    data-ShowVideo-videoid="{{ $video['id'] }}"
    data-ShowVideo-videotype="{{ $video['type'] }}"
    data-ShowVideo-autoplay="{{ $video['autoplay'] ?? 0 }}"
    @if (isset($video['params']))
        @foreach ($video['params'] as $key => $value)
            data-ShowVideo-videoparam-{{ $key }}="{{ $value }}"
        @endforeach
    @endif
@endif>

@if (isset($backgroundVideo) && !empty($backgroundVideo))
    <x-vui-video-background :aspect-ratio="$backgroundVideo['aspectRatio'] ?? null"
                            :sources="$backgroundVideo['sources'] ?? null"
                            :control-mute="$backgroundVideo['controlMute'] ?? null"/>
@else
    @if (isset($video) && $video)
        <div class="{{ $ui('media', 'video-wrapper') }}"
             data-ShowVideo-media-container>
            @else
                <div class="{{ $ui('media', 'image-wrapper') }}">
                    @endif

                    @if ($image instanceof A17\Twill\Image\Models\Image)
                        {!! $image->preset($imagePreset)->render($imageOptions) !!}
                    @elseif (Arr::has($image, '_static'))
                        {!!  A17\Twill\Image\Models\StaticImage::makeFromSrc($staticSettings)->render($imageOptions) !!}
                    @elseif (is_array($image) && array_key_exists('src', $image))
                        {{--            tbd: add lazyload and srcset support --}}
                        <img class="{{ Arr::has($imageOptions, 'class') ? $imageOptions['class'] : '' }}"
                             src="{{ $image['src'] }}"
                             alt="{{ $image['alt'] }}"/>
                    @elseif($usePlaceholder)
                        <div {{ $attributes->class([$ui('media', 'image-placeholder'), $imageOptions['class'] ?? null]) }}>
                        </div>
                    @endif

                    {{ $slot ?? null }}

                    @if (isset($video) && $video)
                        <x-vui-button class="{{ $ui('media', 'video-play-button') }}"
                                      aria-label="{{ __('vitrine-ui::fe.play_video') }}"
                                      :icon-only="true"
                                      {{--                          fixme: add missing play-96 icon--}}
                                      :icon="$videoPlayIcon ?? 'play-96'"
                                      size="large"/>

                        <div class="{{ $ui('media', 'video-player') }} }}"
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
                <figcaption class="{{ $ui('media', 'caption') }}">
                    {!! $caption !!}
                </figcaption>
            @endif
        </{{ $element() }}>
