<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class DateRange extends VitrineComponent
{
    /** @var string */
    public $legend;

    /** @var bool */
    public $disabled;

    /** @var string */
    public $minDate;

    /** @var string */
    public $maxDate;

    /** @var string */
    public $hint;

    /** @var string */
    public $note;

    /** @var bool */
    public $picker;

    /** @var array */
    public $from;

    /** @var array */
    public $to;

    /** @var string */
    public $ariaID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $pickerID;

    protected static array $assets = [
        'js' => [
            'utils/formatDate.js',
            'behaviors/DateRange.js',
        ],
    ];

    public function __construct(
        $legend = '',
        $disabled = false,
        $minDate = '',
        $maxDate = '',
        $hint = '',
        $note = '',
        $picker = true,
        $from = [],
        $to = [],
    )
    {
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
        $this->ariaID = 'ariaID'. $rand;

        if ($this->picker) {
            $this->pickerID = 'pickerID'. $rand;
        }

        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = $this->ariaID.'Format';

        if($this->minDate) {
            $this->ariaDescribedBy[] = $this->ariaID.'MinDate';
        }

        if($this->maxDate) {
            $this->ariaDescribedBy[] = $this->ariaID.'MaxDate';
        }

        if($this->hint) {
            $this->ariaDescribedBy[] = $this->ariaID.'Hint';
        }

        if($this->note) {
            $this->ariaDescribedBy[] = $this->ariaID.'Note';
        }
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.date-range.date-range');
    }
}
