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
    public $variant;

    protected static array $assets = [
        'npm' => ['body-scroll-lock-upgrade', 'focus-trap'],
        'js' => 'behaviors/Modal.js'
    ];

    public function __construct(
        $id = null,
        $showClose = true,
        $title = true,
        $panel = false,
        $variant = null,
        $ui = []
    ) {

        $this->id = $id;
        $this->showClose = $showClose;
        $this->title = $title;
        $this->panel = $panel;
        $this->variant = $variant ?? $this->panel ? 'panel' : 'default';

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.modal.modal');
    }
}
