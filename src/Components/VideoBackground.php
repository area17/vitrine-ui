<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class VideoBackground extends VitrineComponent
{
    /** @var array */
    public $sources;

    /** @var string */
    public $aspectRatio;

    /** @var bool */
    public $controlMute;

    public function __construct(
        $sources = null,
        $aspectRatio = '16/9',
        $controlMute = false,
    )
    {
        $this->sources = $sources;
        $this->aspectRatio = $aspectRatio;
        $this->controlMute = $controlMute;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.video-background.video-background');
    }
}
