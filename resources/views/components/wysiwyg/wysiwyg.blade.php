<div {{ $attributes->twMerge(VitrineUI::setPrefixedClass(['wysiwyg', 'wysiwyg--' . $variant => $variant])) }}>
    {!! $slot !!}
</div>
