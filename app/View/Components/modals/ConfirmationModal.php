<?php

namespace App\View\Components\modals;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ConfirmationModal extends Component
{
    public $id;
    public $title;
    public $subtitle;
    public function __construct($id, $title, $subtitle)
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modals.confirmation-modal');
    }
}
