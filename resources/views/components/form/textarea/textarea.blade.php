<div
    data-behavior="Input"
    {{ $attributes->class([$ui('input', 'base'), 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
    {{ $disabled ? 'inert' : '' }}>

    <div class="{{  $ui('input', 'header') }}">
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="{{  $ui('input', 'hint') }}">{{ $hint }}</span>
        @endif
    </div>

    <div class="{{ $ui('input', 'wrapper') }}">
        <textarea
            class="{{ $ui('input', 'textarea') }}"
            @if($id || $name) id="{{$id ? $id : $name}}" @endif
            @if($name) name="{{$name}}" @endif
            @if($placeholder) placeholder="{{$placeholder}}" @endif
            @if($autocomplete) autocomplete="{{$autocomplete}}" @endif
            @if($form) form="{{$form}}" @endif
            aria-describedby="{{implode(',', $ariaDescribedBy)}}"
            data-Input-input
            {{ $autofocus ? ' autofocus' : '' }}
            {{ $disabled ? ' disabled' : '' }}
            {{ $readonly ? ' readonly' : '' }}
            {{ $required ? ' required' : '' }}>
            {{$value ?? ''}}
        </textarea>
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="{{ $ui('input', 'note') }}">{{ $note }}</p>
    @endif

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="{{ $ui('input', 'error') }}" style="display: none;" data-Input-error><x-vui-icon name="{{ $ui('input', 'error-icon-name') }}"/>{{$error ?? ''}}</p>

</div>
