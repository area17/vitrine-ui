<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Input extends VitrineComponent
{
    public ?string $name;

    public ?string $id;

    public ?string $type;

    public ?string $value;

    public ?string $placeholder;

    public bool $disabled;

    public bool $required;
    public ?string $pattern;

    public ?string $autocomplete;

    public bool $autofocus;

    public ?string $form;

    public ?string $list;

    public ?string $max;

    public ?string $maxlength;

    public ?string $min;

    public ?string $minlength;

    public bool $multiple;

    public bool $readonly;

    public ?string $step;

    public bool $withIconRight;

    public ?string $inputmode;

    public array $ariaDescribedBy;

    protected static array $assets = [
        'js' => ['behaviors/Input.js'],
        'css' => ['components/form/input.css'],
    ];

    public function __construct(
        string $name = null,
        string $id = null,
        string $type = 'text',
        string $value = null,
        string $placeholder = null,
        bool $disabled = false,
        bool $required = false,
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
        string $step = null,
        bool $withIconRight = false,
        array $ariaDescribedBy = [],
        array $ui = [],
    ) {
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
        $this->withIconRight = $withIconRight;
        $this->inputmode = $inputmode;

        $this->ariaDescribedBy = $ariaDescribedBy;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.input.input');
    }
}
