@extends('layouts.app')

@section('content')
<h1>Git Commit Details</h1>

<p><strong>Branch:</strong> {{ $gitCommit->branch }}</p>
<p><strong>Safdar Coded:</strong> {{ $gitCommit->safdarCoded }}</p>
<p><strong>Git Code:</strong> {{ $gitCommit->gitCode }}</p>
<p><strong>Commit Message:</strong> {{ $gitCommit->commitMessage }}</p>

<a href="{{ route('git-commits.index') }}">Back to List</a>
@endsection
