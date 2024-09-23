<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class CheckboxGroup extends VitrineComponent
{
    public ?string $legend;

    public ?string $value;

    public array $options;

    public bool $disabled;

    public bool $required;

    public ?string $hint;

    public ?string $note;

    protected static array $assets = [
        'css' => [
            'components/form/checkbox.css',
            'components/form/input.css',
        ],
    ];

    public function __construct(
        string $legend = null,
        string $value = null,
        array $options = [],
        bool $disabled = false,
        bool $required = true,
        string $hint = null,
        string $note = null,
        array $ui = []
    )
    {
        $this->legend = $legend;
        $this->value = $value;
        $this->options = $options;
        $this->disabled = $disabled;
        $this->required = $required;
        $this->hint = $hint;
        $this->note = $note;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.checkbox-group.checkbox-group');
    }
}
