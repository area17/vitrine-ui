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

    <div class="m-input__wrapper">
        <input type="{{$type||'text'}}"
            class="p-12 w-full f-body-1"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
            @if($value) value="{{$value}}" @endif
            @if($placeholder) placeholder="{{$placeholder}}" @endif
            @if($pattern) pattern="{{$pattern}}" @endif
            @if($autocomplete) autocomplete="{{$autocomplete}}" @endif
            @if($form) form="{{$form}}" @endif
            @if($list) list="{{$list}}" @endif
            @if($max) max="{{$max}}" @endif
            @if($maxlength) maxlength="{{$maxlength}}" @endif
            @if($min) min="{{$min}}" @endif
            @if($minlength) minlength="{{$minlength}}" @endif
            @if($step) step="{{$step}}" @endif
            aria-describedby="{{implode(',', $ariaDescribedBy)}}"
            data-Input-input
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $multiple ? ' multiple' : '' }}
            {{ $readonly ? ' readonly' : '' }}
            {{ $required ? ' required' : '' }}
        />
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-4">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="mt-4 f-body-1 text-error" style="display: none;" data-Input-error>{{$error ?? ''}}</p>

</div>
