<?php

namespace App\View\Components\alerts;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class SuccessAlert extends Component
{
    public $label;
    public $text;
    public function __construct($label, $text)
    {
        $this->label = $label;
        $this->text = $text;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.alerts.success-alert');
    }
}
