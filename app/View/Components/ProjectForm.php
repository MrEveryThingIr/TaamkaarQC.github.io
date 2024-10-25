<?php
namespace App\View\Components;

use Illuminate\View\Component;
use App\Models\Orderer;

class ProjectForm extends Component
{
    public $orderer;

    public function __construct(Orderer $orderer)
    {
        $this->orderer = $orderer;
    }

    public function render()
    {
        return view('components.project-form');
    }
}
