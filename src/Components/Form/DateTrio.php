<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class DateTrio extends VitrineComponent
{
    public ?string $legend;

    public ?string $name;

    public ?string $id;

    public ?string $value;

    public bool $disabled;

    public bool $required;

    public ?string $error;

    public ?string $hint;

    public ?string $note;

    public ?string $minDate;

    public ?string $maxDate;

    public bool $picker;

    public bool $autofocus;

    public ?string $form;

    public bool $readonly;

    public ?string $dataAttrs;

    public bool $hideA11yLabels;

    public ?string $ariaID;

    public ?string $errorID;

    public array $ariaDescribedBy;
    public ?string $pickerID;

    public ?string $rand;

    protected static array $assets = [
        'js' => ['behaviors/DateTrio.js'],
        'css' => ['components/form/input.css'],
    ];

    public function __construct(
        string $legend = null,
        string $name = null,
        string $id = null,
        string $value = null,
        bool $disabled = false,
        bool $required = false,
        string $error = null,
        string $hint = null,
        string $note = null,
        string $minDate = null,
        string $maxDate = null,
        bool $picker = true,
        bool $autofocus = false,
        string $form = null,
        bool $readonly = false,
        string $dataAttrs = null,
        bool $hideA11yLabels = false,
        array $ui = [],
    ) {
        $this->legend = $legend;
        $this->name = $name;
        $this->id = $id;
        $this->value = $value;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;
        $this->minDate = $minDate;
        $this->maxDate = $maxDate;
        $this->picker = $picker;
        $this->autofocus = $autofocus;
        $this->form = $form;
        $this->readonly = $readonly;
        $this->dataAttrs = $dataAttrs;
        $this->hideA11yLabels = $hideA11yLabels;

        $this->rand = Str::random(4);
        $this->ariaID = 'ariaID' . $this->rand;
        $this->errorID = 'errorID' . $this->rand;

        if ($this->picker) {
            $this->pickerID = 'pickerID' . $this->rand;
        }

        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = $this->ariaID . 'Format';

        if ($this->minDate) {
            $this->ariaDescribedBy[] = $this->ariaID . 'MinDate';
        }

        if ($this->maxDate) {
            $this->ariaDescribedBy[] = $this->ariaID . 'MaxDate';
        }

        if ($this->hint) {
            $this->ariaDescribedBy[] = $this->ariaID . 'Hint';
        }

        if ($this->note) {
            $this->ariaDescribedBy[] = $this->ariaID . 'Note';
        }

        $this->ariaDescribedBy[] = $this->errorID;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.date-trio.date-trio');
    }
}
