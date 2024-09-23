<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Textarea extends VitrineComponent
{
    public ?string $name;

    public ?string $id;

    public ?string $value;

    public bool $disabled;

    public bool $required;

    public ?string $placeholder;

    public ?string $autocomplete;

    public bool $autofocus;

    public ?string $form;

    public ?string $maxlength;

    public ?string $minlength;

    public bool $readonly;

    public ?string $spellcheck;

    public ?string $wrap;

    protected static array $assets = [
        'js' => ['behaviors/Input.js'],
        'css' => ['components/form/input.css'],
    ];

    public function __construct(
        string $name = null,
        string $id = null,
        string $value = '',
        bool $disabled = false,
        bool $required = false,
        string $placeholder = null,
        string $autocomplete = null,
        bool $autofocus = false,
        string $form = null,
        string $maxlength = null,
        string $minlength = null,
        bool $readonly = false,
        string $spellcheck = null,
        string $wrap = null,
        array $ui = [],
    ) {
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
