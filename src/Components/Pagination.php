<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Pagination extends VitrineComponent
{
    /** @var array */
    public $pages;

    /** @var int */
    public $currentPage;

    /** @var int */
    public $lastPage;

    /** @var int */
    public $total;

    /** @var int */
    public $currentPageCount;

    /** @var array */
    public $dropdownItems;

    /** @var bool */
    public $onFirstPage;

    /** @var bool */
    public $onLastPage;

    /** @var string */
    public $btnVariant;

    protected static array $assets = [
        'js' => 'behaviors/Pagination.js',
    ];

    public function __construct(
        $pages = [],
        $currentPage = 1,
        $currentPageCount = null,
        $total = null,
        $lastPage = 1,
        $btnVariant = 'secondary',
        $ui = []
    )
    {
        $this->btnVariant = $btnVariant;
        $this->pages = $pages;
        $this->currentPage = $currentPage;
        $this->currentPageCount = $currentPageCount;
        $this->total = $total;
        $this->lastPage = $lastPage;
        $this->onFirstPage = $this->currentPage === 1;
        $this->onLastPage = $this->currentPage === $this->lastPage;
        $this->dropdownItems = $this->buildDropdownItems();
        Parent::__construct($ui);
    }

    public function shouldRender(): bool
    {
        return count($this->pages ?? []) > 1;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.pagination.pagination');
    }

    private function buildDropdownItems(): array
    {
        $items = [];

        foreach ($this->pages as $key => $page) {
            $i = $key;
            $items[] = [
                'value' => $page['url'],
                'label' => __('vitrine-ui::fe.pagination.page_of', ['current' => $i, 'last' => $this->lastPage]),
                'selected' => $i === $this->currentPage,
            ];
        }

        return $items;
    }

    public function nextPageUrl(): ?string
    {
        $nextPage = $this->pages[$this->currentPage + 1] ?? null;

        return $nextPage['url'] ?? null;
    }

    public function prevPageUrl(): ?string
    {
        $prevPage = $this->pages[$this->currentPage - 1] ?? null;

        return $prevPage['url'] ?? null;
    }
}
