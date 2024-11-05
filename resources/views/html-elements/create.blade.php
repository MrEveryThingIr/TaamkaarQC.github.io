@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New HTML Element</h2>

    <form action="{{ route('html-elements.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="htmlTag">HTML Tag:</label>
            <input type="text" name="htmlTag" id="htmlTag" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose:</label>
            <input type="text" name="purpose" id="purpose" class="form-control">
        </div>

        <div class="form-group">
            <label for="code">Default Code:</label>
            <textarea name="code" id="code" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Element</button>
    </form>
</div>
@endsection
