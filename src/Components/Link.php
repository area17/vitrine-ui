<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\Button;
use Illuminate\Contracts\View\View;

class Link extends Button
{
    public function __construct(
        $href = null,
        $icon = null,
        $iconPosition = 'after',
        $static = false,
        $target = null,
        $size = null,
        $variant = null,
        $iconOnly = false,
        $tag = null,
    )
    {
        parent::__construct(
            $href,
            $icon,
            $iconPosition,
            $static,
            $target,
            $size,
            $variant,
            $iconOnly,
            $tag = null,
        );
    }

    public function element(): string
    {
        if ($this->isLink()) {
            return 'a';
        }

        return 'span';
    }
}
