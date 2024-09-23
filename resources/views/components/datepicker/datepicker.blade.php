<script>
    window.A17 = window.A17 || {};
    window.A17.translations = window.A17.translations || {};
    window.A17.translations.form = window.A17.translations.form || {};
    if (!window.A17.translations.form.datepicker) {
        window.A17.translations.form.datepicker = @json(__('vitrine-ui::fe.form.datepicker'));
    }
</script>

<div data-behavior="DatePicker"
     @if ($minDate) data-DatePicker-min="{{ $minDate }}" @endif
     @if ($maxDate) data-DatePicker-max="{{ $maxDate }}" @endif
     @if ($range) data-DatePicker-range="true" @endif
     @if ($target) data-DatePicker-target="{{ $target }}" @endif
     {{ $attributes->class(['z-9999']) }}>
    <button class="flex items-center gap-8"
            data-DatePicker-trigger
            style="visibility: hidden;">
        <x-vui-icon class="pointer-events-none inline-block text-[#basa55]"
                    name="calendar-24"
                    aria-hidden="true" />
        @if ($showLabel)
            <span class="f-ui-2">{{ __('vitrine-ui::fe.form.datepicker.open_date_picker') }}</span>
            <span class="sr-only">{{ __('vitrine-ui::fe.form.datepicker.open_date_picker_a11y') }}</span>
        @else
            <span class="sr-only">
                {{ __('vitrine-ui::fe.form.datepicker.open_date_picker') }},
                {{ __('vitrine-ui::fe.form.datepicker.open_date_picker_a11y') }}
            </span>
        @endif
    </button>
    <div class="{{ $align === 'left' ? 'left' : 'right' }}-0 absolute top-full"
         data-DatePicker-picker
         role="dialog"
         aria-modal="true"
         aria-hidden="true"
         style="visibility: hidden; opacity: 0;"
         inert>
        <div class="relative z-20 border bg-primary px-12 pb-12 pt-56">
            <wc-datepicker show-clear-button
                           show-today-button></wc-datepicker>
            <x-vui-button class="absolute right-12 top-12"
                          data-DatePicker-close
                          aria-label="{{ __('vitrine-ui::fe.form.datepicker.close_date_picker') }}"
                          icon="close-16"
                          icon-only
                          size="small" />
        </div>
        <div class="fixed inset-0 z-10 bg-transparent"
             data-DatePicker-mask></div>
    </div>
</div>
