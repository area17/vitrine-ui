<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Radio extends VitrineComponent
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
    public $selected;

    /** @var bool */
    public $required;

    /** @var string */
    public $error;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

    /** @var string */
    public $inputAttr;

    /** @var bool */
    public $autofocus;

    /** @var string */
    public $form;

    /** @var string */
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $rand;

    protected static $assets = [
        'js' => ['behaviors/Input.js'],
        'css' => ['radio.css']
    ];

    public function __construct(
        $label = '',
        $name = '',
        $id = '',
        $value = '',
        $disabled = false,
        $selected = false,
        $required = false,
        $error = '',
        $hint = '',
        $note = '',
        $inputAttr = '',
        $autofocus = false,
        $form = '',
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->selected = $selected;
        $this->required = $required;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->inputAttr = $inputAttr;
        $this->autofocus = $autofocus;
        $this->form = $form;

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
        return view('vitrine-ui::components.form.radio.radio');
    }
}
