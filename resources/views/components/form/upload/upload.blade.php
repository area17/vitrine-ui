<div data-behavior="Input FileUpload"
     data-fileupload-size="{{ $fileSize }}"
     {{ $attributes->class(['m-form-upload', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly]) }}
     {{ $disabled ? 'inert' : '' }}>

    <div class="flex flex-row flex-nowrap items-baseline justify-between gap-gutter">
        <x-vui-form-label :name="$name"
                          :required="$required">
            {{ $label }}
        </x-vui-form-label>
        @if ($hint)
            <span class="f-ui-2 text-secondary"
                  id="{{ $ariaID }}Hint">{{ $hint }}</span>
        @endif
    </div>

    <div class="m-form-upload__wrapper">
        <input class="m-form-upload-input"
               data-Input-input
               data-fileupload-input
               type="file"
               aria-describedby="{{ implode(' ', $ariaDescribedBy) }}"
               @if ($id || $name) id="{{ $id ? $id : $name }}" @endif
               @if ($name) name="{{ $name }}" @endif
               @if ($fileSize) size="{{ $fileSize * 1024 * 1024 }}" @endif
               @if ($allowed) accept="{{ $allowed }}" @endif
               {{ $autofocus ? ' autofocus' : '' }}
               {{ $disabled ? ' disabled' : '' }}
               {{ $multiple ? ' multiple' : '' }}
               {{ $readonly ? ' readonly' : '' }}
               {{ $required ? ' required' : '' }} />

        <div data-fileupload-drop>
            <x-vui-button data-fileupload-btn
                          variant="secondary">
                Choose file
            </x-vui-button>
        </div>

        <div class="relative hidden"
             data-fileupload-selected>
            <span class="absolute left-[-32px] top-[1px] hidden h-24 w-24 rounded-full bg-success"
                  data-fileupload-successicon>
                <x-vui-icon class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-inverse"
                            name="checkmark-16" />
            </span>

            <span class="absolute left-[-32px] top-[1px] hidden h-24 w-24 rounded-full bg-error"
                  data-fileupload-erroricon>
                <x-vui-icon class="absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2 text-inverse"
                            name="close-16" />
            </span>

            <span class="f-body-1"
                  data-fileupload-selected-name></span>
            <br />
            <x-vui-link class="f-body-1 mt-4 text-secondary"
                        variant="primary">Remove</x-vui-link>
        </div>
    </div>

    <p class="f-body-1 mt-4 text-error"
       id="{{ $errorID }}"
       data-Input-error
       aria-live="assertive"
       aria-relevant="additions removals"
       style="display: none;">{{ $error ?? '' }}</p>

    <div class="m-form-upload__info f-body-1 mt-12 text-secondary"
         id="{{ $ariaID }}UploadInfo">
        <p class="f-ui-2">Accepted file types: {{ $allowed }}</p>
        <p class="f-ui-2">Max file size: {{ $fileSize }}</p>
    </div>

    @if ($note)
        <p class="f-ui-2 mt-4 text-secondary"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif
</div>
