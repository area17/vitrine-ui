<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use A17\VitrineUI\Components\VitrineComponent;

class Listing extends VitrineComponent
{
    /** @var array|string */
    public $ariaOwns;

    /** @var string */
    public $cardType;

    /** @var int */
    public $headingLevel;

    /** @var string */
    public $id;

    /** @var string */
    public $imagePreset;

    /** @var array */
    public $items;

    /** @var string */
    public $layout;

    /** @var string */
    public $offset;

    /** @var bool */
    public $inline;

    /** @var bool */
    public $bgTransition;

    /** @var bool */
    public $scroll;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(
        $ariaOwns = null,
        $cardType = 'primary',
        $headingLevel = 2,
        $id = null,
        $items = null,
        $layout = '3up',
        $offset = true,
        $inline = false,
        $bgTransition = false,
        $scroll = false,
    ) {
        $this->ariaOwns = $ariaOwns;
        $this->cardType = $cardType;
        $this->headingLevel = $headingLevel;
        $this->id = $id;
        $this->items = $items;
        $this->layout = $layout;
        $this->offset = $offset;
        $this->inline = $inline;
        $this->bgTransition = $bgTransition;
        $this->scroll = $scroll;
    }

    public function wrapperClasses()
    {
        $classes = ['container', 'mt-space-10', 'first:mt-0'];

        return Arr::toCssClasses($classes);
    }

    public function listClasses()
    {
        $classes = $this->layout === '3up' && $this->scroll ? $this->getScrollClasses() : $this->getGridClasses();

        return Arr::toCssClasses($classes);
    }

    public function getScrollClasses()
    {
        $classes = [
            'cols-container',
            'flex-nowrap',
            'lg:grid',
            'lg:grid-cols-3',
            'lg:gap-x-gutter',
            'lg:gap-y-56',
            'xl:gap-y-64',
            '2xl:gap-y-72',
            'lg:ml-0',
            "after:content-[''] after:block after:w-20 after:flex-shrink-0",
            'lg:after:hidden',
        ];

        return $classes;
    }

    public function getGridClasses()
    {
        switch ($this->layout) {
            case '1up':
                $is_inline = in_array($this->cardType, ['inline', 'inline_cta']);
                $classes = [
                    'grid grid-cols-1',
                    'gap-y-32 sm:gap-y-40 md:gap-y-48 lg:gap-y-56 xl:gap-y-64 2xl:gap-y-72' => !$is_inline,
                    'gap-y-40 sm:gap-y-48 md:gap-y-56 lg:gap-y-64 xl:gap-y-72 2xl:gap-y-96' =>
                        $this->cardType === 'inline',
                    'gap-y-32 lg:gap-y-48' => $this->cardType === 'inline_cta',
                ];

                break;

            case '2up':
                $classes = [
                    'grid',
                    'grid-cols-1',
                    'md:grid-cols-2',
                    'gap-x-gutter',
                    'gap-y-32',
                    'sm:gap-y-40',
                    'md:gap-y-48',
                    'lg:gap-y-56',
                    'xl:gap-y-64',
                    '2xl:gap-y-72',
                ];

                break;

            case '2up-left':
            case '2up-right':
                $classes = [
                    'grid',
                    'grid-cols-1',
                    'md:grid-cols-3',
                    'gap-x-gutter',
                    'gap-y-32',
                    'sm:gap-y-40',
                    'md:gap-y-48',
                    'lg:gap-y-56',
                    'xl:gap-y-64',
                    '2xl:gap-y-72',
                ];

                break;

            case '3up':
            case '3up-portrait':
            default:
                $classes = [
                    'grid',
                    'grid-cols-1',
                    'md:grid-cols-2',
                    'lg:grid-cols-3',
                    'gap-x-gutter',
                    'gap-y-32',
                    'sm:gap-y-40',
                    'md:gap-y-48',
                    'lg:gap-y-56',
                    'xl:gap-y-64',
                    '2xl:gap-y-72',
                ];

                break;

            case '4up':
                $classes = [
                    'grid',
                    'grid-cols-1',
                    'sm:grid-cols-2',
                    'lg:grid-cols-4',
                    'gap-x-gutter',
                    'gap-y-32',
                    'sm:gap-y-40',
                    'md:gap-y-48',
                    'lg:gap-y-56',
                    'xl:gap-y-64',
                    '2xl:gap-y-72',
                ];

                break;

            case '6up':
                $classes = [
                    'grid',
                    'grid-cols-2',
                    'md:grid-cols-3',
                    'lg:grid-cols-6',
                    'gap-x-gutter',
                    'gap-y-32',
                    'sm:gap-y-40',
                    'md:gap-y-48',
                    'lg:gap-y-56',
                    'xl:gap-y-64',
                    '2xl:gap-y-72',
                ];

                break;
        }

        $classes['lg:pr-2-cols xl:pr-0 2xl:pr-1-cols'] = $this->cardType === 'stat_simple';

        return $classes;
    }

    public function itemClasses($index = null)
    {
        $classes = [];

        if ($this->scroll && $this->layout === '3up') {
            $classes = ['w-5-cols', 'md:w-8-cols', 'lg:w-auto', 'ml-gutter', 'lg:ml-0', 'flex-shrink-0'];
        } elseif (in_array($this->layout, ['2up-left', '2up-right'])) {
            if ($this->isLargeImage($index)) {
                $classes = ['col-span-1 md:col-span-2'];
                // } elseif ($this->isSmallImage($index)) {
            } else {
                $classes = ['col-span-1'];
            }
        }

        return Arr::toCssClasses($classes);
    }

    public function imagePreset($index)
    {
        $preset = 'generic';

        switch ($this->layout) {
            case '1up':
                $preset = 'card_1up';

                break;

            case '2up':
                $preset = 'card_2up';

                break;

            case '2up-left':
            case '2up-right':
                if ($this->isLargeImage($index)) {
                    $preset = 'card_2up_large';
                    // } elseif ($this->isSmallImage($index)) {
                } else {
                    $preset = 'card_2up_small';
                }

                break;

            case '3up':
                $preset = 'card_3up';

                break;

            case '3up-portrait':
                $preset = 'card_3up_portrait';

                break;

            case '4up':
                $preset = 'card_4up';

                break;
            case '6up':
                $preset = 'card_6up';

                break;
        }

        return $preset;
    }

    // used to check if the current item is the larger image in a 2up-left or 2up-right listing
    protected function isLargeImage($index)
    {
        return ($this->layout === '2up-left' && ($index % 4 === 0 || $index % 4 === 3)) ||
            ($this->layout === '2up-right' && ($index % 4 === 1 || $index % 4 === 2));
    }

    // used to check if the current item is the smaller image in a 2up-left or 2up-right listing
    protected function isSmallImage($index)
    {
        return ($this->layout === '2up-left' && ($index % 4 === 1 || $index % 4 === 2)) ||
            ($this->layout === '2up-right' && ($index % 4 === 0 || $index % 4 === 3));
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('vitrine-ui::components.listing.listing');
    }
}
