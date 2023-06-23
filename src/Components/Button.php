<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Button extends VitrineComponent
{

    /** @var string */
    public $href;

    /** @var string */
    public $icon;

    /** @var bool */
    public $iconOnly;

    /** @var string */
    public $iconPosition;

    /** @var int */
    public $iconSpacing;

    /** @var null|string */
    public $size;

    /** @var bool */
    public $static;

    /** @var string|bool */
    public $target;

    /** @var string */
    public $tag;

    /** @var null|string */
    public $variant;

    protected static array $assets = [
        'css' => 'components/button.css'
    ];

    public function __construct(
        $href = null,
        $icon = null,
        $iconPosition = 'after',
        $static = false,
        $target = null,
        $size = null,
        $variant = null,
        $tag = null,
        $iconOnly = false,
        $ui = []
    )
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->iconPosition = $iconPosition;
        $this->iconOnly = $iconOnly;
        $this->static = $static;
        $this->size = $size;
        $this->variant = $variant;
        $this->tag = $tag ?? $this->element();

        $isExternalUrl = $this->isExternalUrl($href);
        $this->target = $target ?? $isExternalUrl ? '_blank' : false;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.button.default');
    }

    public function element(): string
    {
        if ($this->static) {
            return 'span';
        }

        if ($this->isLink()) {
            return 'a';
        }

        return 'button';
    }

    public function isLink(): bool
    {
        return !empty($this->href);
    }

    public function iconBefore(): bool
    {
        return filled($this->icon) && $this->icon && $this->iconPosition === 'before';
    }

    public function iconAfter(): bool
    {
        return filled($this->icon) && $this->icon && $this->iconPosition === 'after';
    }

    protected function getIconPosition()
    {
        if ($this->iconBefore()) {
            return 'before';
        } elseif ($this->iconAfter()) {
            return 'after';
        }

        return false;
    }
}
