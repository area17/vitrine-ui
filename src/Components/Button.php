<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Button extends VitrineComponent
{
    public ?string $href;

    public ?string $icon;

    public bool $iconOnly;

    public ?string $iconPosition;

    public ?string $size;

    public bool $static;

    public ?string $target;

    public ?string $tag;

    public ?string $variant;

    public string $uiKeyComponent = 'button';

    public function __construct(
        string $href = null,
        string $icon = null,
        string $iconPosition = 'after',
        bool $static = false,
        string $target = null,
        string $size = null,
        string $variant = null,
        string $tag = null,
        bool $iconOnly = false,
        array $ui = [],
    ) {
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

    public function getIconPosition(): bool|string
    {
        if ($this->iconBefore()) {
            return 'before';
        } elseif ($this->iconAfter()) {
            return 'after';
        }

        return false;
    }
}
