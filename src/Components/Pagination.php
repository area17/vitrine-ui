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

    public $iconLeft = 'arrow-left-24';

    public $iconRight = 'arrow-right-24';

    public $labelInsideDropdown = true;

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
        $iconLeft = 'arrow-left-24',
        $iconRight = 'arrow-right-24',
        $labelInsideDropdown = true,
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
        $this->labelInsideDropdown = $labelInsideDropdown;
        $this->dropdownItems = $this->buildDropdownItems();
        $this->iconLeft = $iconLeft;
        $this->iconRight = $iconRight;

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
                'label' => $this->labelInsideDropdown ? __('vitrine-ui::fe.pagination.page_of', ['current' => $i, 'last' => $this->lastPage]) : $i,
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
