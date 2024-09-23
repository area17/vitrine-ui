<?php

namespace A17\VitrineUI\Components;

use A17\Twill\Image\Models\Image;
use A17\Twill\Image\TwillStaticImage;
use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;

class ImageZoom extends VitrineComponent
{
    public ?string $id;

    public array $sources;

    // set false to listen for `image-zoom:init` event to init behavior
    public bool $autoInit;

    protected static array $assets = [
        'npm' => [
            'openseadragon'
        ],
        'js' => [
            'behaviors/ImageZoom.js'
        ]
    ];

    public function __construct(
        string $id = null,
        array $sources = [],
        bool $autoInit = true,
        array $ui = []
    )
    {
        $this->id = $id ?? 'ImageZoom'. Str::random(3);
        $this->sources = $this->parseSources($sources);
        $this->autoInit = $autoInit;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.image-zoom.image-zoom');
    }

    protected function parseSources(array $sources = []): array
    {
        $parsedSources = [];

        if(empty($sources)) {
            return [];
        }

        foreach ($sources as $source) {
            $image = $source['image'] ?? null;

            if ($image instanceof Image){
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
