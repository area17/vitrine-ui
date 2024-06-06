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
    'icon' => 'checkmark-16',
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
        {{ $attributes->class([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error]) }}
        {{ $disabled ? 'inert' : '' }}
>
    <label class="{{ $ui('checkbox', 'base') }}"
           @if($id || $name) for="{{$id ? $id : $name.$rand}}" @endif>
        <div class="{{ $ui('checkbox', 'wrapper') }}">
            <input
                    type="checkbox"
                    class="{{ $ui('checkbox', 'input') }}"
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
            <span class="{{ $ui('checkbox', 'check') }}" aria-hidden="true">
                <x-vui-icon :name="$icon" class="{{ $ui('checkbox', 'checkmark') }}"/>
            </span>

            <span class="{{ $ui('checkbox', 'label') }}">
                {{$label}}
                @if ($required)
                    {{ __('vitrine-ui::fe.form.required') }}
                @endif
            </span>
            @if ($hint)
                <span id="{{$ariaID}}Hint" class="{{$ui('checkbox', 'hint')}}">{{ $hint }}</span>
            @endif
        </div>
    </label>
    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}"
       style="display: none;" data-Input-error>
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/> {{$error ?? ''}}
    </p>
    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note')  }}">{{ $note }}</p>
    @endif
</div>
