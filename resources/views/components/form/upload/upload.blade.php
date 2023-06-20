<div
        data-behavior="Input FileUpload"
        data-fileupload-size="{{$fileSize}}"
        {{ $attributes->class(['m-form-upload', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
        {{ $disabled ? 'inert' : '' }}>

    <div class="flex flex-row flex-nowrap justify-between items-baseline gap-gutter">
        <x-vui-form-label :name="$name" :required="$required">
            {{$label}}
        </x-vui-form-label>
        @if ($hint)
            <span id="{{$ariaID}}Hint" class="f-ui-2 text-secondary">{{ $hint }}</span>
        @endif
    </div>

    <div class="m-form-upload__wrapper">
        <input
                type="file"
                class="m-form-upload-input"
                @if($id || $name) id="{{$id ? $id : $name}}" @endif
                @if($name) name="{{$name}}" @endif
                @if($fileSize) size="{{ $fileSize * 1024 * 1024 }}" @endif
                @if($allowed) accept="{{$allowed}}" @endif
                aria-describedby="{{implode(',', $ariaDescribedBy)}}"
                data-Input-input
                data-fileupload-input
                {{ $autofocus ? ' autofocus' : '' }}
                {{ $disabled ? ' disabled' : '' }}
                {{ $multiple ? ' multiple' : '' }}
                {{ $readonly ? ' readonly' : '' }}
                {{ $required ? ' required' : '' }}
        />

        <div data-fileupload-drop>
            <x-vui-button
                    variant="secondary"
                    data-fileupload-btn>
                Choose file
            </x-vui-button>
        </div>

        <div class="relative hidden" data-fileupload-selected>
            <span
                    class="absolute h-24 w-24 left-[-32px] bg-success rounded-full top-[1px] hidden"
                    data-fileupload-successicon>
                <x-vui-icon
                        name="checkmark-16"
                        class="text-inverse absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"/>
            </span>

            <span
                    class="absolute h-24 w-24 left-[-32px] bg-error rounded-full top-[1px] hidden"
                    data-fileupload-erroricon>
                <x-vui-icon
                        name="close-16"
                        class="text-inverse absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"/>
            </span>

            <span class="f-body-1" data-fileupload-selected-name></span>
            <br/>
            <x-vui-link variant="primary" class="text-secondary mt-4 f-body-1">Remove</x-vui-link>
        </div>
    </div>

    <p id="{{$errorID}}" aria-live="assertive" aria-relevant="additions removals" class="mt-4 f-body-1 text-error"
       style="display: none;" data-Input-error>{{$error ?? ''}}</p>

    <div
            id="{{$ariaID}}UploadInfo"
            class="m-form-upload__info mt-12 f-body-1 text-secondary"
    >
        <p class="f-ui-2">Accepted file types: {{$allowed}}</p>
        <p class="f-ui-2">Max file size: {{$fileSize}}</p>
    </div>

    @if ($note)
        <p id="{{$ariaID}}Note" class="f-ui-2 text-secondary mt-4">{{ $note }}</p>
    @endif
</div>
