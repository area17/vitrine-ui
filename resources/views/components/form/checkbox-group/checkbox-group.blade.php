@props([
    'legend' => '',
    'type' => 'text',
    'value' => '',
    'options' => [],
    'disabled' => false,
    'required' => true,
    'hint' => '',
    'note' => '',
])

@php
    $rand = Str::random(4);
    $ariaID = 'ariaID'.$rand;
    $ariaDescribedBy = [];
    if($hint) {
        $ariaDescribedBy[] = $ariaID.'Hint';
    }
    if($note) {
        $ariaDescribedBy[] = $ariaID.'Note';
    }
@endphp

<fieldset
    {{ $attributes->class(['m-input', 's-disabled' => $disabled]) }}
    {{ $disabled ? 'inert' : '' }}>

    <div class="flex flex-row flex-nowrap justify-between items-baseline gap-gutter">
        <x-vui-form-label :tag="'legend'" :required="$required">
            {{$legend}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="f-ui-2 text-secondary">{{ $hint }}</span>
        @endif
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-12">{{ $note }}</p>
    @endif

    <ol>
        @foreach($options as $option)
            <li class="mt-24">
                <x-vui-form-checkbox
                    :label="$option['label'] ?? ''"
                    :name="$option['name'] ?? ''"
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
</fieldset>
