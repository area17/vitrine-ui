<div
    data-behavior="PasswordInput Input"
    {{ $attributes->twMerge(['m-input', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $disabled ? 'inert' : '' }}
>

    <div class="flex flex-row flex-nowrap justify-between items-baseline gap-gutter">
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="f-ui-2 text-secondary">{{ $hint }}</span>
        @endif
    </div>

    <div class="m-input__wrapper">
        <button class="absolute right-12 top-1/2 -translate-y-1/2" data-PasswordInput-toggle>
            <x-vui-icon
                class="inline-block text-[#basa55] pointer-events-none"
                name="eye-hide-24"
                aria-hidden="true"
                data-PasswordInput-iconhidden />
            <x-vui-icon
                class="inline-block text-[#basa55] pointer-events-none"
                name="eye-24"
                aria-hidden="true"
                style="display: none;"
                data-PasswordInput-iconshown />
            <span class="sr-only">{{ __('vitrine-ui::fe.form.toggle_password_visibility') }}</span>
        </button>

        <input type="password"
            class="p-12 pr-40 w-full f-body-1"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
            @if($value) value="{{$value}}" @endif
            @if($placeholder) placeholder="{{$placeholder}}" @endif
            @if($autocomplete) autocomplete="{{$autocomplete}}" @endif
            @if($form) form="{{$form}}" @endif
            aria-describedby="{{implode(' ', $ariaDescribedBy)}}"
            data-Input-input
            data-PasswordInput-input
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $readonly ? ' readonly' : '' }}
            {{ $required ? ' required' : '' }}
        />
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-4">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="mt-4 f-body-1 text-error" style="display: none;" data-Input-error>{{$error ?? ''}}</p>

</div>
