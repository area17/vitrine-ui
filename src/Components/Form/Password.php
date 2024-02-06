<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Password extends VitrineComponent
{
    /** @var string */
    public $label;

    /** @var string */
    public $name;

    /** @var string */
    public $id;

    /** @var string */
    public $value;

    /** @var string */
    public $placeholder;

    /** @var bool */
    public $disabled;

    /** @var bool */
    public $required;

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

    protected static array $assets = [
        'js' => [
            'behaviors/PasswordInput.js',
            'behaviors/Input.js'
        ],
        'css' => [
            'components/form/input.css',
        ]
    ];

    public function __construct(
        $label = '',
        $name = null,
        $id = '',
        $value = '',
        $placeholder = '',
        $disabled = false,
        $required = false,
        $error = '',
        $hint = '',
        $note = '',
        $autocomplete = '',
        $autofocus = false,
        $form = '',
        $readonly = false,
    )
    {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->autocomplete = $autocomplete;
        $this->autofocus = $autofocus;
        $this->form = $form;
        $this->readonly = $readonly;

        $this->rand = Str::random(4);
        $this->ariaID = 'ariaID'.$this->rand;
        $this->errorID = 'errorID'.$this->rand;
        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = $this->errorID;
        if($hint) {
            $this->ariaDescribedBy[] = $this->ariaID.'Hint';
        }
        if($note) {
            $this->ariaDescribedBy[] = $this->ariaID.'Note';
        }
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.password.password');
    }
}
