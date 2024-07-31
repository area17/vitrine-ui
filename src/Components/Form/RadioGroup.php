<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class RadioGroup extends VitrineComponent
{
    /** @var string */
    public $legend;

    /** @var string */
    public $name;

    /** @var array */
    public $options;

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
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $rand;

    protected static array $assets = [
        'js' => ['behaviors/RadioGroup.js'],
        'css' => [
            'components/form/radio.css',
            'components/form/input.css',
        ]
    ];

    public function __construct(
        $legend = '',
        $name = null,
        $options = [],
        $disabled = false,
        $required = true,
        $error = '',
        $hint = '',
        $note = '',
    )
    {
        $this->legend = $legend;
        $this->name = $name;
        $this->options = $options;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->error = $error;
        $this->hint = $hint;
        $this->note = $note;

        $this->rand = Str::random(4);
        $this->ariaID = 'ariaID'.$this->rand;
        $this->errorID = 'errorID'.$this->rand;
        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = $this->errorID;
        if($hint) {
            $this->ariaDescribedBy[] = $this->ariaID.'Hint';
        }
        if($note) {
            $this->ariaDescribedBy[] = $this->ariaID.'Note';
        }

        // set selected radio, if none selected
        $selectedIndex = -1;
        $index = 0;

        foreach($this->options as $option){
            if (isset($option['selected']) && $option['selected'] === true) {
                $selectedIndex = $index;

                break;
            }

            $index = $index + 1;
        }
        if ($selectedIndex === -1 && count($options) > 1) {
            $this->options[0]['selected'] = true;
        }
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.radio-group.radio-group');
    }
}
