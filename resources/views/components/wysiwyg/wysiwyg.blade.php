
<div {{ $attributes->class(VitrineUI::setPrefixedClass([
    'wysiwyg',
    'wysiwyg--'. $variant => $variant,
    ]))
 }}>
    {!! $slot !!}
</div>
