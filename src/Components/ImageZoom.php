<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Str;
use A17\Twill\Image\Models\Image;
use Illuminate\Contracts\View\View;

class ImageZoom extends VitrineComponent
{
    public ?string $id;

    public array $sources;

    // set false to listen for `image-zoom:init` event to init behavior
    public bool $autoInit;

    protected static array $assets = [
        'npm' => ['openseadragon'],
        'js' => ['behaviors/ImageZoom.js'],
    ];

    public function __construct(string $id = null, array $sources = [], bool $autoInit = true, array $ui = [])
    {
        $this->id = $id ?? 'ImageZoom' . Str::random(3);
        $this->sources = $this->parseSources($sources);
        $this->autoInit = $autoInit;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.image-zoom.image-zoom');
    }

    protected function parseImage(array $image = []): string|array|null
    {
        if (empty($image)) {
            return [];
        }

        $parsedImage = [];

        if (is_array($image) && array_key_exists('src', $image)) {
            $parsedImage = $image['src'];
        } elseif (is_array($image) && array_key_exists('iiifId', $image)) {
            $parsedImage = $image;
        }

        return $parsedImage ?? [];
    }

    protected function parseSources(array $sources = []): array
    {
        $parsedSources = [];

        if (empty($sources)) {
            return [];
        }

        foreach ($sources as $source) {
            $image = $source['image'] ?? null;

            if (is_array($image) && array_key_exists('image', $image)) {
                $parsedSources[] = $this->parseImage($image['image']);
            } elseif (is_array($image)) {
                $parsedSources[] = $this->parseImage($image);
            }
        }

        return $parsedSources;
    }
}
