<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class AudioPlayer extends VitrineComponent
{
    public ?string $downloadUrl;

    public array $playbackRates;

    public ?string $subtitle;

    public ?string $title;

    public ?string $variant;

    /** @var array */
    public array $sources;

    protected static array $assets = [
        'js' => 'behaviors/AudioPlayer.js',
        'css' => 'components/audio-player.css',
    ];

    public function __construct(
        string $downloadUrl = null,
        array $playbackRates = [0.5, 0.75, 1, 1.25, 1.5, 1.75, 2, 2.25, 2.5, 2.75, 3],
        string $subtitle = null,
        string $title = null,
        string $variant = null,
        array $sources = [],
        array $ui = [],
    ) {
        $this->downloadUrl = $downloadUrl;
        $this->playbackRates = $playbackRates;
        $this->subtitle = $subtitle;
        $this->title = $title;
        $this->sources = $sources;
        $this->variant = $variant;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.audio-player.audio-player');
    }
}
