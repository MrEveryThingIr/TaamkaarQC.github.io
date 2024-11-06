@extends('layouts.app')

@section('content')
<div class="overflow-x-auto">
    <table class="min-w-full bg-white border border-gray-200">
        <!-- Table Caption -->
        <caption class="p-4 text-lg font-semibold text-gray-700 bg-gray-100 border-b border-gray-200">
            The List of All Existing Classes
        </caption>

        <!-- Table Head -->
        <thead>
            @if(!empty($elementClasses))
                <tr class="text-sm leading-normal text-gray-600 uppercase bg-gray-200">
                    @foreach (array_keys($elementClasses[0]) as $field_key)
                        <th class="px-6 py-3 font-semibold">{{ $field_key }}</th>
                    @endforeach
                    <th class="px-6 py-3 font-semibold text-center">Actions</th> <!-- New Actions Column -->
                </tr>
            @else
                <tr>
                    <th class="px-6 py-3 text-center" colspan="7">There are no classes to display.</th>
                </tr>
            @endif
        </thead>

        <!-- Table Body -->
        <tbody class="text-sm font-light text-gray-700">
            @forelse ($elementClasses as $elementClass)
                <tr class="border-b border-gray-200 hover:bg-gray-100">
                    @foreach ($elementClass as $field_value)
                        <td class="px-6 py-3">{{ $field_value }}</td>
                    @endforeach
                    <td class="px-6 py-3 text-center">
                        <!-- Edit Button -->
                        <a href="{{ route('element-classes.edit', $elementClass['id']) }}" class="mr-2 text-blue-500 hover:text-blue-700">
                            Edit
                        </a>

                        <!-- Delete Button with a Form for Deleting via POST -->
                        <form action="{{ route('element-classes.destroy', $elementClass['id']) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure you want to delete this item?');" class="text-red-500 hover:text-red-700">
                                Delete
                            </button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr>
                    <td class="px-6 py-3 text-center" colspan="7">There are no classes to display.</td>
                </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
