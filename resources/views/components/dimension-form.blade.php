{{-- resources/views/components/dimension-form.blade.php --}}
@props(['drawingPart', 'project'])

<div class="p-6 bg-white rounded-lg shadow-md">
    <form action="{{ route('projects.drawing-parts.dimensions.store', [$project->id, $drawingPart->id]) }}" method="POST">
        @csrf

        <!-- Drawing Part ID (Hidden or Select Dropdown) -->
        <input type="hidden" name="drawing_part_id" value="{{ $drawingPart->id ?? old('drawing_part_id') }}">

        <!-- Tag Field -->
        <div class="mb-4">
            <label for="tag" class="block mb-2 text-sm font-bold text-gray-700">Tag</label>
            <input type="text" name="tag" id="tag" class="w-full p-2 border border-gray-300 rounded"
                   value="{{ old('tag') }}" required>
            @error('tag')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- View or Section Field -->
        <div class="mb-4">
            <label for="viewOrSection" class="block mb-2 text-sm font-bold text-gray-700">View or Section</label>
            <input type="text" name="viewOrSection" id="viewOrSection" class="w-full p-2 border border-gray-300 rounded"
                   value="{{ old('viewOrSection') }}" required>
            @error('viewOrSection')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Nominal Size Field -->
        <div class="mb-4">
            <label for="nominal_size" class="block mb-2 text-sm font-bold text-gray-700">Nominal Size</label>
            <input type="number" name="nominal_size" id="nominal_size" class="w-full p-2 border border-gray-300 rounded"
                   step="0.01" value="{{ old('nominal_size') }}" required>
            @error('nominal_size')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Upper Tolerance Field -->
        <div class="mb-4">
            <label for="UpperTolerance" class="block mb-2 text-sm font-bold text-gray-700">Upper Tolerance</label>
            <input type="number" name="UpperTolerance" id="UpperTolerance" class="w-full p-2 border border-gray-300 rounded"
                   step="0.01" value="{{ old('UpperTolerance') }}" required>
            @error('UpperTolerance')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Lower Tolerance Field -->
        <div class="mb-4">
            <label for="LowerTolerance" class="block mb-2 text-sm font-bold text-gray-700">Lower Tolerance</label>
            <input type="number" name="LowerTolerance" id="LowerTolerance" class="w-full p-2 border border-gray-300 rounded"
                   step="0.01" value="{{ old('LowerTolerance') }}" required>
            @error('LowerTolerance')
                <span class="text-sm text-red-600">{{ $message }}</span>
            @enderror
        </div>

        <!-- Submit Button -->
        <div class="flex justify-end">
            <button type="submit" class="px-4 py-2 font-bold text-white bg-blue-600 rounded hover:bg-blue-700">Save Dimension</button>
        </div>
    </form>
</div>
