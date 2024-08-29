<?php

namespace A17\VitrineUI\Components;

use Illuminate\View\View;

class TabPanel extends VitrineComponent
{
    public string $name;

    public int $index;

    public bool $selected;

    public function __construct(
        $selected = false,
        $name = '',
        $index = 1,
        $ui = []
    )
    {
        $this->selected = $selected;
        $this->name = $name.'_tab';
        $this->index = $index;
        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.tabs.tab-panel');
    }
}
