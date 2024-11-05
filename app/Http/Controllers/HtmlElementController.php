<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\HtmlElements;

class HtmlElementController extends Controller
{
    public function index()
    {
        $htmlElements = HtmlElements::all();
        return view('html-elements.index', compact('htmlElements'));
    }

    public function create()
    {
        return view('html-elements.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'htmlTag' => 'required|string',
            'purpose' => 'nullable|string',
            'code' => 'nullable|string',
        ]);

        HtmlElements::create($request->only(['htmlTag', 'purpose', 'code']));
        return redirect()->route('html-elements.index')->with('success', 'HTML Element added successfully.');
    }

    public function edit($id)
    {
        $htmlElement = HtmlElements::findOrFail($id);
        return view('html-elements.edit', compact('htmlElement'));
    }

    public function update(Request $request, $id)
    {
        $htmlElement = HtmlElements::findOrFail($id);

        $request->validate([
            'htmlTag' => 'required|string',
            'purpose' => 'nullable|string',
            'code' => 'nullable|string',
        ]);

        $htmlElement->update($request->only(['htmlTag', 'purpose', 'code']));
        return redirect()->route('html-elements.index')->with('success', 'HTML Element updated successfully.');
    }

    public function destroy($id)
    {
        $htmlElement = HtmlElements::findOrFail($id);
        $htmlElement->delete();

        return redirect()->route('html-elements.index')->with('success', 'HTML Element deleted successfully.');
    }
}
