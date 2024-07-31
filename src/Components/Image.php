<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

class Image extends VitrineComponent
{

    /** @var array */
    public $image;

    /** @var string */
    public $imageOptions;

    /** @var string */
    public $imagePreset;

    /** @var bool */
    public $usePlaceholder;

    /** @var array */
    protected $presetData;

    /** @var array */
    public $imageType;

    /** @var array */
    public $staticSettings;

    public function __construct(
        $image = null,
        $imageOptions = null,
        $imagePreset = 'generic',
        $usePlaceholder = false,
        $videoPlayIcon = null,
        $backgroundVideo = null,
        $ui = []
    ) {
        $this->image = $image;
        $this->imagePreset = $imagePreset;
        $this->usePlaceholder = $usePlaceholder;

        $this->presetData = config('twill-image.presets.' . $this->imagePreset);
        $this->imageType = $this->getImageType();
        $this->staticSettings = $this->getStaticSettings();
        $this->imageOptions = $this->parseImageOptions($imageOptions);

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.image.image');
    }

    protected function getImageType()
    {
        /** @phpstan-ignore-next-line */
        if ($this->image instanceof \A17\Twill\Image\Models\Image) {
            return 'twill-image';
        } elseif (Arr::has($this->image, '_static')) {
            return 'twill-image-static';
        } elseif (Arr::has($this->image, 'src') && Arr::has($this->image, 'srcSet')) {
            return 'twill-image-array';
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

        if ($breakpointRatios) {
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
}
