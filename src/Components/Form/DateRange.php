<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class DateRange extends VitrineComponent
{
    public ?string $legend;

    public bool $disabled;

    public ?string $minDate;

    public ?string $maxDate;

    public ?string $hint;

    public ?string $note;

    public bool $picker;

    /*
     * Array with properties for the from child vui-input-date component
     */
    public array $from;

    /*
     * Array with properties for the to child vui-input-date component
     */
    public array $to;

    public ?string $ariaID;

    public array $ariaDescribedBy;

    public ?string $pickerID;

    protected static array $assets = [
        'js' => ['utils/formatDate.js', 'behaviors/DateRange.js'],
    ];

    public function __construct(
        string $legend = null,
        bool $disabled = false,
        string $minDate = null,
        string $maxDate = null,
        string $hint = null,
        string $note = null,
        bool $picker = true,
        array $from = [],
        array $to = [],
        array $ui = [],
    ) {
        $this->legend = $legend;
        $this->disabled = $disabled;
        $this->minDate = $minDate;
        $this->maxDate = $maxDate;
        $this->hint = $hint;
        $this->note = $note;
        $this->picker = $picker;
        $this->from = $from;
        $this->to = $to;

        $rand = Str::random(4);
        $this->ariaID = 'ariaID' . $rand;

        $this->pickerID = $this->picker ? 'pickerID' . $rand : null;

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

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.date-range.date-range');
    }
}
