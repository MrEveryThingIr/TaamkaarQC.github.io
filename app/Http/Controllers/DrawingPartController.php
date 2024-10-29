<?php

namespace App\Http\Controllers;

use App\Models\DrawingPart;
use Illuminate\Http\Request;
use App\Models\Project;

class DrawingPartController extends Controller
{
     // List all DrawingParts for a specific project
     public function index(Project $project)
     {
         $drawingParts = $project->drawingParts;
         return view('dashboard', compact('drawingParts', 'project'));
     }

     // Show the form to create a new DrawingPart
     public function create(Project $project)
     {
         return view('', compact('project'));
     }

     // Store a new DrawingPart in the database
     public function store(Request $request, Project $project)
     {
         $validated = $request->validate([
             'drawing_code' => 'required|string|unique:drawing_parts,drawing_code',
             'drawing_file' => 'required|file',
             'part_name' => 'required|string',
             'part_number' => 'required|string',
             'part_type' => 'required|string',
             'part_material' => 'required|string',
             'device' => 'required|string',
             'part_description' => 'nullable|string'
         ]);

         // Save the drawing file
         $file = $request->file('drawing_file')->store('public/drawings');
         $validated['drawing_file'] = basename($file);
         $validated['project_id'] = $project->id;

         DrawingPart::create($validated);

         return redirect()->route('dashboard', $project)->with('success', 'DrawingPart created successfully.');
     }

     // Show details of a specific DrawingPart
     public function show(DrawingPart $drawingPart)
     {
         return view('drawing_parts.show', compact('drawingPart'));
     }
}
