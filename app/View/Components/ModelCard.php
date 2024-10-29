<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModelCard extends Component
{
    public $modelName;
    public $modelDescription;
    public $modelAttributes;
    public $modelStatistics;
    public $isDrawingPart;
    public $drawingImageUrl;

    public function __construct(
        $modelName,
        $modelDescription = null,
        $modelAttributes = [],
        $modelStatistics = [],
        $isDrawingPart = false,
        $drawingImageUrl = null
    ) {
        $this->modelName = $modelName;
        $this->modelDescription = $modelDescription;
        $this->modelAttributes = $modelAttributes;
        $this->modelStatistics = $modelStatistics;
        $this->isDrawingPart = $isDrawingPart;
        $this->drawingImageUrl = $drawingImageUrl;
    }

    public function render()
    {
        return view('components.model-card');
    }
}
