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
    $ariaID = 'ariaID' . $rand;
    $errorID = 'errorID' . $rand;
    $ariaDescribedBy = [];
    $ariaDescribedBy[] = $errorID;
    if ($hint) {
        $ariaDescribedBy[] = $ariaID . 'Hint';
    }
    if ($note) {
        $ariaDescribedBy[] = $ariaID . 'Note';
    }
@endphp

<div data-behavior="Input"
     {{ $attributes->twMerge([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error]) }}
     {{ $disabled ? 'inert' : '' }}>
    <label class="{{ $ui('radio', 'base') }}"
           @if ($id || $name) for="{{ $id ? $id : $name . $rand }}" @endif>
        <div class="{{ $ui('radio', 'wrapper') }}">
            <input class="{{ $ui('radio', 'input') }}"
                   data-Input-input
                   type="radio"
                   aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
                   @if ($id || $name) id="{{ $id ? $id : $name . $rand }}" @endif
                   @if ($name) name="{{ $name }}" @endif
                   @if ($value) value="{{ $value }}" @endif
                   {{ $inputAttr ? ' ' . $inputAttr : '' }}
                   {{ $autofocus ? ' autofocus' : '' }}
                   {{ $disabled ? ' disabled' : '' }}
                   {{ $required ? ' required' : '' }}
                   {{ $selected ? ' checked' : '' }} />
            <span class="{{ $ui('radio', 'check') }}"
                  aria-hidden="true"></span>

            <span class="{{ $ui('radio', 'label') }}">
                {{ $label }}
            </span>
            @if ($hint)
                <span class="{{ $ui('radio', 'hint') }}"
                      id="{{ $ariaID }}Hint">{{ $hint }}</span>
            @endif
        </div>
    </label>
    <p class="{{ $ui('input', 'error') }}"
       id="{{ $errorID }}"
       data-Input-error
       aria-live="assertive"
       aria-relevant="additions removals"
       style="display: none;">
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}" /> {{ $error ?? '' }}
    </p>
    @if ($note)
        <p class="{{ $ui('input', 'note') }}"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif
</div>
