<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Range extends VitrineComponent
{
    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var bool */
    public $disabled;

    /** @var bool */
    public $required;

    /** @var string */
    public $error;

    /** @var bool */
    public $hideLower;

    /** @var bool */
    public $showOutput;

    /** @var string */
    public $options;

    protected static $assets = [
        'js' => ['behaviors/RangeInput.js'],
        'css' => ['components/form/range.css']
    ];

    public function __construct(
        $label = '',
        $name = null,
        $disabled = false,
        $required = true,
        $error = '',
        $hideLower = true,
        $showOutput = true,
        $options = [
            'value' => [0, 50],
            'thumbsDisabled' => [true, false],
            'rangeSlideDisabled' => true
        ]
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
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.range.range');
    }
}
