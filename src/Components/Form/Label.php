<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Label extends VitrineComponent
{
    public ?string $name;

    public ?string $tag;

    public bool $required;

    public function __construct(string $name = null, string $tag = 'label', bool $required = false, array $ui = [])
    {
        $this->name = $name;
        $this->tag = $tag;
        $this->required = $required;

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.label.label');
    }
}
