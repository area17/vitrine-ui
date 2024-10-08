<div data-behavior="Dropdown"
     {{ $attributes->twMerge($ui('dropdown', 'base')) }}>
    <button class="{{ $ui('dropdown', 'trigger') }}"
            data-dropdown-btn
            type="button"
            aria-label="{{ $ariaLabel }}"
            aria-expanded="false"
            aria-controls="{{ $listId }}">
        {{ $label }}

        <x-vui-icon class="{{ $ui('dropdown', 'icon') }}"
                    name="{{ $ui('dropdown', 'icon-name') }}"
                    data-dropdown-chevron />
    </button>

    <div class="{{ $ui('dropdown', 'list') }}"
         id="{{ $listId }}"
         data-dropdown-list>
        <x-vui-heading class="sr-only"
                       id="{{ $listlabelId }}"
                       :level="$headingLevel">
            {{ __('vitrine-ui::fe.dropdown_items') }}
        </x-vui-heading>

        <ul class="{{ $ui('dropdown', 'content') }}"
            aria-labelledby="{{ $listlabelId }}">
            {!! $slot !!}
        </ul>
    </div>
</div>
