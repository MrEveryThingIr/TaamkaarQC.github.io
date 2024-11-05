@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Add New Element Class</h2>

    <form action="{{ route('element-classes.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="elementTag">Element Tag:</label>
            <input type="text" name="elementTag" id="elementTag" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="className">Class Name:</label>
            <input type="text" name="className" id="className" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="purpose">Purpose:</label>
            <input type="text" name="purpose" id="purpose" class="form-control">
        </div>

        <div class="form-group">
            <label for="classString">Class String (CSS):</label>
            <input type="text" name="classString" id="classString" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="features">Features:</label>
            <textarea name="features" id="features" class="form-control"></textarea>
        </div>

        <button type="submit" class="btn btn-primary">Add Class</button>
    </form>
</div>
@endsection
