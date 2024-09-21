<x-vui-form-field
    type="password"
    :label="$label ?? ''"
    :id="$id ? $id : $name"
    :name="$name ?? null"
    :value="$value ?? null"
    :placeholder="$placeholder ?? null"
    :pattern="$pattern ?? null"
    :autocomplete="$autocomplete ?? null"
    :form="$form ?? null"
    :list="$list ?? null"
    :max="$max ?? null"
    :maxlength="$maxlength ?? null"
    :min="$min ?? null"
    :minlength="$minlength ?? null"
    :step="$step ?? null"
    :autofocus="$autofocus ?? false"
    :disabled="$disabled ?? false"
    :multiple="$multiple ?? false"
    :readonly="$readonly ?? false"
    :required="$required ?? false"
    aria-describedby="{{implode(' ', $ariaDescribedBy)}}"
    data-behavior="PasswordInput"
    :with-icon-right="true"
>
    <button class="{{ $ui('input-password', 'base') }}" data-PasswordInput-toggle>
        <x-vui-icon
            class="{{ $ui('input-password', 'icon') }}"
            name="{{ $ui('input-password', 'icon-hide') }}"
            aria-hidden="true"
            data-PasswordInput-iconhidden />
        <x-vui-icon
            class="{{ $ui('input-password', 'icon') }}"
            name="{{ $ui('input-password', 'icon-show') }}"
            aria-hidden="true"
            style="display: none;"
            data-PasswordInput-iconshown />
        <span class="sr-only">{{ __('vitrine-ui::fe.form.toggle_password_visibility') }}</span>
    </button>
</x-vui-form-field>
