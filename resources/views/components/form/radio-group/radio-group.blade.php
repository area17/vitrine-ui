<fieldset data-behavior="RadioGroup"
          aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
          {{ $attributes->twMerge(Arr::toCssClasses([$ui('radio-group', 'base'), 's-disabled' => $disabled, 's-error' => $error])) }}
          {{ $disabled ? 'inert' : '' }}>

    <div class="{{ $ui('radio-group', 'wrapper') }}">
        <x-vui-form-label :name="$name"
                          :tag="'legend'"
                          :required="$required">
            {{ $legend }}
        </x-vui-form-label>
        @if ($hint)
            <span class="{{ $ui('radio-group', 'hint') }}"
                  id="{{ $ariaID }}Hint">{{ $hint }}</span>
        @endif
    </div>

    @if ($note)
        <p class="{{ $ui('radio-group', 'note') }}"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif

    <ol class="{{ $ui('radio-group', 'list') }}">
        @foreach ($options as $option)
            <li class="{{ $ui('radio-group', 'list-item') }}">
                <x-vui-form-radio :label="$option['label'] ?? ''"
                                  :name="$name ?? ($option['name'] ?? '')"
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

    <p class="f-body-1 mt-12 text-error"
       id="{{ $errorID }}"
       data-RadioGroup-error
       aria-live="assertive"
       aria-relevant="additions removals"
       style="display: none;">{{ $error ?? '' }}</p>
</fieldset>
