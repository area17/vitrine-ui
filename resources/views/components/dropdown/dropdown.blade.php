<div
    {{ $attributes->class($ui('dropdown', 'base')) }}
    data-behavior="Dropdown"
>
    <button
        class="{{ $ui('dropdown', 'trigger') }}"
        type="button"
        aria-label="{{ $ariaLabel }}"
        data-dropdown-btn
    >
        {{ $label }}

        <x-vui-icon
            class="{{ $ui('dropdown', 'icon') }}"
            :name="{{ $ui('dropdown', 'icon-name') }}"
            data-dropdown-chevron
        />
    </button>

    <div
        class="{{ $ui('dropdown', 'list') }}"
        data-dropdown-list
    >
        <x-vui-heading
            :level="$headingLevel"
            id="{{ $listlabelId }}"
            class="sr-only"
        >
            {{ __('vitrine-ui::fe.dropdown_items') }}
        </x-vui-heading>

        <ul aria-labelledby="{{ $listlabelId }}" class="{{ $ui('dropdown', 'content')}}">
            {!! $slot !!}
        </ul>
    </div>
</div>
