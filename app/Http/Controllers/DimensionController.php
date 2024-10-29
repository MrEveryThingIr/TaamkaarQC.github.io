<?php
namespace App\Http\Controllers;

use App\Models\Dimension;
use Illuminate\Http\Request;

class DimensionController extends Controller
{
    public function store(Request $request, $project, $drawingPart)
    {
        $validatedData = $request->validate([
            'tag' => 'required|string|max:255|unique:unique:dimensions,tag',
            'viewOrSection' => 'string|max:255',
            'nominal_size' => 'required|numeric',
            'UpperTolerance' => 'string',
            'LowerTolerance' => 'string',
        ]);

        Dimension::create(array_merge($validatedData, ['drawing_part_id' => $drawingPart]));

        return redirect()->back()->with('success', 'Dimension added successfully.');
    }

    public function edit($project, $drawingPart, Dimension $dimension)
    {
        return view('dimensions.edit', compact('dimension'));
    }

    public function update(Request $request, $project, $drawingPart, Dimension $dimension)
    {
        $validatedData = $request->validate([
            'tag' => 'required|string|max:255',
            'viewOrSection' => 'required|string|max:255',
            'nominal_size' => 'required|numeric',
            'UpperTolerance' => 'required|numeric',
            'LowerTolerance' => 'required|numeric',
        ]);

        $dimension->update($validatedData);

        return redirect()->back()->with('success', 'Dimension updated successfully.');
    }

    public function destroy($project, $drawingPart, Dimension $dimension)
    {
        $dimension->delete();

        return redirect()->back()->with('success', 'Dimension deleted successfully.');
    }
}
