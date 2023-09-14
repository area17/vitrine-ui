<div
    data-behavior="Input"
    {{ $attributes->class([$ui('select', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $disabled ? 'inert' : '' }}
>

    <div class="{{  $ui('select', 'header') }}">
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="{{ $ui('select', 'hint') }}">{{ $hint }}</span>
        @endif
    </div>

    <div class="{{ $ui('select', 'wrapper') }}">
        <select
            class="p-12 pr-36 w-full f-body-1 appearance-none"
            class="{{ $ui('select', 'select') }}"
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

        <x-vui-icon name="{{ $ui('select', 'icon-name') }}" class="{{ $ui('select', 'icon') }}" />
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('select', 'note') }}">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('select', 'error') }}" style="display: none;" data-Input-error><x-vui-icon name="{{ $ui('select', 'error-icon-name') }}"/>{{$error ?? ''}}</p>

</div>
