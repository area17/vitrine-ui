@php
    use A17\VitrineUI\VitrineUI;

    // Get select preset from pagination config file
     $uiSelect = [
     'select' => $preset('pagination')['pagination']['select']
      ];
@endphp
<div
        {{ $attributes->twMerge($ui('pagination', 'base')) }}
        data-behavior="Pagination"
>
    <div class="{{ $ui('pagination', 'wrapper') }}">
        <div class="{{$ui('pagination', 'actions')}}">
            <x-vui-button
                    :href="$prevPageUrl()"
                    :variant="$btnVariant ?? 'secondary'"
                    :icon="$iconLeft ?? 'arrow-left-24'"
                    :static="$onFirstPage"
                    :disabled="$onFirstPage"
                    class="{{ Arr::toCssClasses([
                        $ui('pagination', 'action-disabled') => $onFirstPage
                    ]) }}"
                    aria-label="{{ __('vitrine-ui::fe.pagination.previous') }}"
            />

            <x-vui-button
                    :href="$nextPageUrl()"
                    :icon="$iconRight ?? 'arrow-right-24'"
                    :variant="$btnVariant ?? 'secondary'"
                    :static="$onLastPage"
                    :disabled="$onLastPage"
                    class="{{ Arr::toCssClasses([
                        $ui('pagination', 'action-disabled') => $onLastPage
                    ]) }}"
                    aria-label="{{ __('vitrine-ui::fe.pagination.next') }}"
            />
        </div>
        <span class="{{ $ui('pagination', 'show-message') }}">
                        {{ __('vitrine-ui::fe.pagination.showing', ['count' => $currentPageCount, 'total' => $total]) }}
            </span>
        <div class="{{$ui('pagination', 'dropdown-wrapper')}}">
            <x-vui-form-select
                    :ui="$uiSelect"
                    :class="$ui('pagination', 'dropdown')"
                    :options="$dropdownItems"
                    :required="false"
                    data-pagination-paging-dropdown
            />

            @if(!$labelInsideDropdown)
                <p class="{{ $ui('pagination', 'dropdown-message') }}">{{ __('vitrine-ui::fe.pagination.num_of_total', ['last' => $lastPage]) }}</p>
            @endif
        </div>
    </div>
</div>
