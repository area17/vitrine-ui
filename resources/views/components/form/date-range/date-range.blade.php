<fieldset
    role="group"
    data-behavior="DateRange"
    @if($minDate)data-DateRange-minDate="{{ $minDate }}"@endif
    @if($maxDate)data-DateRange-maxDate="{{ $maxDate }}"@endif
    @if($picker)data-DatePicker-el="{{ $pickerID }}"@endif
    class="{{ $disabled ? 'opacity-50 ' : '' }}"
    aria-labelledby="{{implode(' ', $ariaDescribedBy)}}"
    {{ $disabled ? 'inert' : '' }}
>
    <div class="flex flex-row flex-nowrap justify-between items-baseline gap-gutter">
        <legend class="f-subhead-3">{{ $legend }}</legend>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="f-ui-2 text-secondary">{{ $hint }}</span>
        @endif
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-12">{{ $note }}</p>
    @endif

    {{-- screen reader only labels - linked with `aria-describedby` --}}
    <span class="sr-only" id="{{$ariaID}}Format">{{ __('vitrine-ui::fe.form.datepicker.date_format') }}: {{ __('vitrine-ui::fe.form.datepicker.format') }}</span>
    @if($minDate)<span class="sr-only" id="{{$ariaID}}MinDate" data-DateRange-minDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.minimum_date') }}: {{ $minDate }}</span>@endif
    @if($maxDate)<span class="sr-only" id="{{$ariaID}}MaxDate" data-DateRange-maxDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.maximum_date') }}: {{ $maxDate }}</span>@endif

    @if($picker)
    <x-vui-datepicker
        :target="$pickerID"
        align="left"
        :range="true"
        :minDate="$minDate"
        :maxDate="$maxDate"
        showLabel="true"
        class="relative mt-20"
    />
    @endif

    <ol class="flex flex-row flex-wrap sm:flex-nowrap gap-gutter mt-20">
        <li class="w-full sm:w-auto sm:flex-1">
            <x-vui-form-date
                :label="$from['label'] ?? ''"
                :value="$from['value'] ?? ''"
                :name="$from['name'] ?? ''"
                :id="$from['id'] ?? ''"
                :error="$from['error'] ?? ''"
                :hint="$from['hint'] ?? ''"
                :note="$from['note'] ?? ''"
                :type="$from['type'] ?? ''"
                :disabled="$from['disabled'] ?? false"
                :required="$from['required'] ?? false"
                :minDate="$from['minDate'] ?? ''"
                :maxDate="$from['maxDate'] ?? ''"
                :fuzzy="$from['fuzzy'] ?? ''"
                :picker="$from['picker'] ?? ''"
                :autofocus="$from['autofocus'] ?? ''"
                :form="$from['form'] ?? ''"
                :readonly="$from['readonly'] ?? ''"
                dataAttrs="data-DateRange-from"
                hideA11yLabels="true"
            />
        </li>
        <li class="w-full sm:w-auto sm:flex-1">
            <x-vui-form-date
                :label="$to['label'] ?? ''"
                :value="$to['value'] ?? ''"
                :name="$to['name'] ?? ''"
                :id="$to['id'] ?? ''"
                :error="$to['error'] ?? ''"
                :hint="$to['hint'] ?? ''"
                :note="$to['note'] ?? ''"
                :type="$to['type'] ?? ''"
                :disabled="$to['disabled'] ?? false"
                :required="$to['required'] ?? false"
                :minDate="$to['minDate'] ?? ''"
                :maxDate="$to['maxDate'] ?? ''"
                :fuzzy="$to['fuzzy'] ?? ''"
                :picker="$to['picker'] ?? ''"
                :autofocus="$to['autofocus'] ?? ''"
                :form="$to['form'] ?? ''"
                :readonly="$to['readonly'] ?? ''"
                dataAttrs="data-DateRange-to"
                hideA11yLabels="true"
            />
        </li>
    </ol>
</fieldset>
