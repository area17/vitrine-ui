<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Textarea extends VitrineComponent
{
    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var string */
    public $id;

    /** @var string */
    public $value;

    /** @var bool */
    public $disabled;

    /** @var bool */
    public $required;

    /** @var string */
    public $placeholder;

    /** @var string */
    public $autocomplete;

    /** @var bool */
    public $autofocus;

    /** @var string */
    public $form;

    /** @var string */
    public $maxlength;

    /** @var string */
    public $minlength;

    /** @var bool */
    public $readonly;

    /** @var string */
    public $spellcheck;

    /** @var string */
    public $wrap;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $rand;

    protected static array $assets = [
        'js' => [
            'behaviors/Input.js'
        ],
        'css' => [
            'components/form/input.css',
        ]
    ];

    public function __construct(
        $label = '',
        $name = null,
        $id = null,
        $value = '',
        $disabled = false,
        $required = false,
        $placeholder = '',
        $autocomplete = '',
        $autofocus = false,
        $form = '',
        $maxlength = '',
        $minlength = '',
        $readonly = false,
        $spellcheck = '',
        $wrap = '',
        $ui = []
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
        $this->form = $form;
        $this->maxlength = $maxlength;
        $this->minlength = $minlength;
        $this->readonly = $readonly;
        $this->spellcheck = $spellcheck;
        $this->wrap = $wrap;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.textarea.textarea');
    }
}
