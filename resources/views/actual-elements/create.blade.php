@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Element to Blade File</h2>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form action="{{ route('actual-elements.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="blade_directory">Blade File Directory (e.g., `pages/home`):</label>
            <input type="text" name="blade_directory" id="blade_directory" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="blade_section">Blade Section:</label>
            <input type="text" name="blade_section" id="blade_section" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="elementId">HTML Element:</label>
            <select name="elementId" id="elementId" class="form-control">
                @foreach ($htmlElements as $element)
                    <option value="{{ $element->id }}">{{ $element->htmlTag }} - {{ $element->purpose }}</option>
                @endforeach
            </select>
            <a href="{{ route('html-elements.create') }}" class="mt-2 btn btn-sm btn-secondary">Add New HTML Element</a>
        </div>

        <div class="form-group">
            <label for="classId">Element Class:</label>
            <select name="classId" id="classId" class="form-control">
                @foreach ($elementClasses as $class)
                    <option value="{{ $class->id }}">{{ $class->className }} - {{ $class->purpose }}</option>
                @endforeach
            </select>
            <a href="{{ route('element-classes.create') }}" class="mt-2 btn btn-sm btn-secondary">Add New Class</a>
        </div>

        <button type="submit" class="btn btn-success">Add Element to Blade File</button>
    </form>
</div>
@endsection
