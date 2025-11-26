<div {{ $attributes->optimizedMerge(VitrineUI::setPrefixedClass(['wysiwyg', 'wysiwyg--' . $variant => $variant])) }}>
    {!! $slot !!}
</div>
