<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class Icon extends VitrineComponent
{
    public string $name;

    public ?string $ariaLabel;

    public ?string $iconComponent;

    public function __construct(string $name = null, string $ariaLabel = null, string $iconPath = null, array $ui = [])
    {
        $this->name = $name;
        $this->ariaLabel = $ariaLabel;
        $this->iconComponent = $iconPath ?? $this->getIconPath();

        parent::__construct($ui);
    }

    public function shouldRender(): bool
    {
        return !empty($this->iconComponent);
    }

    public function render(): View
    {
        return view($this->iconComponent);
    }

    public function getIconPath(): ?string
    {
        $iconPath = config('vitrine-ui.icons_view_path', 'icons') . $this->name;

        $viewExists = view()->exists($iconPath);
        if ($viewExists) {
            return $iconPath;
        }

        $localPath = 'vitrine-ui::components.icon._icons.' . $this->name;
        $viewExists = view()->exists($localPath);

        if ($viewExists) {
            return $localPath;
        }

        return null;
    }
}
