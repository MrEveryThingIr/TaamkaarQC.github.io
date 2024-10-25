<?php
namespace App\Http\Controllers;

use App\Models\Orderer;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{
    // Show form to create a new project for a specific orderer
    public function create(Orderer $orderer)
    {
        return view('projects.create', compact('orderer'));
    }

    // Store the new project for the specified orderer
    public function store(Request $request, Orderer $orderer)
    {
        // Validate the form data
        $validatedData = $request->validate([
            'project_title' => 'required|string|max:255',
            'order_no' => 'required|string|max:50',
            'project_description' => 'nullable|string',
            'project_manager' => 'nullable|string|max:100',
            'start_date' => 'nullable|date',
        ]);

        // Create a new project associated with the specified orderer
        $orderer->projects()->create($validatedData);

        // Redirect back to the orderer page or projects listing with success message
        return redirect()->route('orderers.show', $orderer->id)->with('success', 'پروژه با موفقیت ثبت شد');
    }
}
