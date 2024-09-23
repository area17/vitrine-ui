<script>
    window.A17 = window.A17 || {};
    window.A17.translations = window.A17.translations || {};
    window.A17.translations.form = window.A17.translations.form || {};
    if (!window.A17.translations.form.datepicker) {
        window.A17.translations.form.datepicker = @json(__('vitrine-ui::fe.form.datepicker'));
    }
</script>

<x-vui-form-field data-behavior="DateInput{{ $fuzzy ? 'Fuzzy' : '' }}"
                  data-DatePicker-el="{{ $pickerID ? $pickerID : null }}"
                  type="text"
                  aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
                  :label="$label ?? ''"
                  :id="$id ? $id : $name"
                  :name="$name ?? null"
                  :value="$value ?? null"
                  :placeholder="__('vitrine-ui::fe.form.datepicker.format')"
                  pattern="\d{4}-\d{1,2}-\d{1,2}"
                  :autocomplete="$autocomplete ?? null"
                  :form="$form ?? null"
                  :max="$maxDate ?? null"
                  :min="$minDate ?? null"
                  :autofocus="$autofocus ?? false"
                  :disabled="$disabled ?? false"
                  :readonly="$readonly ?? false"
                  :required="$required ?? false"
                  :with-icon-right="true">

    <x-slot:postLabel>
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
    </x-slot:postLabel>

    <x-slot:preNote>
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
    </x-slot:preNote>

    @if ($pickerID)
        {{-- Optional datepicker --}}
        <x-vui-datepicker class="{{ $ui('input', 'button') }}"
                          :target="$pickerID"
                          :minDate="$minDate"
                          :minDate="$minDate" />
    @endif
</x-vui-form-field>
