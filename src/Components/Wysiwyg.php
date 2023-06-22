<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Wysiwyg extends VitrineComponent
{
    /** @var string */
    public $variant;

    protected static array $assets = [
        'css' => 'components/wysiwyg.css',
    ];

    public function __construct(
        $variant = null,
    )
    {
        $this->variant = $variant;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.wysiwyg.wysiwyg');
    }
}
