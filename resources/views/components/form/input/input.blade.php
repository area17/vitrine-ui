<div
    data-behavior="Input"
    {{ $attributes->class([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $disabled ? 'inert' : '' }}
>
    <div class="{{  $ui('input', 'header') }}">
        @if(!empty($label))
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @endif
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="{{ $ui('input', 'hint') }}">{{ $hint }}</span>
        @endif
    </div>

    <div class="{{ $ui('input', 'wrapper') }}">
        <input type="{{$type ?? 'text'}}"
            class="{{ $ui('input', 'input') }}"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
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
            aria-describedby="{{implode(',', $ariaDescribedBy)}}"
            data-Input-input
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $multiple ? ' multiple' : '' }}
            {{ $readonly ? ' readonly' : '' }}
            {{ $required ? ' required' : '' }}
        />
        {{ $slot }}
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note') }}">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}" style="display: none;" data-Input-error><x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/>{{$error ?? ''}}</p>

</div>
