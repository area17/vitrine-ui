<?php

namespace A17\VitrineUI\Components;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class VideoBackground extends VitrineComponent
{
    /** @var array
     * Array of video sources with src and type keys
     * Default: []
     */
    public array|null $sources;

    /** @var string
     * URL of the video
     */
    public string $src;

    /** @var bool
     * Define if the video should use video.js or native video tag
     * Default: true
     */
    public $native = true;

    /** @var string|null
     * Pass variant attribute to play/mute buttons
     */
    public string|null $buttonVariant = 'secondary';

    /** @var string|null
     * Pass variant key to parent div.
     * Used to style the video background with theme options
     * Default: null
     */
    public string|null $variant;

    /** @var bool
     * Add button to control mute/unmute state
     * Default: false
     */
    public bool $controlMute;


    protected static array $assets = [
        'npm' => ['video.js'],
        'js' => ['behaviors/VideoBackground.js']
    ];

    public function __construct(
        $sources = null,
        $controlMute = false,
        $buttonVariant = 'secondary',
        $src = null,
        $native = true,
        $variant = null,
        $ui = []
    )
    {
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
