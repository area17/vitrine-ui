<div class="m-range {{ $hideLower ? 'm-range--hideLower' : '' }} {{ $disabled ? 'opacity-50 ' : '' }}"
     data-behavior="RangeInput"
     data-rangeinput-hidelower="{{ $hideLower }}"
     data-rangeinput-disabled="{{ $disabled }}"
     data-rangeinput-config="{{ !empty($options) ? json_encode($options) : false }}"
     {{ $disabled ? 'inert' : '' }}>
    <x-vui-form-label :name="$name"
                      :tag="'p'">
        {{ $label }}
    </x-vui-form-label>

    <div class="mt-24"
         data-rangeinput-slider></div>

    @if ($showOutput)
        <div class="mt-8">
            <span class="f-body-1"
                  data-rangeinput-value>0</span>
        </div>
    @endif

    @if ($error)
        <div class="mt-24">
            <p class="f-body-1 text-error">{{ $error }}</p>
        </div>
    @endif
</div>
