<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ElementClasses;

class ElementClassController extends Controller
{
    public function index()
    {
        $elementClasses = \App\Models\ElementClasses::all()->toArray();
        return view('element-classes.index', compact('elementClasses'));
    }

//     public function index()
// {
//     $elementClasses = \App\Models\ElementClasses::all()->toArray();
//     dd($elementClasses); // Use this to check the structure before passing to the view
//     return view('your_view', compact('elementClasses'));
// }
    public function create()
    {
        return view('element-classes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'elementTag' => 'required|string',
            'className' => 'required|string',
            'purpose' => 'nullable|string',
            'classString' => 'required|string',
            'features' => 'nullable|string',
        ]);

        ElementClasses::create($request->only(['elementTag', 'className', 'purpose', 'classString', 'features']));
        return redirect()->route('element-classes.index')->with('success', 'Element Class added successfully.');
    }

    public function edit($id)
    {
        $elementClass = ElementClasses::findOrFail($id);
        return view('element-classes.edit', compact('elementClass'));
    }

    public function update(Request $request, $id)
    {
        $elementClass = ElementClasses::findOrFail($id);

        $request->validate([
            'elementTag' => 'required|string',
            'className' => 'required|string',
            'purpose' => 'nullable|string',
            'classString' => 'required|string',
            'features' => 'nullable|string',
        ]);

        $elementClass->update($request->only(['elementTag', 'className', 'purpose', 'classString', 'features']));
        return redirect()->route('element-classes.index')->with('success', 'Element Class updated successfully.');
    }

    public function destroy($id)
    {
        $elementClass = ElementClasses::findOrFail($id);
        $elementClass->delete();

        return redirect()->route('element-classes.index')->with('success', 'Element Class deleted successfully.');
    }
}
