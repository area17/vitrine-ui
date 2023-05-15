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
    public $error;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

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
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $rand;

    protected static $assets = [
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
        $error = '',
        $hint = '',
        $note = '',
        $autocomplete = '',
        $autofocus = false,
        $form = '',
        $maxlength = '',
        $minlength = '',
        $readonly = false,
        $spellcheck = '',
        $wrap = '',
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->placeholder = $placeholder;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
        $this->form = $form;
        $this->maxlength = $maxlength;
        $this->minlength = $minlength;
        $this->readonly = $readonly;
        $this->spellcheck = $spellcheck;
        $this->wrap = $wrap;

        $this->rand = Str::random(4);
        $this->ariaID = 'ariaID'.$this->rand;
        $this->errorID = 'errorID'.$this->rand;
        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = '#'.$this->errorID;
        if($hint) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'Hint';
        }
        if($note) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'Note';
        }
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.textarea.textarea');
    }
}
