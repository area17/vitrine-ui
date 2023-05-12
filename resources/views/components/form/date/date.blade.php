<script>
    window.A17 = window.A17 || {};
    window.A17.translations = window.A17.translations || {};
    window.A17.translations.form = window.A17.translations.form || {};
    if (!window.A17.translations.form.datepicker) {
        window.A17.translations.form.datepicker = @json(__('vitrine-ui::fe.form.datepicker'));
    }
</script>

<div
    data-behavior="Input DateInput{{ $fuzzy ? 'Fuzzy' : '' }}"
    @if($picker)data-DatePicker-el="{{$pickerID}}"@endif
    {{ $attributes->class(['m-input', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $dataAttrs }}
    {{ $disabled ? 'inert' : '' }}>

    <div class="flex flex-row flex-nowrap justify-between items-baseline gap-gutter">
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="f-ui-2 text-secondary">{{ $hint }}</span>
        @endif
    </div>

    {{--
        screen reader only labels - linked with `aria-describedby`
        (maybe hidden if inside of a date picker as not to overwhelm screen readers)
    --}}
    @unless($hideA11yLabels)
        <span class="sr-only" id="{{$ariaID}}Format">{{ __('vitrine-ui::fe.form.datepicker.date_format') }}: {{ __('vitrine-ui::fe.form.datepicker.format') }}</span>
        @if($minDate)<span class="sr-only" id="{{$ariaID}}MinDate" data-DateInput-minDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.minimum_date') }}: {{ $minDate }}</span>@endif
        @if($maxDate)<span class="sr-only" id="{{$ariaID}}MaxDate" data-DateInput-maxDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.maximum_date') }}: {{ $maxDate }}</span>@endif
    @endunless

    <div class="m-input__wrapper">
        @if($picker)
        {{-- Optional datepicker --}}
        <x-vui-datepicker
            :target="$pickerID"
            :minDate="$minDate"
            :minDate="$minDate"
            class="absolute right-12 top-1/2 -translate-y-1/2 mt-2"
        />
        @endif
        {{-- Visible input to user --}}
        <input
            class="p-12 pr-40 w-full f-body-1"
            type="text"
            placeholder="{{ __('vitrine-ui::fe.form.datepicker.format') }}"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
            @if($value) value="{{$value}}" @endif
            @if($minDate) min="{{$minDate}}" @endif
            @if($maxDate) max="{{$maxDate}}" @endif
            @if($form) form="{{$form}}" @endif
            pattern="\d{4}-\d{1,2}-\d{1,2}"
            aria-describedby="{{implode(',', $ariaDescribedBy)}}"
            data-DateInput-input
            data-Input-input
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $readonly ? ' readonly' : '' }}
            {{ $required ? ' required' : '' }}
        />
    </div>

    {{--
        IF JS is enabled, this is actual input that will be submitted
        Why? Because the visible input will display ISO entry and Today/Tomorrow
        This hidden input will only get VALID ISO YYYY-MM-DD dates
    --}}
    <input type="hidden" data-DateInput-isoinput />
    {{-- Output for screen reader users, to confirm entry, give warnings --}}
    <output
        class="sr-only"
        name="{{$name}}Result"
        for="{{$name}}"
        data-DateInput-output
    ></output>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-4">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="mt-4 f-body-1 text-error" style="display: none;" data-Input-error>{{$error ?? ''}}</p>

</div>
