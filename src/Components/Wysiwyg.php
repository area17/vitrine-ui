<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Wysiwyg extends VitrineComponent
{
    /** @var string */
    public $variation;

    protected static $assets = [
        'css' => 'components/wysiwyg.css',
    ];

    public function __construct(
        $variation = null,
    )
    {
        $this->variation = $variation;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.wysiwyg.wysiwyg');
    }
}
