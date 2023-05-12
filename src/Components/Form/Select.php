<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Select extends VitrineComponent
{
    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var string */
    public $id;

    /** @var bool */
    public $disabled;

    /** @var bool */
    public $required;

    /** @var array */
    public $options;

    /** @var string */
    public $placeholder;

    /** @var string */
    public $error;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

    /** @var string */
    public $form;

    /** @var string */
    public $autocomplete;

    /** @var bool */
    public $autofocus;

    /** @var bool */
    public $multiple;

    /** @var bool */
    public $readonly;

    /** @var string */
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $rand;

    protected static $assets = [
        'js' => ['behaviors/Input.js']
    ];

    public function __construct(
        $label = false,
        $name = null,
        $id = null,
        $disabled = false,
        $required = true,
        $options = [],
        $placeholder = '',
        $error = '',
        $hint = '',
        $note = '',
        $form = '',
        $autocomplete = '',
        $autofocus = false,
        $multiple = false,
        $readonly = false,
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->options = $options;
        $this->placeholder = $placeholder;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->form = $form;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
        $this->multiple = $multiple;
        $this->readonly = $readonly;

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
        return view('vitrine-ui::components.form.select.select');
    }
}
