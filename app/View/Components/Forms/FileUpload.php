<?php

namespace App\View\Components\Forms;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class FileUpload extends Component
{
    public $id;
    public $url;
    public $maxFiles;
    public $maxFilesize;
    public $singleton;
    public $acceptedFiles;
    public $fileUploadName;
    public function __construct($id, $url, $maxFiles, $maxFilesize, $singleton, $acceptedFiles, $fileUploadName)
    {
        $this->id = $id;
        $this->url = $url;
        $this->maxFiles = $maxFiles;
        $this->maxFilesize = $maxFilesize;
        $this->singleton = $singleton;
        $this->acceptedFiles = $acceptedFiles;
        $this->fileUploadName = $fileUploadName;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.forms.file-upload');
    }
}
