<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class CheckboxGroup extends VitrineComponent
{
    /** @var string */
    public $legend;

    /** @var string */
    public $type;

    /** @var string */
    public $value;

    /** @var array */
    public $options;

    /** @var string */
    public $disabled;

    /** @var string */
    public $required;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

    protected static $assets = [
        'css' => 'checkbox.css'
    ];

    public function __construct(
        $legend = '',
        $type = 'text',
        $value = '',
        $options = [],
        $disabled = false,
        $required = true,
        $hint = '',
        $note = '',
    )
    {
        $this->legend = $legend;
        $this->type = $type;
        $this->value = $value;
        $this->options = $options;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->hint = $hint;
        $this->note = $note;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.checkbox-group.checkbox-group');
    }
}
