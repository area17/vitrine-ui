@php
    use A17\VitrineUI\VitrineUI;

    // Get select preset from pagination config file
    $uiSelect = [
        'select' => $preset('pagination')['pagination']['select'],
    ];
@endphp
<div data-behavior="Pagination"
     {{ $attributes->twMerge($ui('pagination', 'base')) }}>
    <div class="{{ $ui('pagination', 'wrapper') }}">
        <div class="{{ $ui('pagination', 'actions') }}">
            <x-vui-button class="{{ Arr::toCssClasses([
                $ui('pagination', 'action-disabled') => $onFirstPage,
            ]) }}"
                          :aria-label="$onFirstPage ? null : __('vitrine-ui::fe.pagination.previous')"
                          :href="$prevPageUrl()"
                          :variant="$btnVariant ?? 'secondary'"
                          :icon="$iconLeft ?? 'arrow-left-24'"
                          :size="$btnSize ?? null"
                          :static="$onFirstPage"
                          :disabled="$onFirstPage"
                          :icon-only="true" />

            <x-vui-button class="{{ Arr::toCssClasses([
                $ui('pagination', 'action-disabled') => $onLastPage,
            ]) }}"
                          :aria-label="$onLastPage ? null : __('vitrine-ui::fe.pagination.next')"
                          :href="$nextPageUrl()"
                          :icon="$iconRight ?? 'arrow-right-24'"
                          :variant="$btnVariant ?? 'secondary'"
                          :size="$btnSize ?? null"
                          :static="$onLastPage"
                          :disabled="$onLastPage"
                          :icon-only="true" />
        </div>
        <span class="{{ $ui('pagination', 'show-message') }}">
            {{ __('vitrine-ui::fe.pagination.showing', ['count' => $currentPageCount, 'total' => $total]) }}
        </span>
        <div class="{{ $ui('pagination', 'dropdown-wrapper') }}">
            <x-vui-form-select data-pagination-paging-dropdown
                               :ui="$uiSelect"
                               :class="$ui('pagination', 'dropdown')"
                               :options="$dropdownItems"
                               :required="false" />

            @if (!$labelInsideDropdown)
                <p class="{{ $ui('pagination', 'dropdown-message') }}">
                    {{ __('vitrine-ui::fe.pagination.num_of_total', ['last' => $lastPage]) }}</p>
            @endif
        </div>
    </div>
    @if ($labelAfterActions)
        <p class="{{ $ui('pagination', 'after-actions-message') }}">
            {{ __('vitrine-ui::fe.pagination.page_of', ['current' => $currentPage, 'last' => $lastPage]) }}</p>
    @endif
</div>
