<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class RadioGroup extends VitrineComponent
{
    public ?string $legend;

    public ?string $name;

    public array $options;

    public bool $disabled;

    public bool $required;

    public ?string $error;

    public ?string $hint;

    public ?string $note;

    public ?string $ariaID;

    public ?string $errorID;

    public array $ariaDescribedBy;

    public ?string $rand;

    protected static array $assets = [
        'js' => ['behaviors/RadioGroup.js'],
        'css' => [
            'components/form/radio.css',
            'components/form/input.css',
        ]
    ];

    public function __construct(
        string $legend = null,
        string $name = null,
        array $options = [],
        bool $disabled = false,
        bool $required = true,
        string $error = null,
        string $hint = null,
        string $note = null,
        array $ui = []
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

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.radio-group.radio-group');
    }
}
