
<div {{ $attributes->class(VitrineUI::setPrefixedClass([
    'wysiwyg',
    'wysiwyg--'. $variation => $variation,
    ]))
 }}>
    {!! $slot !!}
</div>
