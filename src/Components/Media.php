<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;

class Media extends VitrineComponent
{
    /** @var string */
    public $caption;

    /** @var array */
    public $image;

    /** @var string */
    public $imageOptions;

    /** @var string */
    public $imagePreset;

    /** @var bool */
    public $usePlaceholder;

    /** @var array */
    public $video;

    /** @var array */
    public $backgroundVideo;

    /** @var array */
    public $imageType;

    /** @var array */
    public $staticSettings;

    /** @var bool */
    public $cover;

    /** @var string|null */
    public $videoPlayIcon;

    /** @var array */
    public $classes;

    protected static array $assets = [
        'js' => [
            'behaviors/ShowVideo.js'
        ]
    ];

    public function __construct(
        $caption = null,
        $image = null,
        $imageOptions = null,
        $imagePreset = 'generic',
        $usePlaceholder = false,
        $video = null,
        $videoPlayIcon = null,
        $backgroundVideo = null,
        $cover = false,
        $ui = []
    ) {
        $this->caption = $caption;
        $this->image = $image;
        $this->imagePreset = $imagePreset;
        $this->usePlaceholder = $usePlaceholder;
        $this->video = $video;
        $this->videoPlayIcon = $videoPlayIcon;
        $this->backgroundVideo = $this->parseBackgroundVideo($backgroundVideo);
        $this->cover = $cover;

        $this->imageOptions = $imageOptions;
        $this->classes = ['h-full' => $this->cover];

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.media.media');
    }

    public function element(): string
    {
        return (isset($this->mediaCaption) && !empty($this->mediaCaption)) || !empty($this->caption) ? 'figure' : 'div';
    }

    protected function parseBackgroundVideo($data)
    {
        if (!Arr::has($data, 'sources')) {
            return false;
        }

        return $data;
    }
}
