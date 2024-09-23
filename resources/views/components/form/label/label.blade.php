@props([
    'label' => '',
    'name' => '',
    'tag' => 'label',
    'required' => false,
])

<{{ $tag }} {{ $attributes->class(VitrineUI::ui('form', 'label')) }}
                     @if ($name) for="{{ $name }}" @endif>
    @if ($slot && !$slot->isEmpty())
        {{ $slot }}
    @endif
    @if ($required)
        {{ __('vitrine-ui::fe.form.required') }}
    @endif
    </{{ $tag }}>
