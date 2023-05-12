@props([
    'label' => '',
    'name' => '',
    'tag' => 'label',
    'required' => false
])

<{{$tag}}
    class="block f-body-1 font-medium"
    @if($name) for="{{$name}}" @endif
>
    @if ($slot && !$slot->isEmpty())
        {{$slot}}
    @endif

    @if ($required)
        ({{ __('vitrine-ui::fe.form.required') }})
    @endif
</{{$tag}}>
