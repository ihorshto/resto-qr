<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputLabelBox extends Component
{
    public $labelTitle;
    public $id;
    public $name;
    public $value;
    public $type;
    public $placeholder;
    public $classes;

    public function __construct($labelTitle, $id, $name, $value, $type, $placeholder, $classes)
    {
        $this->labelTitle = $labelTitle;
        $this->id = $id;
        $this->name = $name;
        $this->value = $value;
        $this->type = $type;
        $this->placeholder = $placeholder;
        $this->classes = $classes;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.input-label-box');
    }
}
