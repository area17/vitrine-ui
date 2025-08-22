@props([
    'btnVariant' => 'secondary',
    'btnSize' => 'md',
    'pages' => [],
    'currentPage' => 1,
    'lastPage' => 1,
    'iconLeft' => 'arrow-left-24',
    'iconRight' => 'arrow-right-24',
])

@php
    $onFirstPage = $currentPage === 1;
    $onLastPage = $currentPage === $lastPage;
    $nextPage = $onLastPage ? null : $pages[$currentPage + 1] ?? null;
    $prevPage = $onFirstPage ? null : $pages[$currentPage - 1] ?? null;
@endphp

<div {{ $attributes->twMerge(VitrineUI::ui('pagination-numbered')) }}>
    <nav class="{{ VitrineUI::ui('pagination-numbered', 'wrapper') }}">
        <x-vui-button class="{{ Arr::toCssClasses([
            VitrineUI::ui('pagination-numbered', 'action-disabled') => $onFirstPage,
        ]) }}"
                      aria-label="{{ __('vitrine-ui::fe.pagination.previous') }}"
                      :href="$prevPage['url'] ?? null"
                      :variant="$btnVariant ?? 'secondary'"
                      :icon="$iconLeft ?? null"
                      :size="$btnSize ?? null"
                      :static="$onFirstPage"
                      :disabled="$onFirstPage"
                      :icon-only="true" />

        @if (isset($pages) && is_array($pages) && count($pages) > 0)
            <div class="{{ VitrineUI::ui('pagination-numbered', 'pages') }}">
                @foreach ($pages as $key => $page)
                    {{-- display the page number as a link 1 ... 10,11,12 ... 20 --}}
                    {{-- if the page is the current page, display it as a span --}}
                    {{-- if the page is not the current page, display it as a link --}}
                    {{-- if the page dont have a url, display it as an ellipsis --}}
                    @if (isset($page['url']))
                        @if ($key == $currentPage)
                            <span class="{{ VitrineUI::ui('pagination-numbered', 'current') }}"
                                  aria-current="page">{{ $key }}</span>
                        @else
                            <a class="{{ VitrineUI::ui('pagination-numbered', 'link') }}"
                               href="{{ $page['url'] ?? null }}"
                               aria-label="{{ __('vitrine-ui::fe.pagination.page', ['page' => $key]) }}">{{ $key }}</a>
                        @endif
                    @else
                        <span class="{{ VitrineUI::ui('pagination-numbered', 'ellipsis') }}"
                              aria-hidden="true">&hellip;</span>
                    @endif
                @endforeach
            </div>
        @endif

        <x-vui-button class="{{ Arr::toCssClasses([
            VitrineUI::ui('pagination-numbered', 'action-disabled') => $onLastPage,
        ]) }}"
                      aria-label="{{ __('vitrine-ui::fe.pagination.next') }}"
                      :href="$nextPage['url'] ?? null"
                      :icon="$iconRight ?? null"
                      :variant="$btnVariant ?? 'secondary'"
                      :size="$btnSize ?? null"
                      :static="$onLastPage"
                      :disabled="$onLastPage"
                      :icon-only="true" />
    </nav>
    <span class="{{ VitrineUI::ui('pagination-numbered', 'message') }}">
        {{ __('vitrine-ui::fe.pagination.page_of', [
            'current' => $currentPage,
            'last' => $lastPage,
        ]) }}
    </span>
</div>
