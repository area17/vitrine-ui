<div
    {{ $attributes->class('dropdown relative') }}
    data-behavior="Dropdown"
>
    <button
        class="flex text-primary border p-12 w-full f-body-1 justify-between"
        type="button"
        aria-label="filter by {{ $label }}"
        data-dropdown-btn
    >
        {{ $label }}

        <x-vui-icon
            class="transform-gpu transition"
            :name="'chevron-down-24'"
            data-dropdown-chevron
        />
    </button>

    <div
        class="dropdown-list trans-show-hide absolute z-1 w-full top-full min-w-200 max-h-252 mt-12 p-12 border border-primary bg-primary overflow-auto"
        data-dropdown-list
    >
        <x-vui-heading
            :level="$headingLevel"
            id="{{ $listlabelId }}"
            class="sr-only"
        >
            {{ __('fe.dropdown_items') }}
        </x-vui-heading>

        <ul aria-labelledby="{{ $listlabelId }}">
            {!! $slot !!}
        </ul>
    </div>
</div>
