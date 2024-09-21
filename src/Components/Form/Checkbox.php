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

    public ?string $icon;

    public ?string $inputAttr;

    public bool $autofocus;

    public ?string $form;

    public ?string $ariaID;

    public ?string $errorID;

    public array $ariaDescribedBy;

    protected static array $assets = [
        'js' => ['behaviors/Input.js']
    ];

    public function __construct(
        $label = null,
        $name = null,
        $id = null,
        $value = null,
        $disabled = false,
        $selected = false,
        $required = false,
        $icon = 'checkmark-16',
        $error = null,
        $hint = null,
        $note = null,
        $inputAttr = null,
        $autofocus = false,
        $form = null,
        $ui = []
    )
    {
        $rand = Str::random(6);

        $this->label = $label;
        $this->name = $name;
        $this->id = isset($id) && strlen($id) > 0 ? $id : 'checkbox-'.$rand;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->selected = $selected;
        $this->required = $required;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->icon = $icon;
        $this->inputAttr = $inputAttr;
        $this->autofocus = $autofocus;
        $this->form = $form;

        $this->ariaID = 'ariaID'. $rand;
        $this->errorID = 'errorID'. $rand;
        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = $this->errorID;

        if($hint) {
            $this->ariaDescribedBy[] = $this->ariaID.'Hint';
        }
        if($note) {
            $this->ariaDescribedBy[] = $this->ariaID.'Note';
        }

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.checkbox.checkbox');
    }
}
