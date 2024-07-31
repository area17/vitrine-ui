<fieldset
    data-behavior="RadioGroup"
    {{ $attributes->class([$ui('radio-group', 'base'), 's-disabled' => $disabled, 's-error' => $error]) }}
    aria-describedby="{{implode(' ', $ariaDescribedBy)}}"
    {{ $disabled ? 'inert' : '' }}>

    <div class="{{$ui('radio-group', 'wrapper')}}">
        <x-vui-form-label :name="$name" :tag="'legend'" :required="$required">
            {{$legend}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="{{$ui('radio-group', 'hint')}}">{{ $hint }}</span>
        @endif
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="{{$ui('radio-group', 'note')}}">{{ $note }}</p>
    @endif

    <ol class="{{$ui('radio-group', 'list')}}">
        @foreach($options as $option)
            <li class="{{$ui('radio-group', 'list-item')}}">
                <x-vui-form-radio
                    :label="$option['label'] ?? ''"
                    :name="$name ?? $option['name'] ?? ''"
                    :id="$option['id'] ?? ''"
                    :value="$option['value'] ?? ''"
                    :disabled="$option['disabled'] ?? ''"
                    :required="$option['required'] ?? ''"
                    :selected="$option['selected'] ?? ''"
                    :error="$option['error'] ?? ''"
                    :hint="$option['hint'] ?? ''"
                    :note="$option['note'] ?? ''"
                    :inputAttr="$option['inputAttr'] ?? ''"
                    :autofocus="$option['autofocus'] ?? ''"
                    :form="$option['form'] ?? ''"
                />
            </li>
        @endforeach
    </ol>

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="mt-12 f-body-1 text-error" style="display: none;" data-RadioGroup-error>{{$error ?? ''}}</p>
</fieldset>
