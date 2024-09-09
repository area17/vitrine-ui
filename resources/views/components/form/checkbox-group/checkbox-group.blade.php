@props([
    'legend' => '',
    'value' => '',
    'options' => [],
    'disabled' => false,
    'required' => true,
    'hint' => '',
    'note' => '',
])

{{-- todo: refactor me --}}
@php
    $rand = Str::random(4);
    $ariaID = 'ariaID' . $rand;
    $ariaDescribedBy = [];
    if ($hint) {
        $ariaDescribedBy[] = $ariaID . 'Hint';
    }
    if ($note) {
        $ariaDescribedBy[] = $ariaID . 'Note';
    }
@endphp

<fieldset {{ $attributes->twMerge([$ui('checkbox-group', 'base'), 's-disabled' => $disabled]) }}
          {{ $disabled ? 'inert' : '' }}>

    <div class="{{ $ui('checkbox-group', 'wrapper') }}">
        <x-vui-form-label :tag="'legend'"
                          :required="$required">
            {{ $legend }}
        </x-vui-form-label>
        @if ($hint)
            <span class="{{ $ui('checkbox-group', 'hint') }}"
                  id="{{ $ariaID }}Hint">{{ $hint }}</span>
        @endif
    </div>

    @if ($note)
        <p class="{{ $ui('checkbox-group', 'note') }}"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif

    <ol class="{{ $ui('checkbox-group', 'list') }}">
        @foreach ($options as $option)
            <li class="{{ $ui('checkbox-group', 'list-item') }}">
                <x-vui-form-checkbox :label="$option['label'] ?? ''"
                                     :name="$option['name'] ?? ''"
                                     :id="$option['id'] ?? ''"
                                     :value="$option['value'] ?? ''"
                                     :disabled="$option['disabled'] ?? ''"
                                     :required="$option['required'] ?? ''"
                                     :selected="$option['selected'] ?? ''"
                                     :error="$option['error'] ?? ''"
                                     :hint="$option['hint'] ?? ''"
                                     :note="$option['note'] ?? ''"
                                     :inputAttr="$option['inputAttr'] ?? ''"
                                     :autofocus="$option['autofocus'] ?? ''"
                                     :form="$option['form'] ?? ''" />
            </li>
        @endforeach
    </ol>
</fieldset>
