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

    /** @var string
     * Pass variant attribute to play/mute buttons
     */
    public string|null $buttonVariant = 'secondary';

    /** @var string
     * Add aspect ratio class (aspect-[value]) to the video container
     * Default: 16/9
     */
    public string $aspectRatio;

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
        $aspectRatio = '16/9',
        $controlMute = false,
        $buttonVariant = 'secondary',
        $src = null,
        $native = true,
        $ui = []
    )
    {
        $this->aspectRatio = $aspectRatio;
        $this->buttonVariant = $buttonVariant;
        $this->sources = $sources;
        $this->controlMute = $controlMute;
        $this->native = $native;
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
