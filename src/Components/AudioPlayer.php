<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class AudioPlayer extends VitrineComponent
{
    /** @var string */
    public $downloadUrl;

    /** @var array */
    public $playbackRates;

    /** @var string */
    public $subtitle;

    /** @var string */
    public $title;

    /** @var Array */
    public $sources;

    protected static $assets = [
        'css' => 'audio-player.css',
    ];

    public function __construct(
        $downloadUrl = null,
        $playbackRates = [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2, 2.25, 2.5, 2.75, 3],
        $subtitle = null,
        $title = null,
        $sources = [],
    )
    {
        $this->downloadUrl = $downloadUrl;
        $this->playbackRates = $playbackRates;
        $this->subtitle = $subtitle;
        $this->title = $title;
        $this->sources = $sources;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.audio-player.audio-player');
    }
}
