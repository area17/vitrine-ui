<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Range extends VitrineComponent
{
    public ?string $label;

    public ?string $name;

    public bool $disabled;

    public bool $required;

    public ?string $error;
    public bool $hideLower;
    public bool $showOutput;

    public ?array $options;

    protected static array $assets = [
        'npm' => ['range-slider-input'],
        'js' => ['behaviors/RangeInput.js'],
        'css' => ['components/form/range.css']
    ];

    public function __construct(
        string $label = null,
        string $name = null,
        bool $disabled = false,
        bool $required = true,
        string $error = null,
        bool $hideLower = true,
        bool $showOutput = true,
        array $options = [
            'value' => [0, 50],
            'thumbsDisabled' => [true, false],
            'rangeSlideDisabled' => true
        ],
        array $ui = []
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->error = $error;
        $this->hideLower = $hideLower;
        $this->showOutput = $showOutput;
        $this->options = $options;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.range.range');
    }
}
