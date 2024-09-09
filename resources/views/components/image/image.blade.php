@switch($imageType)
    {{--@deprecated--}}
    @case('twill-image')
        {!! $image->preset($imagePreset)->render($imageOptions) !!}
        @break
        {{--@deprecated--}}
    @case('twill-image-static')
        {!!  A17\Twill\Image\Models\StaticImage::makeFromSrc($staticSettings)->render($imageOptions) !!}
        @break
        {{-- This will be the default in next major version--}}
    @case('next-rendering')
            @if(count($sources ?? []))
                <x-vui-picture {{ $attributes->twMerge([$ui('media', 'image')]) }}
                               :sources="$sources"
                               :fallBackImg="$setPictureFallbackImg($image)"
                               :loading="$loading"/>
            @else
                <x-vui-img {{ $attributes->twMerge([$ui('media', 'image')]) }} :img="$image" :loading="$loading"
                           :width="$width" :height="$height" :sizes="$sizes"/>
            @endif
        @break
    @case('static' || 'twill-image-array')
        <img {{ $attributes->twMerge([$ui('media', 'image'), Arr::has($imageOptions, 'imageClass') ? $imageOptions['imageClass'] : null]) }}
             @if(Arr::has($imageOptions, 'attributes') && is_array($imageOptions['attributes']))
                 {!! $setAttributes($imageOptions['attributes'])!!}
             @endif
             @if(Arr::has($imageOptions, 'width')) width="{{ $imageOptions['width'] }}" @endif
             @if(Arr::has($imageOptions, 'height')) height="{{ $imageOptions['height'] }}" @endif
             @if(Arr::has($imageOptions, 'loading')) loading="{{ $imageOptions['loading'] }}" @endif
             @if(Arr::has($imageOptions, 'sizes') || isset($sizes)) sizes="{{ $imageOptions['sizes'] }}" @endif
             @if(Arr::has($image, 'srcset')) srcset="{{ $image['srcset'] }}" @endif
             @if(Arr::has($image, 'srcSet')) srcset="{{ $image['srcSet'] }}" @endif
             src="{{ $image['src'] ?? '' }}"
             alt="{{ $image['alt'] ?? '' }}"/>
        @break
        {{--@deprecated ?--}}
    @case('placeholder')
        <div {{ $attributes->twMerge([$ui('media', 'image-placeholder'), Arr::has($imageOptions, 'imageClass') ? $imageOptions['imageClass'] : null]) }}></div>
        @break
@endswitch
