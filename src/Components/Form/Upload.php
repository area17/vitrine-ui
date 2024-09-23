<?php

namespace A17\VitrineUI\Components\Form;

use Illuminate\Support\Str;
use Illuminate\Contracts\View\View;
use A17\VitrineUI\Components\VitrineComponent;

class Upload extends VitrineComponent
{
    public ?string $label;

    public ?string $name;

    public ?string $id;

    public ?string $value;

    public bool $disabled;

    public bool $required;

    public ?string $error;

    public ?string $hint;

    public ?string $note;

    public ?string $allowed;

    public string|int|null $fileSize;

    public bool $autofocus;

    public bool $multiple;

    public bool $readonly;

    public ?string $ariaID;

    public ?string $errorID;

    public array $ariaDescribedBy;

    public ?string $rand;

    protected static array $assets = [
        'js' => ['behaviors/FileUpload.js', 'behaviors/Input.js'],
        'css' => ['components/form/upload.css'],
    ];

    public function __construct(
        string $label = null,
        string $name = null,
        string $id = null,
        string $value = null,
        bool $disabled = false,
        bool $required = true,
        string $error = null,
        string $hint = null,
        string $note = null,
        string $allowed = 'image/*,.pdf',
        string|int $fileSize = 5,
        bool $autofocus = false,
        bool $multiple = false,
        bool $readonly = false,
        array $ui = []
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
        $this->ariaDescribedBy[] = $this->errorID;

        if($hint) {
            $this->ariaDescribedBy[] = $this->ariaID.'Hint';
        }

        if($note) {
            $this->ariaDescribedBy[] = $this->ariaID.'Note';
        }

        parent::__construct($ui);
    }

    public function render(): View
    {
        return view('vitrine-ui::components.form.upload.upload');
    }
}
