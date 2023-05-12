@storybook([
    'status' => 'readyForQA',
    'args' => [
        'label' => 'Label',
        'name' => 'label',
        'tag' => 'label',
        'required' => false
    ]

])

<x-vui-form-label
    :name="$name ?? null"
    :tag="$tag ?? null"
    :required="$required ?? null"
>
    {{ $label ?? 'Label' }}
</x-vui-form-label>
