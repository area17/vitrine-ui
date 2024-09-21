<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Modal extends VitrineComponent
{
    public ?string $id;

    public bool $showClose;

    public ?string $title;

    public bool $panel;

    public bool $clickOutsideToClose;

    public bool $setInitialFocus;

    public ?string $variant;

    public ?string $modalsStack;

    protected static array $assets = [
        'npm' => ['body-scroll-lock-upgrade', 'focus-trap'],
        'js' => 'behaviors/Modal.js'
    ];

    public function __construct(
        string $id = null,
        bool $showClose = true,
        string $title = null,
        bool $panel = false,
        string $variant = null,
        bool $setInitialFocus = true,
        bool $clickOutsideToClose = false,
        array $ui = [],
        string $modalsStack = 'modals',
    ) {

        $this->id = $id;
        $this->showClose = $showClose;
        $this->title = $title;
        $this->panel = $panel;
        $this->clickOutsideToClose = $clickOutsideToClose;
        $this->setInitialFocus = $setInitialFocus;
        $defaultVariant = $this->panel ? 'panel' : 'default';
        $this->variant = $variant ?? $defaultVariant;
        $this->modalsStack = $modalsStack;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.modal.modal');
    }
}
