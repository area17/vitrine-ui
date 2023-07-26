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

    /** @var bool */
    public $clickOutsideToClose;

    /** @var bool */
    public $setInitialFocus;

    /** @var string */
    public $variant;

    protected static array $assets = [
        'npm' => ['body-scroll-lock-upgrade', 'focus-trap'],
        'js' => 'behaviors/Modal.js'
    ];

    public function __construct(
        $id = null,
        $showClose = true,
        $title = null,
        $panel = false,
        $variant = null,
        $setInitialFocus = true,
        $clickOutsideToClose = false,
        $ui = []
    ) {

        $this->id = $id;
        $this->showClose = $showClose;
        $this->title = $title;
        $this->panel = $panel;
        $this->clickOutsideToClose = $clickOutsideToClose;
        $this->setInitialFocus = $setInitialFocus;
        $defaultVariant = $this->panel ? 'panel' : 'default';
        $this->variant = $variant ?? $defaultVariant;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.modal.modal');
    }
}
