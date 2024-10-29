<?php

namespace App\View\Components;

use Closure;
use Illuminate\View\Component;
use Illuminate\Contracts\View\View;
use App\Models\Project;


class DrawingPartForm extends Component
{
    public $project;
    /**
     * Create a new component instance.
     */
    public function __construct(Project $project)
    {
        $this->project=$project;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.drawing-part-form');
    }
}
