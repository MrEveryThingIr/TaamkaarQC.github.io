<?php

namespace App\Http\Controllers;

use App\Models\GitCommit;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class GitCommitController extends Controller
{
    // Show all records with optional search functionality
    public function index(Request $request)
    {
        $query = GitCommit::query();

        // Apply filters based on search input
        if ($request->has('branch')) {
            $query->where('branch', 'like', '%' . $request->branch . '%');
        }
        if ($request->has('safdarCoded')) {
            $query->where('safdarCoded', 'like', '%' . $request->safdarCoded . '%');
        }
        if ($request->has('gitCode')) {
            $query->where('gitCode', 'like', '%' . $request->gitCode . '%');
        }
        if ($request->has('commitMessage')) {
            $query->where('commitMessage', 'like', '%' . $request->commitMessage . '%');
        }

        // Get the results
        $gitCommits = $query->paginate(10); // Pagination for better navigation

        return view('git_commits.index', compact('gitCommits'));
    }

    // Show create form
    public function create()
    {
        return view('git_commits.create');
    }

    // Store new record
    public function store(Request $request)
    {
        $validated = $request->validate([
            'branch' => 'required|string|max:255',
            'safdarCoded' => 'required|string|unique:git_commits|max:255',
            'gitCode' => 'required|string|unique:git_commits|max:255',
            'commitMessage' => 'required|string|unique:git_commits|max:255',
        ]);

        GitCommit::create($validated);

        return redirect()->route('git-commits.index')->with('success', 'Git commit added successfully.');
    }

    // Show a specific record
    public function show(GitCommit $gitCommit)
    {
        return view('git_commits.show', compact('gitCommit'));
    }

    // Show edit form
    public function edit(GitCommit $gitCommit)
    {
        return view('git_commits.edit', compact('gitCommit'));
    }

    // Update the record
    public function update(Request $request, GitCommit $gitCommit)
    {
        $validated = $request->validate([
            'branch' => 'required|string|max:255',
            'safdarCoded' => 'required|string|max:255|unique:git_commits,safdarCoded,' . $gitCommit->id,
            'gitCode' => 'required|string|max:255|unique:git_commits,gitCode,' . $gitCommit->id,
            'commitMessage' => 'required|string|max:255|unique:git_commits,commitMessage,' . $gitCommit->id,
        ]);

        $gitCommit->update($validated);

        return redirect()->route('git-commits.index')->with('success', 'Git commit updated successfully.');
    }

    // Delete a specific record
    public function destroy(GitCommit $gitCommit)
    {
        $gitCommit->delete();

        return redirect()->route('git-commits.index')->with('success', 'Git commit deleted successfully.');
    }
}
