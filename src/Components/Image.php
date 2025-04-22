<?php

namespace A17\VitrineUI\Components;

use Illuminate\Support\Arr;
use Illuminate\Contracts\View\View;

class Image extends VitrineComponent
{
    public array|null $image;
    public int|string|null $width;
    public int|string|null $height;
    public ?string $src;

    /**
     * Define image loading strategy
     * @default: lazy
     */
    public ?string $loading;
    public ?string $sizes;

    public ?array $sources;

    public function __construct(
        array|null $image = null,
        string $loading = 'lazy',
        int|string $height = null,
        int|string $width = null,
        string $src = null,
        string $sizes = null,
        array $sources = null,
        array $ui = [],
    ) {
        $this->image = $image;
        $this->height = $height;
        $this->width = $width;
        $this->src = $src;
        $this->sizes = $sizes;
        $this->sources =
            $sources ?? isset($image) && is_array($image) && Arr::has($image, 'sources') ? $image['sources'] : null;
        $this->loading = $loading;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.image.image');
    }

    public function setPictureFallbackImg(): ?array
    {
        return Arr::has($this->image, 'src')
            ? $this->image
            : $this->image['fallbackImg'] ?? ($this->image['image'] ?? ($this->sources[0] ?? null));
    }
}
