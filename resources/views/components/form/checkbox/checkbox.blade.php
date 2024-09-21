<div
        data-behavior="Input"
        {{ $attributes->class([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error]) }}
        {{ $disabled ? 'inert' : '' }}
>
    <label class="{{ $ui('checkbox', 'base') }}"
           @if($id) for="{{$id}}" @endif>
        <div class="{{ $ui('checkbox', 'wrapper') }}">
            <input
                    type="checkbox"
                    class="{{ $ui('checkbox', 'input') }}"
                    @if($id) id="{{ $id }}" @endif
                    @if($name) name="{{$name}}" @endif
                    @if($value) value="{{$value}}" @endif
                    data-Input-input
                    aria-describedby="{{implode(' ', $ariaDescribedBy)}}"
                    {{ $inputAttr ? ' '.$inputAttr : '' }}
                    {{ $autofocus ? ' autofocus' : '' }}
                    {{ $disabled ? ' disabled' : '' }}
                    {{ $required ? ' required' : '' }}
                    {{ $selected ? ' checked' : '' }}
            />
            <span class="{{ $ui('checkbox', 'check') }}" aria-hidden="true">
                <x-vui-icon :name="$icon" class="{{ $ui('checkbox', 'checkmark') }}"/>
            </span>

            <span class="{{ $ui('checkbox', 'label') }}">
                {{$label}}
                @if ($required)
                    {{ __('vitrine-ui::fe.form.required') }}
                @endif
            </span>
            @if ($hint)
                <span id="{{$ariaID}}Hint" class="{{$ui('checkbox', 'hint')}}">{{ $hint }}</span>
            @endif
        </div>
    </label>
    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}"
       style="display: none;" data-Input-error>
        <x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/> {{$error ?? ''}}
    </p>
    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note')  }}">{{ $note }}</p>
    @endif
</div>
