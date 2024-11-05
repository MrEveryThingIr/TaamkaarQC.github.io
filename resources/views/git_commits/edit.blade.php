@extends('layouts.app')

@section('content')
<h1>Edit Git Commit</h1>

<form method="POST" action="{{ route('git-commits.update', $gitCommit) }}">
    @csrf
    @method('PUT')
    <input type="text" name="branch" value="{{ $gitCommit->branch }}" required>
    <input type="text" name="safdarCoded" value="{{ $gitCommit->safdarCoded }}" required>
    <input type="text" name="gitCode" value="{{ $gitCommit->gitCode }}" required>
    <input type="text" name="commitMessage" value="{{ $gitCommit->commitMessage }}" required>
    <button type="submit">Update</button>
</form>
@endsection
