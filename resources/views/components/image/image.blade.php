@switch($imageType)
    @case('twill-image')
        {!! $image->preset($imagePreset)->render($imageOptions) !!}
    @break
    @case('twill-image-static')
        {!!  A17\Twill\Image\Models\StaticImage::makeFromSrc($staticSettings)->render($imageOptions) !!}
    @break
    @case('static' || 'twill-image-array')
        <img {{ $attributes->class([$ui('media', 'image'), $imageOptions['class'] ?? null]) }}
                @if(Arr::has($imageOptions, 'attributes') && is_array($imageOptions['attributes'])) {!! $setAttributes($imageOptions['attributes'])!!} @endif
                @if(Arr::has($imageOptions, 'width')) width="{{ $imageOptions['width'] }}" @endif
                @if(Arr::has($imageOptions, 'height')) height="{{ $imageOptions['height'] }}" @endif
                @if(Arr::has($imageOptions, 'loading')) loading="{{ $imageOptions['loading'] }}" @endif
                @if(Arr::has($imageOptions, 'sizes')) sizes="{{ $imageOptions['sizes'] }}" @endif
                @if(Arr::has($image, 'srcset')) srcset="{{ $image['srcset'] }}" @endif
                @if(Arr::has($image, 'srcSet')) srcset="{{ $image['srcSet'] }}" @endif
                src="{{ $image['src'] }}"
                alt="{{ $image['alt'] ?? '' }}" />
    @break
    @case('placeholder')
        <div {{ $attributes->class([$ui('media', 'image-placeholder'), $imageOptions['class'] ?? null]) }}></div>
    @break
@endswitch