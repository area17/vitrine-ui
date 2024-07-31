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

    /** @var string|null */
    public $iconComponent;

    public function __construct(
        $name = null,
        $ariaLabel = null,
        $iconPath = null,
        $ui = []
    )
    {
        $this->name = $name;
        $this->ariaLabel = $ariaLabel;
        $this->iconComponent = $iconPath ?? $this->getIconPath();

        parent::__construct($ui);
    }

    public function shouldRender()
    {
        return $this->iconComponent;
    }

    public function render(): View
    {
        return view($this->iconComponent);
    }

    public function getIconPath(): bool|string
    {
        $iconPath = config('vitrine-ui.icons_view_path', 'icons'). $this->name;

        $viewExists = view()->exists($iconPath);
        if($viewExists) return $iconPath;

        $localPath = 'vitrine-ui::components.icon._icons.'.$this->name;
        $viewExists = view()->exists($localPath);

        if($viewExists) return $localPath;

        return false;
    }
}
