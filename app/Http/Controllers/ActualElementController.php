<?php

namespace App\Http\Controllers;

use App\Models\HtmlElements;
use Illuminate\Http\Request;
use App\Models\ActualElement;
use App\Models\ElementClasses;
use App\Http\Controllers\Controller;

class ActualElementController extends Controller
{
     /**
     * Display form for creating/selecting HTML elements and classes.
     */
    public function create()
    {
        $htmlElements = HtmlElements::all();
        $elementClasses = ElementClasses::all();
        return view('actual-elements.create', compact('htmlElements', 'elementClasses'));
    }

    /**
     * Store an actual element configuration and update Blade file.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'blade_directory' => 'required|string',
            'blade_section' => 'required|string',
            'elementId' => 'required|exists:html_elements,id',
            'classId' => 'required|exists:element_classes,id'
        ]);

        // Create new ActualElement entry
        ActualElement::create($data);

        // Generate or update the Blade file
        return $this->generateBlade($data['blade_directory']);
    }

    /**
     * Generate or update Blade file with selected elements and classes.
     */
    public function generateBlade($blade_directory)
    {
        $filePath = resource_path("views/{$blade_directory}.blade.php");

        // Retrieve elements assigned to this Blade file
        $elements = ActualElement::with(['htmlElement', 'elementClass'])
            ->where('blade_directory', $blade_directory)
            ->get();

        // Build Blade content
        $bladeContent = "<!-- Auto-generated content for {$blade_directory} -->\n";
        foreach ($elements as $element) {
            $htmlTag = $element->htmlElement->htmlTag;
            $classString = $element->elementClass->classString;
            $bladeContent .= "<{$htmlTag} class=\"{$classString}\">{$element->htmlElement->code}</{$htmlTag}>\n";
        }

        // Write content to Blade file
        File::put($filePath, $bladeContent);

        return redirect()->route('actual-elements.create')->with('success', 'Blade file updated with selected elements.');
    }
    public function index()
    {
    $actualElements = ActualElement::with(['htmlElement', 'elementClass'])->get();
    return view('actual-elements.index', compact('actualElements'));
    }

}
