<?php

namespace A17\VitrineUI\Components\Card;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Primary extends VitrineComponent
{
    /** @var int */
    public $headingLevel;

    /** @var string */
    public $href;

    /** @var string */
    public $title;

    /** @var string */
    public $description;

    /** @var array */
    public $media;

    /** @var string */
    public $imagePreset;

    /** @var string */
    public $contentType;

    /** @var bool */
    public $isExternalUrl;

    public function __construct(
        $headingLevel = 3,
        $href = null,
        $title = null,
        $description = null,
        $media = null,
        $imagePreset = 'card_2up',
        $contentType = null,
    )
    {
        $this->headingLevel = $headingLevel;
        $this->href = $href;
        $this->title = $title;
        $this->description = $description;
        $this->media = $media;
        $this->imagePreset = $imagePreset;
        $this->contentType = $contentType;
        $this->isExternalUrl = \App\Helpers\isExternalUrl($this->href);

    }

    public function render(): View
    {
        return view('vitrine-ui::components.card.primary.primary');
    }
}
