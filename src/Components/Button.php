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

    /** @var null|string */
    public $variant;

    public function __construct(
        $href = null,
        $icon = null,
        $iconPosition = 'after',
        $static = false,
        $target = null,
        $size = null,
        $variant = null,
        $iconOnly = false
    )
    {
        $this->href = $href;
        $this->icon = $icon;
        $this->iconPosition = $iconPosition;
        $this->iconOnly = $iconOnly;
        $this->static = $static;
        $this->size = $size;
        $this->variant = $variant;

        $isExternalUrl = $this->isExternalUrl($href);
        $this->target = $target ?? $isExternalUrl ? '_blank' : false;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.button.default');
    }

    public function element(): string
    {
        if ($this->static) {
            return 'span';
        } elseif ($this->isLink()) {
            return 'a';
        } else {
            return 'button';
        }
    }

    public function isLink(): bool
    {
        return $this->href && !empty($this->href);
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
