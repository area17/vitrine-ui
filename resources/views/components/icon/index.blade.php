{{--
    No Icon name set.

    @see /src/Components/functional/icon.php
--}}

@if(filled($name) && $iconComponent)
    <x-dynamic-component
        :component="$iconComponent"
        :name="$name"
        :aria-label="$ariaLabel ?? false"
        {{ $attributes }}
    />
@endif
