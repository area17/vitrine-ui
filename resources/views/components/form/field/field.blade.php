<div
    data-behavior="Input"
    {{ $attributes->class([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $disabled ? 'inert' : '' }}
>
    <div class="{{  $ui('input', 'header') }}">
        @if(!empty($label))
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @endif
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="{{ $ui('input', 'hint') }}">{{ $hint }}</span>
        @endif
    </div>

    <div class="{{ $ui('input', 'wrapper') }}">
        {{-- Input --}}
        @switch($type)
            @case('textarea')
                {{-- Textarea --}}
                <x-vui-form-textarea
                    data-Input-input=""
                    class="{{ $ui('input', 'textarea') }}"
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
                    :required="$required ?? false"
                    aria-describedby="{{implode(',', $ariaDescribedBy)}}"/>
            @break
            @default
                <x-vui-form-input
                    data-input-input=''
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
                    aria-describedby="{{implode(',', $ariaDescribedBy)}}"
                />
            @break
        @endswitch
        {{ $slot }}
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note') }}">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}" style="display: none;" data-Input-error>
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/>{{$error ?? ''}}
    </p>
</div>
