@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Element Usage Tracker</h2>

    <table class="table table-striped">
        <thead>
            <tr>
                <th>Blade File</th>
                <th>Section (Blade Address)</th>
                <th>HTML Element</th>
                <th>Class</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($actualElements as $actualElement)
            <tr>
                <td>{{ $actualElement->bladeFile }}</td>
                <td>{{ $actualElement->blade_address }}</td>
                <td>{{ $actualElement->htmlElement->htmlTag }}</td>
                <td>{{ $actualElement->elementClass->className }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
