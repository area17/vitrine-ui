@props([
    'label' => '',
    'name' => '',
    'id' => '',
    'value' => '',
    'disabled' => false,
    'selected' => false,
    'required' => false,
    'error' => '',
    'hint' => '',
    'note' => '',
    'inputAttr' => '',
    'autofocus' => false,
    'form' => '',
])

@php
    $rand = Str::random(4);
    $ariaID = 'ariaID'.$rand;
    $errorID = 'errorID'.$rand;
    $ariaDescribedBy = [];
    $ariaDescribedBy[] = $errorID;
    if($hint) {
        $ariaDescribedBy[] = $ariaID.'Hint';
    }
    if($note) {
        $ariaDescribedBy[] = $ariaID.'Note';
    }
@endphp

<div
        data-behavior="Input"
        {{ $attributes->twMerge([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error]) }}
        {{ $disabled ? 'inert' : '' }}
>
    <label class="{{ $ui('radio', 'base') }}" @if($id || $name) for="{{$id ? $id : $name.$rand}}" @endif>
        <div class="{{ $ui('radio', 'wrapper') }}">
            <input
                    type="radio"
                    class="{{ $ui('radio', 'input') }}"
                    @if($id || $name) id="{{$id ? $id : $name.$rand}}" @endif
                    @if($name) name="{{$name}}" @endif
                    @if($value) value="{{$value}}" @endif
                    data-Input-input
                    aria-describedby="{{implode(' ', $ariaDescribedBy)}}"
                    {{ $inputAttr ? ' '.$inputAttr : '' }}
                    {{ $autofocus ? ' autofocus' : '' }}
                    {{ $disabled ? ' disabled' : '' }}
                    {{ $required ? ' required' : '' }}
                    {{ $selected ? ' checked' : '' }}
            />
            <span class="{{ $ui('radio', 'check') }}" aria-hidden="true"></span>

            <span class="{{ $ui('radio', 'label') }}">
                {{$label}}
            </span>
            @if ($hint)
                <span id="{{$ariaID}}Hint" class="{{ $ui('radio', 'hint') }}">{{ $hint }}</span>
            @endif
        </div>
    </label>
    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}"
       style="display: none;" data-Input-error>
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/> {{$error ?? ''}}
    </p>
    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note') }}">{{ $note }}</p>
    @endif
</div>
