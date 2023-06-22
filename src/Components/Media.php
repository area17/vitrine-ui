<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\View\Component;
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
    protected $presetData;

    /** @var array */
    public $imageType;

    /** @var array */
    public $staticSettings;

    /** @var bool */
    public $cover;

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
        $backgroundVideo = null,
        $cover = false,
    ) {
        $this->caption = $caption;
        $this->image = $image;
        $this->imagePreset = $imagePreset;
        $this->usePlaceholder = $usePlaceholder;
        $this->video = $video;
        $this->backgroundVideo = $this->parseBackgroundVideo($backgroundVideo);
        $this->cover = $cover;

        $this->presetData = config('twill-image.presets.' . $this->imagePreset);
        $this->imageType = $this->getImageType();
        $this->staticSettings = $this->getStaticSettings();
        $this->imageOptions = $this->parseImageOptions($imageOptions);
        $this->classes = ['h-full' => $this->cover];
    }

    public function render(): View
    {
        return view('vitrine-ui::components.media.media');
    }

    public function element(): string
    {
        return (isset($this->mediaCaption) && !empty($this->mediaCaption)) || !empty($this->caption) ? 'figure' : 'div';
    }

    protected function getImageType()
    {
        /** @phpstan-ignore-next-line */
        if ($this->image instanceof \A17\Twill\Image\Models\Image) {
            return 'twill-image';
        } elseif (Arr::has($this->image, '_static')) {
            return 'twill-image-static';
        } elseif (is_array($this->image) && array_key_exists('src', $this->image)) {
            return 'static';
        } elseif ($this->usePlaceholder) {
            return 'placeholder';
        }

        return false;
    }

    protected function getStaticSettings()
    {
        if (!$this->image || !is_array($this->image) || !Arr::has($this->image, '_static')) {
            return false;
        }

        $presetStatic = Arr::get($this->presetData, '_static') ?? [];

        return array_merge($presetStatic, $this->image['_static']);
    }

    protected function parseImageOptions($imageOptions = [])
    {
        $breakpointRatios = Arr::get($this->presetData, 'breakpointRatios');
        $classes = [];

        if ($this->cover) {
            $classes = ['w-full', 'h-full', 'object-cover'];
        } elseif ($breakpointRatios) {
            $ratioClasses = [];

            foreach ($breakpointRatios as $key => $value) {
                $prefix = $key === 'xs' ? '' : $key . ':';

                $ratioClasses[] = $prefix . 'aspect-' . Str::remove(' ', $value);
            }

            $classes = array_merge($classes, $ratioClasses);
        }

        if (Arr::has($imageOptions, 'class')) {
            $imageOptions['class'] .= ' ' . Arr::toCssClasses($classes);
        } else {
            $imageOptions['class'] = Arr::toCssClasses($classes);
        }

        return $imageOptions;
    }

    protected function parseBackgroundVideo($data)
    {
        // dd($data);
        if (!Arr::has($data, 'sources')) {
            return false;
        }

        if (!Arr::has($data, 'aspectRatio')) {
            $data['aspectRatio'] = '16/9';
        }

        return $data;
    }
}
