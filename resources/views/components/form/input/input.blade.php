<input type="{{$type ?? 'text'}}"
    {{ $attributes->class([$ui('input', 'input'), $ui('input', 'input-icon-right') => $withIconRight ?? false]) }}
    @if($id || $name) id="{{$id ? $id : $name}}" @endif
    @if($name) name="{{$name}}" @endif
    @if($inputmode) inputmode="{{$inputmode}}" @endif
    @if($value) value="{{$value}}" @endif
    @if($placeholder) placeholder="{{$placeholder}}" @endif
    @if($pattern) pattern="{{$pattern}}" @endif
    @if($autocomplete) autocomplete="{{$autocomplete}}" @endif
    @if($form) form="{{$form}}" @endif
    @if($list) list="{{$list}}" @endif
    @if($max) max="{{$max}}" @endif
    @if($maxlength) maxlength="{{$maxlength}}" @endif
    @if($min) min="{{$min}}" @endif
    @if($minlength) minlength="{{$minlength}}" @endif
    @if($step) step="{{$step}}" @endif
    {{ $autofocus ? ' autofocus' : '' }}
    {{ $disabled ? ' disabled' : '' }}
    {{ $multiple ? ' multiple' : '' }}
    {{ $readonly ? ' readonly' : '' }}
    {{ $required ? ' required' : '' }}
/>
