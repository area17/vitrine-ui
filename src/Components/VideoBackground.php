<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;

class VideoBackground extends VitrineComponent
{
    /**
     * Array of video sources with src and type keys
     * Default: []
     */
    public ?array $sources;

    /**
     * URL of the video
     * Default: null
     */
    public ?string $src;

    /**
     * Define if the video should use video.js or native video tag
     * Default: true
     */
    public bool $native;

    /**
     * Pass variant attribute to play/mute buttons
     */
    public ?string $buttonVariant;

    /**
     * Pass variant key to parent div.
     * Used to style the video background with theme options
     * Default: null
     */
    public ?string $variant;

    /**
     * Add button to control mute/unmute state
     * Default: false
     */
    public bool $controlMute;

    protected static array $assets = [
        'npm' => ['video.js'],
        'js' => ['behaviors/VideoBackground.js'],
    ];

    public function __construct(
        ?array $sources = null,
        ?bool $controlMute = false,
        ?string $buttonVariant = 'secondary',
        ?string $src = null,
        ?bool $native = true,
        ?string $variant = null,
        array $ui = [],
    ) {
        $this->buttonVariant = $buttonVariant;
        $this->sources = $sources;
        $this->controlMute = $controlMute;
        $this->native = $native;
        $this->variant = $variant;
        $this->src = $src;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.video-background.video-background', [
            'behaviorName' => $this->native ? 'VideoBackground' : 'VideoBackgroundVideoJs',
        ]);
    }
}
