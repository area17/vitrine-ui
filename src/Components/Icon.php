<?php

namespace A17\VitrineUI\Components;

use A17\VitrineUI\Components\VitrineComponent;
use Illuminate\Contracts\View\View;

class Icon extends VitrineComponent
{
    /** @var string */
    public $name;

    /** @var string */
    public $ariaLabel;

    public function __construct(
        $name = null,
        $ariaLabel = null
    )
    {
        $this->name = $name;
        $this->ariaLabel = $ariaLabel;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.icon.index');
    }

    protected function getIconPath($name = false)
    {
        $iconPath = 'components.icon._icons.'. $name;

        return view()->exists($iconPath) ? $iconPath : 'vitrine-ui::'.$iconPath;
    }
}
