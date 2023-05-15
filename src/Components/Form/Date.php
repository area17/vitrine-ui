<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Date extends VitrineComponent
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
    public $required;

    /** @var string */
    public $error;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

    /** @var string */
    public $minDate;

    /** @var string */
    public $maxDate;

    /** @var bool */
    public $fuzzy;

    /** @var bool */
    public $picker;

    /** @var bool */
    public $autofocus;

    /** @var string */
    public $form;

    /** @var bool */
    public $readonly;

    /** @var string */
    public $dataAttrs;

    /** @var bool */
    public $hideA11yLabels;

    /** @var string */
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $pickerID;

    protected static $assets = [
        'npm' => ['@area17/parse-numeric-date'],
        'js' => [
            'utils/formatDate.js',
            'behaviors/Input.js',
            'behaviors/DateInput.js',
            'behaviors/DateInputFuzzy.js'
        ],
        'css' => [
            'components/form/input.css',
        ]
    ];

    public function __construct(
        $label = '',
        $name = '',
        $id = '',
        $value = '',
        $disabled = false,
        $required = false,
        $error = '',
        $hint = '',
        $note = '',
        $minDate = '',
        $maxDate = '',
        $fuzzy = false,
        $picker = true,
        $autofocus = false,
        $form = '',
        $readonly = false,
        $dataAttrs = '',
        $hideA11yLabels = false,
    )
    {
        $this->label = $label;
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
        $this->fuzzy = $fuzzy;
        $this->picker = $picker;
        $this->autofocus = $autofocus;
        $this->form = $form;
        $this->readonly = $readonly;
        $this->dataAttrs = $dataAttrs;
        $this->hideA11yLabels = $hideA11yLabels;

        $rand = Str::random(4);
        $this->ariaID = 'ariaID'.$rand;
        $this->errorID = 'errorID'.$rand;

        if ($this->picker) {
            $this->pickerID = 'pickerID'. $rand;
        }

        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = '#'.$this->ariaID.'Format';

        if($this->minDate) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'MinDate';
        }

        if($this->maxDate) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'MaxDate';
        }

        if($this->hint) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'Hint';
        }

        if($this->note) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'Note';
        }

        $this->ariaDescribedBy[] = '#'.$this->errorID;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.date.date');
    }
}
