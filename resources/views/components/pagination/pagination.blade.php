<div
        {{ $attributes->class($ui('pagination', 'base')) }}
        data-behavior="Pagination"
>
    <div class="{{ $ui('pagination', 'wrapper') }}">
        <div class="{{$ui('pagination', 'actions')}}">
            <x-vui-button
                    :href="$prevPageUrl()"
                    :variant="$btnVariant ?? 'secondary'"
                    icon="arrow-left-24"
                    :static="$onFirstPage"
                    :disabled="$onFirstPage"
                    class="{{ Arr::toCssClasses([
                        $ui('pagination', 'action-disabled') => $onFirstPage
                    ]) }}"
                    aria-label="{{ __('vitrine-ui::fe.pagination.previous') }}"
            />

            <x-vui-button
                    :href="$nextPageUrl()"
                    icon="arrow-right-24"
                    :variant="$btnVariant ?? 'secondary'"
                    :static="$onLastPage"
                    :disabled="$onLastPage"
                    class="{{ Arr::toCssClasses([
                        $ui('pagination', 'action-disabled') => $onLastPage
                    ]) }}"
                    aria-label="{{ __('pagination.next') }}"
            />
        </div>
        <span class="{{ $ui('pagination', 'show-message') }}">
                        {{ __('vitrine-ui::fe.pagination.showing', ['current' => $currentPage, 'last' => $lastPage]) }}
            </span>
        <div class="{{$ui('pagination', 'dropdown-wrapper')}}">
            <x-vui-form-select
                    :class="$ui('pagination', 'dropdown')"
                    :options="$dropdownItems"
                    :required="false"
                    data-pagination-paging-dropdown
            />
        </div>
    </div>
</div>
