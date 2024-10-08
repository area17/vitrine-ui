<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Field extends VitrineComponent
{
    public ?string $label;

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
    public $error;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

    /** @var string */
    public $inputmode;

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
    public $spellcheck;

    /** @var string */
    public $wrap;

    /** @var string */
    public $step;

    /** @var string */
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $rand;

    /** @var array */
    public $ariaDescribedBy;

    /** @var bool */
    public $withIconRight;

    protected static array $assets = [
        'js' => ['behaviors/Input.js'],
        'css' => ['components/form/input.css'],
    ];

    public function __construct(
        string $label = null,
        string $name = null,
        string $id = null,
        string $type = 'text',
        string $value = null,
        string $placeholder = null,
        bool $disabled = false,
        bool $required = false,
        string $error = null,
        string $hint = null,
        string $note = null,
        string $inputmode = null,
        string $pattern = null,
        string $autocomplete = null,
        bool $autofocus = false,
        string $form = null,
        string $list = null,
        string $max = null,
        string $maxlength = null,
        string $min = null,
        string $minlength = null,
        bool $multiple = false,
        bool $readonly = false,
        string $spellcheck = null,
        string $wrap = null,
        string $step = null,
        bool $withIconRight = false,
        array $ui = [],
    ) {
        $this->label = $label;
        $this->name = $name;
        $this->id = $id;
        $this->type = $type;
        $this->value = $value;
        $this->placeholder = $placeholder;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->inputmode = $inputmode;
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
        $this->spellcheck = $spellcheck;
        $this->wrap = $wrap;
        $this->step = $step;
        $this->withIconRight = $withIconRight;

        $this->rand = Str::random(4);
        $this->ariaID = 'ariaID' . $this->rand;
        $this->errorID = 'errorID' . $this->rand;
        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = $this->errorID;

        if ($hint) {
            $this->ariaDescribedBy[] = $this->ariaID . 'Hint';
        }
        if ($note) {
            $this->ariaDescribedBy[] = $this->ariaID . 'Note';
        }

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.field.field');
    }
}
