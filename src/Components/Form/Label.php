<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Label extends VitrineComponent
{
    /** @var string */
    public $name;

    /** @var string */
    public $tag;

    /** @var string */
    public $required;

    public function __construct(
        $name = '',
        $tag = 'label',
        $required = ''
    )
    {
        $this->name = $name;
        $this->tag = $tag;
        $this->required = $required;
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.label.label');
    }
}
