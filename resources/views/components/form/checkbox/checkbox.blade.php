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
    $ariaDescribedBy[] = '#'.$errorID;
    if($hint) {
        $ariaDescribedBy[] = '#'.$ariaID.'Hint';
    }
    if($note) {
        $ariaDescribedBy[] = '#'.$ariaID.'Note';
    }
@endphp

<div
    data-behavior="Input"
    {{ $attributes->class(['m-input', 's-disabled' => $disabled, 's-error' => $error]) }}
    {{ $disabled ? 'inert' : '' }}
>
    <label class="m-form-checkbox block" for="{{$name}}">
        <input
            type="checkbox"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
            @if($value) value="{{$value}}" @endif
            data-Input-input
            aria-describedby="{{implode(',', $ariaDescribedBy)}}"
            {{ $inputAttr ? ' '.$inputAttr : '' }}
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $required ? ' required' : '' }}
            {{ $selected ? ' checked' : '' }}
        />
        <div class="m-form-checkbox-wrap">
            <span class="m-form-checkbox-check" aria-hidden="true">
                <x-vui-icon name="checkmark-16" class="checkmark" />
            </span>

            <div class="m-form-checkbox-label">
                <span>
                    {{$label}}
                    @if ($required)
                        ({{ __('vitrine-ui::fe.form.required') }})
                    @endif
                </span>
            </div>
            @if ($hint)
                <span id="{{$ariaID}}Hint" class="m-form-checkbox-hint">{{ $hint }}</span>
            @endif
        </div>
    </label>
    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="text-error" style="display: none;" data-Input-error>{{$error ?? ''}}</p>
    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-4">{{ $note }}</p>
    @endif
</div>
