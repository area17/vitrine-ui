@if (count($sources ?? []))
    <x-vui-picture {{ $attributes->twMerge([$ui('media', 'image')]) }}
                   :sources="$sources"
                   :src="$src ?? null"
                   :alt="$alt ?? null"
                   :width="$width ?? null"
                   :height="$height ?? null"
                   :fallBackImg="$setPictureFallbackImg($image)"
                   :loading="$loading" />
@else
    <x-vui-img {{ $attributes->twMerge([$ui('media', 'image')]) }}
               :img="$image"
               :src="$src ?? null"
               :alt="$alt ?? null"
               :loading="$loading"
               :width="$width ?? null"
               :height="$height ?? null"
               :sizes="$sizes" />
@endif
