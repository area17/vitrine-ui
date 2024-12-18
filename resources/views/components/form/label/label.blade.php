@props([
    'label' => '',
    'name' => '',
    'tag' => 'label',
    'required' => false,
])

<{{ $tag }} {{ $attributes->twMerge(VitrineUI::ui('form', 'label')) }}
                     @if ($name) for="{{ $name }}" @endif>
    @if ($slot && !$slot->isEmpty())
        {{ $slot }}
    @endif
    @if ($required)
        <span class="{{ $ui('form', 'required') }}">
            {{ __('vitrine-ui::fe.form.required') }}
        </span>
    @endif
    </{{ $tag }}>
