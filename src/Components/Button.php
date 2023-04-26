<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Button extends VitrineComponent
{
    /** @var bool */
    public $static;

    /** @var string */
    public $href;

    /** @var string */
    public $icon;

    /** @var string */
    public $iconPosition;

    /** @var int */
    public $iconSpacing;

    /** @var int */
    public $labelClasses;

    /** @var string|bool */
    public $target;

    public function __construct(
        $href = null,
        $icon = null,
        $iconPosition = 'after',
        $static = false,
        $iconSpacing = 4,
        $labelClasses = '',
        $target = null,
    ) {
        $this->href = $href;
        $this->icon = $icon;
        $this->iconPosition = $iconPosition;
        $this->iconSpacing = $iconSpacing;
        $this->static = $static;
        $this->labelClasses = $labelClasses;

        $isExternalUrl = \App\Helpers\isExternalUrl($this->href);
        $this->target = $target ?? $isExternalUrl ? '_blank' : false;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.button._base');
    }

    // public function theIcon(): View
    // {
    //     return view('components.atoms.icon.index', ['name' => $this->icon, 'class' => 'mx-auto']);
    // }

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

    public function labelClasses(): string
    {
        $iconPosition = $this->getIconPosition();

        if (!$iconPosition) {
            return (string) $this->labelClasses;
        }

        $prefix = $iconPosition === 'before' ? 'ml-' : 'mr-';

        return $this->labelClasses . ' ' . $prefix . $this->iconSpacing;
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
