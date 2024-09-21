<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\Twill\Image\Models\Image as TwillImageModel;

class Image extends VitrineComponent
{

    public array|null|TwillImageModel $image;

    /** @var string
     * @deprecated
     */
    public $imageOptions;

    /** @var string
     * @deprecated
     */
    public $imagePreset;

    /** @var bool
     * @deprecated
     */
    public $usePlaceholder;

    /** @var array
     * @deprecated
     */
    protected $presetData;

    /** @var array
     * @deprecated
     */
    public $imageType;

    /**
     * @var array
     * @deprecated
     */
    public $staticSettings;

    /**
     * @var bool
     * Used to determine if the image is an array and should be rendered with future default rendering
     */
    public $nextRendering;

    public $width;
    public $height;
    public $src;

    /**
     * @var string
     * Define image loading strategy
     * Default: lazy
     */
    public $loading;
    public $sizes;

    public ?array $sources;

    public function __construct(
        $image = null,
        $imageOptions = null,
        $imagePreset = 'generic',
        $usePlaceholder = false,
        $nextRendering = false,
        $loading = 'lazy',
        $height = null,
        $width = null,
        $src = null,
        $sizes = null,
        $sources = null,
        $ui = []
    )
    {
        $this->image = $image;
        $this->height = $height;
        $this->width = $width;
        $this->src = $src;
        $this->sizes = $sizes;
        $this->sources = $sources ?? isset($image) && is_array($image) && Arr::has($image, 'sources') ? $image['sources'] : null;

        $this->imagePreset = $imagePreset;
        $this->usePlaceholder = $usePlaceholder;
        $this->nextRendering = $nextRendering ?? false;

        $this->presetData = config('twill-image.presets.' . $this->imagePreset);
        $this->imageType = $this->getImageType();
        $this->staticSettings = $this->getStaticSettings();
        $this->imageOptions = $this->parseImageOptions($imageOptions);
        $this->loading = $loading ?? $this->imageOptions['loading'] ?? 'lazy';


        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.image.image');
    }

    /**
     * @deprecated, in next major version, image type will be only an array. Define today with 'next-rendering'.
     */
    protected function getImageType()
    {
        if ($this->image instanceof TwillImageModel) {
            return 'twill-image';
        } elseif (Arr::has($this->image, '_static')) {
            return 'twill-image-static';
        } elseif ((Arr::has($this->image, 'src') || count($this->sources ?? [])) && $this->nextRendering) {
            return 'next-rendering';
        } elseif (Arr::has($this->image, 'src') && Arr::has($this->image, 'srcSet')) {
            return 'twill-image-array';
        } elseif (Arr::has($this->image, 'src')) {
            return 'static';
        } elseif ($this->usePlaceholder) {
            return 'placeholder';
        }

        return false;
    }

    public function setPictureFallbackImg()
    {
        return Arr::has($this->image, 'src') ? $this->image : $this->image['fallbackImg'] ?? $this->image['image'] ?? $this->sources[0] ?? null;
    }

    /**
     * @deprecated
     */
    protected function getStaticSettings()
    {
        if (!$this->image || !is_array($this->image) || !Arr::has($this->image, '_static')) {
            return false;
        }

        $presetStatic = Arr::get($this->presetData, '_static') ?? [];

        return array_merge($presetStatic, $this->image['_static']);
    }

    /**
     * @deprecated
     */
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
