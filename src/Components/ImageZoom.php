<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\Twill\Image\TwillStaticImage;
use A17\VitrineUI\Components\VitrineComponent;

class ImageZoom extends VitrineComponent
{
    /** @var string */
    public $id;

    /** @var array */
    public $sources;

    /** @var array */
    public $autoInit; // set to false to listen for `image-zoom:init` event to init behavior

    protected static $assets = [
        'js' => [
            'behaviors/ImageZoom.js'
        ]
    ];

    public function __construct(
        $id = null,
        $sources = [],
        $autoInit = true,
    )
    {
        $this->id = $id ?? 'ImageZoom'. Str::random(3);
        $this->sources = $this->parseSources($sources);
        $this->autoInit = $autoInit;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.image-zoom.image-zoom');
    }

    protected function parseSources($sources = [])
    {
        $parsedSources = [];

        if(empty($sources)) {
            return [];
        }

        foreach ($sources as $source) {
            $image = $source['image'] ?? null;

            if ($image instanceof \A17\Twill\Image\Models\Image){
                $parsedSources[] = $image->preset('image_zoom')->toArray()['image']['src'];
            }elseif (Arr::has($image, '_static')){
                $presetData = config('twill-image.presets.image_zoom');
                $presetStatic = Arr::get($presetData, '_static') ?? [];
                $staticSettings = array_merge($presetStatic, $image['_static']);

                $staticImage = new TwillStaticImage();
                $parsedSources[] = $staticImage->make($staticSettings)->toArray()['image']['src'];
            }elseif (is_array($image) && array_key_exists('src', $image)){
                $parsedSources[] = $image['src'];
            } elseif (is_array($image) && array_key_exists('iiifId', $image)) {
                $parsedSources[] = $image;
            }
        }

        return $parsedSources;
    }
}
