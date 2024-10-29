<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NestedItemComponent extends Component
{

    public $item;
    public $subItems;
    public $labelField;
    public $childField;
    public $idField;

    public function __construct($item, $subItems, $labelField, $childField = null, $idField = 'id')
    {
        $this->item = $item;
        $this->subItems = $subItems;
        $this->labelField = $labelField;
        $this->childField = $childField;
        $this->idField = $idField;
    }


    public function render(): View|Closure|string
    {
        return view('components.nested-item-component');
    }
}
