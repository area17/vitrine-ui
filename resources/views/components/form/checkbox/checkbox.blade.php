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

<div {{ $attributes->merge(['data-behavior' => $attributes->prepends('Input')])->twMerge(Arr::toCssClasses([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error])) }}
     {{ $disabled ? 'inert' : '' }}>
    <label class="{{ $ui('checkbox', 'base') }}"
           @if ($id || $name) for="{{ $id ? $id : $name . $rand }}" @endif>
        <div class="{{ $ui('checkbox', 'wrapper') }}">
            <input class="{{ $ui('checkbox', 'input') }}"
                   data-Input-input
                   type="checkbox"
                   aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
                   @if ($id || $name) id="{{ $id ? $id : $name . $rand }}" @endif
                   @if ($name) name="{{ $name }}" @endif
                   @if ($value) value="{{ $value }}" @endif
                   {{ $inputAttr ? ' ' . $inputAttr : '' }}
                   {{ $autofocus ? ' autofocus' : '' }}
                   {{ $disabled ? ' disabled' : '' }}
                   {{ $required ? ' required' : '' }}
                   {{ $selected ? ' checked' : '' }} />
            <span class="{{ $ui('checkbox', 'check') }}"
                  aria-hidden="true">
                <x-vui-icon class="{{ $ui('checkbox', 'checkmark') }}"
                            :name="$icon" />
            </span>

            <span class="{{ $ui('checkbox', 'label') }}">
                {{ $label }}
                @if ($required)
                    <span class="{{ $ui('checkbox', 'required') }}">
                        {{ __('vitrine-ui::fe.form.required') }}
                    </span>
                @endif
            </span>
            @if ($hint)
                <span class="{{ $ui('checkbox', 'hint') }}"
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
