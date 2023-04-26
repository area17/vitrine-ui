{{--
    No Icon name set.

    See /app/View/Components/functional/icon.php
--}}

@if(filled($name))
    <x-dynamic-component
        :component="$getIconPath()"
        :name="$name"
        :aria-label="$ariaLabel ?? false"
        {{ $attributes }}
    />
@endif
