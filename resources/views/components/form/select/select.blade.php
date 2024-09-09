<div data-behavior="Input"
     {{ $attributes->twMerge([$ui('select', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
     {{ $disabled ? 'inert' : '' }}>

    <div class="{{ $ui('select', 'header') }}">
        <x-vui-form-label :name="$name"
                          :required="$required">
            {{ $label }}
        </x-vui-form-label>
        @if ($hint)
            <span class="{{ $ui('select', 'hint') }}"
                  id="{{ $ariaID }}Hint">{{ $hint }}</span>
        @endif
    </div>

    <div class="{{ $ui('select', 'wrapper') }}">
        <select class="{{ $ui('select', 'select') }}"
                data-Input-input
                aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
                @if ($id || $name) id="{{ $id ? $id : $name }}" @endif
                @if ($name) name="{{ $name }}" @endif
                @if ($autocomplete) autocomplete="{{ $autocomplete }}" @endif
                {{ $autofocus ? ' autofocus' : '' }}
                {{ $disabled ? ' disabled' : '' }}
                {{ $multiple ? ' multiple' : '' }}
                {{ $readonly ? ' readonly' : '' }}
                {{ $required ? ' required' : '' }}>
            @if ($placeholder)
                <option value
                        selected
                        disabled>{{ $placeholder }}</option>
            @endif

            @foreach ($options as $option)
                <option value="{{ $option['value'] }}"
                        @if (isset($option['selected']) && $option['selected'] == true) selected @endif>
                    {{ $option['label'] ?? $option['value'] }}
                </option>
            @endforeach
        </select>

        <x-vui-icon class="{{ $ui('select', 'icon') }}"
                    name="{{ $ui('select', 'icon-name') }}" />
    </div>

    @if ($note)
        <p class="{{ $ui('select', 'note') }}"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif

    <p class="{{ $ui('select', 'error') }}"
       id="{{ $errorID }}"
       data-Input-error
       aria-live="assertive"
       aria-relevant="additions removals"
       style="display: none;"><x-vui-icon name="{{ $ui('select', 'error-icon-name') }}" />{{ $error ?? '' }}</p>

</div>
