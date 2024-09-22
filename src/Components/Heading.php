<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Heading extends VitrineComponent
{
    public int|string $level;

    public string $element;

    public function __construct(int $level = null, array $ui = [])
    {
        $this->level = $level;
        $this->element = $this->getElement();

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.heading.heading');
    }

    protected function getElement(): string
    {
        $level = (int) $this->level;
        return $level > 0 && $level <= 6 ? "h$level" : 'span';
    }
}
