@extends('layouts.app')

@section('content')
<h1>Create Git Commit</h1>

<form method="POST" action="{{ route('git-commits.store') }}">
    @csrf
    <input type="text" name="branch" placeholder="Branch" required>
    <input type="text" name="safdarCoded" placeholder="Safdar Coded" required>
    <input type="text" name="gitCode" placeholder="Git Code" required>
    <input type="text" name="commitMessage" placeholder="Commit Message" required>
    <button type="submit">Save</button>
</form>
@endsection
