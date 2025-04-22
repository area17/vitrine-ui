@if (count($sources ?? []))
    <x-vui-picture {{ $attributes->twMerge([$ui('media', 'image')]) }}
                   :sources="$sources"
                   :fallBackImg="$setPictureFallbackImg($image)"
                   :loading="$loading" />
@else
    <x-vui-img {{ $attributes->twMerge([$ui('media', 'image')]) }}
               :img="$image"
               :loading="$loading"
               :width="$width"
               :height="$height"
               :sizes="$sizes" />
@endif
