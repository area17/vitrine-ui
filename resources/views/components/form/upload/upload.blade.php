<div data-behavior="Input FileUpload"
     data-fileupload-size="{{ $fileSize }}"
     {{ $attributes->merge(['data-behavior' => $attributes->prepends('Input FileUpload')])->twMerge(Arr::toCssClasses(['m-form-upload', 's-disabled' => $disabled, 's-error' => $error, 's-readonly' => $readonly])) }}
     {{ $disabled ? 'inert' : '' }}>

    <div class="gap-gutter flex flex-row flex-nowrap items-baseline justify-between">
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
            <span class="bg-success absolute left-[-32px] top-[1px] hidden h-24 w-24 rounded-full"
                  data-fileupload-successicon>
                <x-vui-icon class="text-inverse absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
                            name="checkmark-16" />
            </span>

            <span class="bg-error absolute left-[-32px] top-[1px] hidden h-24 w-24 rounded-full"
                  data-fileupload-erroricon>
                <x-vui-icon class="text-inverse absolute left-1/2 top-1/2 -translate-x-1/2 -translate-y-1/2"
                            name="close-16" />
            </span>

            <span class="f-body-1"
                  data-fileupload-selected-name></span>
            <br />
            <x-vui-link class="f-body-1 text-secondary mt-4"
                        variant="primary">Remove</x-vui-link>
        </div>
    </div>

    <p class="f-body-1 text-error mt-4"
       id="{{ $errorID }}"
       data-Input-error
       aria-live="assertive"
       aria-relevant="additions removals"
       style="display: none;">{{ $error ?? '' }}</p>

    <div class="m-form-upload__info f-body-1 text-secondary mt-12"
         id="{{ $ariaID }}UploadInfo">
        <p class="f-ui-2">Accepted file types: {{ $allowed }}</p>
        <p class="f-ui-2">Max file size: {{ $fileSize }}</p>
    </div>

    @if ($note)
        <p class="f-ui-2 text-secondary mt-4"
           id="{{ $ariaID }}Note">{{ $note }}</p>
    @endif
</div>
