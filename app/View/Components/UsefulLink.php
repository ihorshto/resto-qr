<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UsefulLink extends Component
{
    public $link;
    public $editMode;
    public function __construct($link, $editMode)
    {
        $this->link = $link;
        $this->editMode = $editMode;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.useful-link');
    }
}
