<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Heading extends VitrineComponent
{
    /** @var int */
    public $level;

    /** @var string */
    public $element;

    public function __construct($level = null)
    {
        $this->level = $level;
        $this->element = $this->getElement();
    }

    public function render(): View
    {
        return view('vitrine-ui::components.heading.heading');
    }

    protected function getElement()
    {
        return $this->level > 0 && $this->level <= 6 ? "h$this->level" : 'span';
    }
}
