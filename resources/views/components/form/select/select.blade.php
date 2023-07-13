<div
    data-behavior="Input"
    {{ $attributes->class(['m-input', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
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

    <div class="m-input__wrapper relative">
        <select
            class="p-12 pr-36 w-full f-body-1 appearance-none"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
            @if($autocomplete) autocomplete="{{$autocomplete}}" @endif
            aria-describedby="{{implode(',', $ariaDescribedBy)}}"
            data-Input-input
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $multiple ? ' multiple' : '' }}
            {{ $readonly ? ' readonly' : '' }}
            {{ $required ? ' required' : '' }}
        >
            @if($placeholder)
                <option value selected disabled>{{$placeholder}}</option>
            @endif

            @foreach($options as $option)
                <option
                    value="{{ $option['value'] }}"
                    @if(isset($option['selected']) && $option['selected'] == true) selected @endif
                >
                    {{ $option['label'] ?? $option['value'] }}
                </option>
            @endforeach
        </select>

        <x-vui-icon name="chevron-down-24" class="absolute top-1/2 right-[8px] -translate-y-1/2 pointer-events-none" />
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-4">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="mt-4 f-body-1 text-error" style="display: none;" data-Input-error>{{$error ?? ''}}</p>

</div>
