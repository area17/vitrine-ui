<script>
    window.A17 = window.A17 || {};
    window.A17.translations = window.A17.translations || {};
    window.A17.translations.form = window.A17.translations.form || {};
    if (!window.A17.translations.form.datepicker) {
        window.A17.translations.form.datepicker = @json(__('vitrine-ui::fe.form.datepicker'));
    }
</script>

<fieldset
    data-behavior="DateTrio"
    role="group"
    aria-describedby="{{implode(' ', $ariaDescribedBy)}}"
    @if($picker)data-DatePicker-el="{{$pickerID}}"@endif
    {{ $attributes->class(['s-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $dataAttrs }}
    {{ $disabled ? 'disabled' : '' }}
    {{ $disabled ? 'inert' : '' }}
>
    <div class="{{  $ui('input', 'header') }}">
        <legend class="{{  $ui('input', 'legend') }}">{{ $legend }}</legend>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="{{ $ui('input', 'hint') }}">{{ $hint }}</span>
        @endif
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note') }}">{{ $note }}</p>
    @endif

    <span class="sr-only" id="{{$ariaID}}Format">{{ __('vitrine-ui::fe.form.datepicker.date_format') }}: {{ date('d m Y') }}</span>
    @if($minDate)<span class="sr-only" id="{{$ariaID}}MinDate" data-DateInput-minDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.minimum_date') }}: {{ $minDate }}</span>@endif
    @if($maxDate)<span class="sr-only" id="{{$ariaID}}MaxDate" data-DateInput-maxDateA11yDisplay>{{ __('vitrine-ui::fe.form.datepicker.maximum_date') }}: {{ $maxDate }}</span>@endif

    @if($picker)
    <x-vui-datepicker
        :target="$pickerID"
        align="left"
        :minDate="$minDate"
        :maxDate="$maxDate"
        showLabel="true"
        class="relative mt-20"
    />
    @endif

    <ol class="flex flex-row flex-wrap sm:flex-nowrap gap-gutter mt-20">
      <li class="w-full sm:w-auto sm:flex-1">
        <div
            data-behavior=""
            {{ $attributes->class(['m-input', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
            {{ $disabled ? 'inert' : '' }}
        >
          <x-vui-form-label name="{{$rand}}Day" :required="$required">
              {{ __('vitrine-ui::fe.form.datepicker.day') }}
          </x-vui-form-label>
          <div class="{{ $ui('input', 'wrapper') }}">
              <input
                  class="{{ $ui('input', 'input') }}"
                  type="text"
                  inputmode="numeric"
                  pattern="\d{1,2}"
                  placeholder="{{ date('j') }}"
                  id="{{$rand}}Day"
                  name="{{$rand}}Day"
                  data-DateTrio-day
                  {{ $autofocus ? ' autofocus' : '' }}
                  {{ $disabled ? ' disabled' : '' }}
                  {{ $readonly ? ' readonly' : '' }}
                  {{ $required ? ' required' : '' }}
                />
            </div>
        </div>
      </li>
      <li class="w-full sm:w-auto sm:flex-1">
        <div
            data-behavior=""
            {{ $attributes->class(['m-input', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
            {{ $disabled ? 'inert' : '' }}
        >
          <x-vui-form-label name="{{$rand}}Month" :required="$required">
              {{ __('vitrine-ui::fe.form.datepicker.month') }}
          </x-vui-form-label>
          <div class="{{ $ui('input', 'wrapper') }}">
                <input
                  class="{{ $ui('input', 'input') }}"
                  type="text"
                  inputmode="numeric"
                  pattern="\d{1,2}"
                  placeholder="{{ date('n') }}"
                  id="{{$rand}}Month"
                  name="{{$rand}}Month"
                  data-DateTrio-month
                  {{ $disabled ? ' disabled' : '' }}
                  {{ $readonly ? ' readonly' : '' }}
                  {{ $required ? ' required' : '' }}
                />
            </div>
        </div>
      </li>
      <li class="w-full sm:w-auto sm:flex-1">
        <div
            data-behavior=""
            {{ $attributes->class(['m-input', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
            {{ $disabled ? 'inert' : '' }}
        >
          <x-vui-form-label name="{{$rand}}Year" :required="$required">
              {{ __('vitrine-ui::fe.form.datepicker.year') }}
          </x-vui-form-label>
          <div class="{{ $ui('input', 'wrapper') }}">
              <input
                  class="{{ $ui('input', 'input') }}"
                  type="text"
                  inputmode="numeric"
                  pattern="\d{2,4}"
                  placeholder="{{ date('Y') }}"
                  id="{{$rand}}Year"
                  name="{{$rand}}Year"
                  data-DateTrio-year
                  {{ $disabled ? ' disabled' : '' }}
                  {{ $readonly ? ' readonly' : '' }}
                  {{ $required ? ' required' : '' }}
                />
            </div>
        </div>
      </li>
    </ol>

    <input
        type="text"
        class="sr-only"
        data-DateTrio-isoinput
        @if($id || $name) id="{{$id ? $id : $name}}" @endif
        @if($name) name="{{$name}}" @endif
        @if($value) value="{{$value}}" @endif
        @if($form) form="{{$form}}" @endif
        @if($minDate) min="{{$minDate}}" @endif
        @if($maxDate) max="{{$maxDate}}" @endif
        {{ $disabled ? ' disabled' : '' }}
        {{ $readonly ? ' readonly' : '' }}
        {{ $required ? ' required' : '' }}
    />

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}" style="display: none;" data-DateTrio-error>
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/>
        {{$error ?? ''}}
    </p>
</fieldset>
