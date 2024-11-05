@extends('layouts.app')

@section('content')
<h1>Git Commits</h1>

<!-- Search Form -->
<form method="GET" action="{{ route('git-commits.index') }}">
    <input type="text" name="branch" placeholder="Search by branch" value="{{ request('branch') }}">
    <input type="text" name="safdarCoded" placeholder="Search by safdarCoded" value="{{ request('safdarCoded') }}">
    <input type="text" name="gitCode" placeholder="Search by gitCode" value="{{ request('gitCode') }}">
    <input type="text" name="commitMessage" placeholder="Search by commitMessage" value="{{ request('commitMessage') }}">
    <button type="submit">Search</button>
</form>

<!-- Display List -->
<table>
    <tr>
        <th>Branch</th>
        <th>SafdarCoded</th>
        <th>Git Code</th>
        <th>Commit Message</th>
        <th>Actions</th>
    </tr>
    @foreach($gitCommits as $commit)
    <tr>
        <td>{{ $commit->branch }}</td>
        <td>{{ $commit->safdarCoded }}</td>
        <td>{{ $commit->gitCode }}</td>
        <td>{{ $commit->commitMessage }}</td>
        <td>
            <a href="{{ route('git-commits.show', $commit) }}">View</a>
            <a href="{{ route('git-commits.edit', $commit) }}">Edit</a>
            <form action="{{ route('git-commits.destroy', $commit) }}" method="POST" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="submit">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>

{{ $gitCommits->links() }} <!-- Pagination links -->

@endsection
