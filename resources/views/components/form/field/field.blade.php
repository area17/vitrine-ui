<div
    {{ $attributes->merge(['data-behavior' => $attributes->prepends('Input')])->twMerge(Arr::toCssClasses([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly])) }}
     {{ $disabled ? 'inert' : '' }}>
    <div class="{{ $ui('input', 'header') }}">
        @if (!empty($label))
            <x-vui-form-label :name="$name"
                              :required="$required">
                {{ $label }}
            </x-vui-form-label>
        @endif
        @if ($hint)
            <span class="{{ $ui('input', 'hint') }}"
                  id="{{ $ariaID }}Hint">{{ $hint }}</span>
        @endif
    </div>

    <div class="{{ $ui('input', 'wrapper') }}">
        {{-- Input --}}
        @switch($type)
            @case('textarea')
                {{-- Textarea --}}
                <x-vui-form-textarea class="{{ $ui('input', 'textarea') }}"
                                     data-Input-input=""
                                     aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
                                     :id="$id ? $id : $name"
                                     :name="$name ?? null"
                                     :value="$value ?? null"
                                     :placeholder="$placeholder ?? null"
                                     :autocomplete="$autocomplete ?? null"
                                     :form="$form ?? null"
                                     :spellcheck="$spellcheck ?? null"
                                     :wrap="$wrap ?? null"
                                     :autofocus="$autofocus ?? false"
                                     :disabled="$disabled ?? false"
                                     :multiple="$multiple ?? false"
                                     :readonly="$readonly ?? false"
                                     :required="$required ?? false" />
            @break

            @default
                <x-vui-form-input data-input-input=''
                                  aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
                                  :id="$id ? $id : $name"
                                  :name="$name ?? null"
                                  :type="$type ?? null"
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
                                  :with-icon-right="$withIconRight ?? false" />
            @break
        @endswitch
        {{ $slot }}
    </div>

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
