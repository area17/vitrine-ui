<script>
    window.A17 = window.A17 || {};
    window.A17.translations = window.A17.translations || {};
    window.A17.translations.form = window.A17.translations.form || {};
    if (!window.A17.translations.form.datepicker) {
        window.A17.translations.form.datepicker = @json(__('vitrine-ui::fe.form.datepicker'));
    }
</script>

<div data-behavior="Input DateInput{{ $fuzzy ? 'Fuzzy' : '' }}"
     @if ($picker) data-DatePicker-el="{{ $pickerID }}" @endif
     {{ $attributes->twMerge(Arr::toCssClasses([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly])) }}
     {{ $dataAttrs }}
     {{ $disabled ? 'inert' : '' }}>

    <div class="{{ $ui('input', 'header') }}">
        <x-vui-form-label :name="$name"
                          :required="$required">
            {{ $label }}
        </x-vui-form-label>
        @if ($hint)
            <span class="{{ $ui('input', 'hint') }}"
                  id="{{ $ariaID }}Hint">{{ $hint }}</span>
        @endif
    </div>

    {{--
        screen reader only labels - linked with `aria-describedby`
        (maybe hidden if inside of a date picker as not to overwhelm screen readers)
    --}}
    @unless ($hideA11yLabels)
        <span class="sr-only"
              id="{{ $ariaID }}Format">{{ __('vitrine-ui::fe.form.datepicker.date_format') }}:
            {{ __('vitrine-ui::fe.form.datepicker.format') }}</span>
        @if ($minDate)
            <span class="sr-only"
                  id="{{ $ariaID }}MinDate"
                  data-DateInput-minDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.minimum_date') }}:
                {{ $minDate }}</span>
        @endif
        @if ($maxDate)
            <span class="sr-only"
                  id="{{ $ariaID }}MaxDate"
                  data-DateInput-maxDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.maximum_date') }}:
                {{ $maxDate }}</span>
        @endif
    @endunless

    <div class="{{ $ui('input', 'wrapper') }}">
        @if ($picker)
            {{-- Optional datepicker --}}
            <x-vui-datepicker class="right-12top-1/2 absolute mt-2 -translate-y-1/2"
                              :target="$pickerID"
                              :minDate="$minDate"
                              :minDate="$minDate" />
        @endif
        {{-- Visible input to user --}}
        <input class="{{ $ui('input', 'input') }} pr-40"
               data-DateInput-input
               data-Input-input
               type="text"
               aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
               placeholder="{{ __('vitrine-ui::fe.form.datepicker.format') }}"
               @if ($id || $name) id="{{ $id ? $id : $name }}" @endif
               @if ($name) name="{{ $name }}" @endif
               @if ($value) value="{{ $value }}" @endif
               @if ($minDate) min="{{ $minDate }}" @endif
               @if ($maxDate) max="{{ $maxDate }}" @endif
               @if ($form) form="{{ $form }}" @endif
               pattern="\d{4}-\d{1,2}-\d{1,2}"
               {{ $autofocus ? ' autofocus' : '' }}
               {{ $disabled ? ' disabled' : '' }}
               {{ $readonly ? ' readonly' : '' }}
               {{ $required ? ' required' : '' }} />
    </div>

    {{--
        IF JS is enabled, this is actual input that will be submitted
        Why? Because the visible input will display ISO entry and Today/Tomorrow
        This hidden input will only get VALID ISO YYYY-MM-DD dates
    --}}
    <input data-DateInput-isoinput
           type="hidden" />
    {{-- Output for screen reader users, to confirm entry, give warnings --}}
    <output class="sr-only"
            name="{{ $name }}Result"
            data-DateInput-output
            for="{{ $name }}"></output>

    @if ($note)
        <p class="{{ $ui('input', 'note') }}"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif

    <p class="{{ $ui('input', 'error') }}"
       id="{{ $errorID }}"
       data-Input-error
       aria-live="assertive"
       aria-relevant="additions removals"
       style="display: none;">
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}" />{{ $error ?? '' }}
    </p>

</div>
