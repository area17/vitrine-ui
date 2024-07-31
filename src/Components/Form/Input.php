<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Input extends VitrineComponent
{

    /** @var string */
    public $name;

    /** @var string */
    public $id;

    /** @var string */
    public $type;

    /** @var string */
    public $value;

    /** @var string */
    public $placeholder;

    /** @var bool */
    public $disabled;

    /** @var bool */
    public $required;

    /** @var string */
    public $pattern;

    /** @var string */
    public $autocomplete;

    /** @var bool */
    public $autofocus;

    /** @var string */
    public $form;

    /** @var string */
    public $list;

    /** @var string */
    public $max;

    /** @var string */
    public $maxlength;

    /** @var string */
    public $min;

    /** @var string */
    public $minlength;

    /** @var bool */
    public $multiple;

    /** @var bool */
    public $readonly;

    /** @var string */
    public $step;

    /** @var array */
    public $ariaDescribedBy;

    protected static array $assets = [
        'js' => [
            'behaviors/Input.js'
        ],
        'css' => [
            'components/form/input.css',
        ]
    ];

    public function __construct(
        $name = null,
        $id = '',
        $type = 'text',
        $value = '',
        $placeholder = '',
        $disabled = false,
        $required = false,
        $inputmode = '',
        $pattern = '',
        $autocomplete = '',
        $autofocus = false,
        $form = '',
        $list = '',
        $max = '',
        $maxlength = '',
        $min = '',
        $minlength = '',
        $multiple = false,
        $readonly = false,
        $step = '',
        $ariaDescribedBy = [],
        $ui = []
    )
    {
        $this->name = $name;
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->pattern = $pattern;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
        $this->form = $form;
        $this->list = $list;
        $this->max = $max;
        $this->maxlength = $maxlength;
        $this->min = $min;
        $this->minlength = $minlength;
        $this->multiple = $multiple;
        $this->readonly = $readonly;
        $this->step = $step;
        $this->ariaDescribedBy = $ariaDescribedBy;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.input.input');
    }
}
