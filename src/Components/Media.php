<?php

namespace A17\VitrineUI\Components;

use A17\Twill\Image\Models\Image as TwillImageModel;
use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;

class Media extends VitrineComponent
{
    public ?string $caption;

    public array|null|TwillImageModel $image;
    public ?array $imageOptions;

    public ?string $imagePreset;

    public bool $usePlaceholder;

    public ?array $video;

    public ?array $backgroundVideo;

    public bool $cover;
    public ?string $videoPlayIcon;

    public array $classes;

    protected static array $assets = [
        'js' => [
            'behaviors/ShowVideo.js'
        ]
    ];

    public function __construct(
        string $caption = null,
        array|null|TwillImageModel $image = null,
        array $imageOptions = null,
        string $imagePreset = 'generic',
        bool $usePlaceholder = false,
        ?array $video = null,
        string $videoPlayIcon = null,
        array $backgroundVideo = null,
        bool $cover = false,
        array $ui = []
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

    protected function parseBackgroundVideo(?array $data): ?array
    {
        if (!Arr::has($data, 'sources')) {
            return null;
        }

        return $data;
    }
}
