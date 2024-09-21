<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Pagination extends VitrineComponent
{
    public array $pages;

    public int $currentPage;

    public int $lastPage;

    public int $total;

    public int $currentPageCount;

    public array $dropdownItems;

    public bool $onFirstPage;

    public bool $onLastPage;

    public ?string $btnVariant;

    public ?string $iconLeft = 'arrow-left-24';

    public ?string$iconRight = 'arrow-right-24';

    public bool $labelInsideDropdown = true;

    protected static array $assets = [
        'js' => 'behaviors/Pagination.js',
    ];

    public function __construct(
        array $pages = [],
        int $currentPage = 1,
        ?int $currentPageCount = null,
        ?int $total = null,
        ?int $lastPage = 1,
        ?string $btnVariant = 'secondary',
        ?string $iconLeft = 'arrow-left-24',
        ?string $iconRight = 'arrow-right-24',
        bool $labelInsideDropdown = true,
        array $ui = []
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
        return count($this->pages) > 1;
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
