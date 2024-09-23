<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Wysiwyg extends VitrineComponent
{
    public ?string $variant;

    protected static array $assets = [
        'css' => 'components/wysiwyg.css',
    ];

    public function __construct(?string $variant = null)
    {
        $this->variant = $variant;

        parent::__construct();
    }

    public function render(): View
    {
        return view('vitrine-ui::components.wysiwyg.wysiwyg');
    }
}
