<textarea
    {{ $attributes->twMerge([$ui('input', 'textarea')]) }}
    @if($id || $name) id="{{$id ? $id : $name}}" @endif
    @if($name) name="{{$name}}" @endif
    @if($placeholder) placeholder="{{$placeholder}}" @endif
    @if($autocomplete) autocomplete="{{$autocomplete}}" @endif
    @if($form) form="{{$form}}" @endif
    @if($spellcheck) spellcheck="{{$spellcheck ?? 'false'}}" @endif
    @if($wrap) wrap="{{$wrap}}" @endif
    {{ $autofocus ? ' autofocus' : '' }}
    {{ $disabled ? ' disabled' : '' }}
    {{ $readonly ? ' readonly' : '' }}
    {{ $required ? ' required' : '' }}>{{  $value ?? ''}}</textarea>
