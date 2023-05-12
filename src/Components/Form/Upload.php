<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Upload extends VitrineComponent
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
    public $allowed;

    /** @var string */
    public $fileSize;

    /** @var bool */
    public $autofocus;

    /** @var bool */
    public $multiple;

    /** @var bool */
    public $readonly;

    /** @var string */
    public $ariaID;

    /** @var string */
    public $errorID;

    /** @var string */
    public $ariaDescribedBy;

    /** @var string */
    public $rand;

    protected static $assets = [
        'js' => ['behaviors/FileUpload.js', 'behaviors/Input.js'],
        'css' => ['upload.css'],
    ];

    public function __construct(
        $label = '',
        $name = null,
        $id = null,
        $value = '',
        $disabled = false,
        $required = true,
        $error = '',
        $hint = '',
        $note = '',
        $allowed = 'image/*,.pdf',
        $fileSize = 5,
        $autofocus = false,
        $multiple = false,
        $readonly = false,
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
        $this->allowed = $allowed;
        $this->fileSize = $fileSize;
        $this->autofocus = $autofocus;
        $this->multiple = $multiple;
        $this->readonly = $readonly;

        $this->rand = Str::random(4);
        $this->ariaID = 'ariaID'.$this->rand;
        $this->errorID = 'errorID'.$this->rand;
        $this->ariaDescribedBy = [];
        $this->ariaDescribedBy[] = '#'.$this->errorID;

        if($hint) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'Hint';
        }

        if($note) {
            $this->ariaDescribedBy[] = '#'.$this->ariaID.'Note';
        }
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.upload.upload');
    }
}
