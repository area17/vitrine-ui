@php
    $classes = '';

    if($variation){
        $classes = 'wysiwyg--'. $variation;
    }
@endphp

<div {{ $attributes->class(['wysiwyg', $classes]) }}>
    {!! $slot !!}
</div>
