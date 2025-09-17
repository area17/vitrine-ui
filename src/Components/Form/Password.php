<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Password extends VitrineComponent
{
    public ?string $label;

    public ?string $name;

    public ?string $id;

    public ?string $value;

    public ?string $placeholder;

    public bool $disabled;

    public bool $required;

    public ?string $error;

    public ?string $hint;

    public ?string $note;

    public ?string $autocomplete;

    public bool $autofocus;

    public ?string $form;

    public bool $readonly;

    public ?string $ariaID;

    public ?string $errorID;

    public array $ariaDescribedBy;

    public ?string $rand;

    protected static array $assets = [
        'js' => ['behaviors/PasswordInput.js', 'behaviors/Input.js'],
    ];

    public function __construct(
        string $label = null,
        string $name = null,
        string $id = null,
        string $value = null,
        string $placeholder = null,
        bool $disabled = false,
        bool $required = false,
        string $error = null,
        string $hint = null,
        string $note = null,
        string $autocomplete = null,
        bool $autofocus = false,
        string $form = null,
        bool $readonly = false,
        array $ui = [],
    ) {
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
        return view('vitrine-ui::components.form.password.password');
    }
}
