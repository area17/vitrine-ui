<x-vui-form-field data-behavior="PasswordInput"
                  type="password"
                  aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
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
                  :with-icon-right="true">
    <button class="absolute right-12 top-1/2 -translate-y-1/2"
            data-PasswordInput-toggle>
        <x-vui-icon class="pointer-events-none inline-block text-[#basa55]"
                    name="eye-hide-24"
                    data-PasswordInput-iconhidden
                    aria-hidden="true" />
        <x-vui-icon class="pointer-events-none inline-block text-[#basa55]"
                    name="eye-24"
                    data-PasswordInput-iconshown
                    aria-hidden="true"
                    style="display: none;" />
        <span class="sr-only">{{ __('vitrine-ui::fe.form.toggle_password_visibility') }}</span>
    </button>
</x-vui-form-field>
