<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Modal extends VitrineComponent
{
    /** @var string */
    public $id;

    /** @var bool */
    public $showClose;

    /** @var string */
    public $title;

    /** @var bool */
    public $panel;

    /** @var string */
    public $classes;

    protected static $assets = [
        'npm' => ['body-scroll-lock', 'focus-trap'],
        'behaviors' => 'modal.js',
        'css' => 'modal.css',
    ];

    public function __construct(
        $id = null,
        $showClose = true,
        $title = true,
        $panel = false,
    ) {
        $this->id = $id;
        $this->showClose = $showClose;
        $this->title = $title;
        $this->panel = $panel;
        $this->classes = [
            'o-modal',
            'o-modal-panel' => $panel
        ];
    }

    public function render(): View
    {
        return view('vitrine-ui::components.modal.modal');
    }
}
