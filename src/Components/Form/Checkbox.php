<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Checkbox extends VitrineComponent
{
    public ?string $label;

    public ?string $name;

    public ?string $id;

    public ?string $value;

    public bool $disabled;

    public bool $selected;

    public bool $required;

    public ?string $error;

    public ?string $hint;

    public ?string $note;

    public ?string $inputAttr;

    public bool $autofocus;

    public ?string $form;

    public string $ariaID;

    public string $errorID;

    public array $ariaDescribedBy;

    protected static array $assets = [
        'js' => ['behaviors/Input.js'],
        'css' => ['components/form/checkbox.css', 'components/form/input.css'],
    ];

    public function __construct(
        string $label = null,
        string $name = null,
        string $id = null,
        string|int $value = null,
        bool $disabled = false,
        bool $selected = false,
        bool $required = false,
        string $error = null,
        string $hint = null,
        string $note = null,
        string $inputAttr = null,
        bool $autofocus = false,
        string $form = null,
        array $ui = [],
    ) {
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

        $rand = Str::random(4);
        $this->ariaID = 'ariaID' . $rand;
        $this->errorID = 'errorID' . $rand;
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
        return view('vitrine-ui::components.form.checkbox.checkbox');
    }
}
