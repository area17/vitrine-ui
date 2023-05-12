<script>
    window.A17 = window.A17 || {};
    window.A17.translations = window.A17.translations || {};
    window.A17.translations.form = window.A17.translations.form || {};
    if (!window.A17.translations.form.datepicker) {
        window.A17.translations.form.datepicker = @json(__('vitrine-ui::fe.form.datepicker'));
    }
</script>

<div
    data-behavior="DatePicker"
    @if($minDate)data-DatePicker-min="{{$minDate}}"@endif
    @if($maxDate)data-DatePicker-max="{{$maxDate}}"@endif
    @if($range)data-DatePicker-range="true"@endif
    @if($target)data-DatePicker-target="{{$target}}"@endif
    {{ $attributes->class(['z-9999']) }}
>
    <button
        class="flex items-center gap-8"
        style="visibility: hidden;"
        data-DatePicker-trigger
    >
        <x-vui-icon
            class="inline-block text-[#basa55] pointer-events-none"
            name="calendar-24"
            aria-hidden="true" />
        @if($showLabel)
            <span class="f-ui-2">{{ __('vitrine-ui::fe.form.datepicker.open_date_picker') }}</span>
            <span class="sr-only">{{ __('vitrine-ui::fe.form.datepicker.open_date_picker_a11y') }}</span>
        @else
            <span class="sr-only">
                {{ __('vitrine-ui::fe.form.datepicker.open_date_picker') }},
                {{ __('vitrine-ui::fe.form.datepicker.open_date_picker_a11y') }}
            </span>
        @endif
    </button>
    <div
        role="dialog"
        aria-modal="true"
        aria-hidden="true"
        class="absolute {{ $align === 'left' ? 'left' : 'right'}}-0 top-full"
        style="visibility: hidden; opacity: 0;"
        data-DatePicker-picker
        inert
    >
        <div class="relative z-20 pt-56 pb-12 px-12 border bg-primary">
            <wc-datepicker show-clear-button show-today-button></wc-datepicker>
            <x-vui-button-icon
                icon="close-16"
                size="small"
                class="absolute right-12 top-12"
                aria-label="{{ __('vitrine-ui::fe.form.datepicker.close_date_picker') }}"
                data-DatePicker-close
            />
        </div>
        <div
            class="fixed z-10 inset-0 bg-transparent"
            data-DatePicker-mask
        ></div>
    </div>
</div>
