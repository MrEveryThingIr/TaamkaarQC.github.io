{{-- <div> --}}
    <!-- Simplicity is the ultimate sophistication. - Leonardo da Vinci -->
{{-- </div> --}}

{{-- <div> --}}
    <!-- Be present above all else. - Naval Ravikant -->
{{-- </div> --}}




<div class="container p-6 mx-auto bg-white rounded-lg shadow-lg">
    <h1 class="mb-4 text-2xl font-bold">Create New Drawing Part</h1>

    <form action="{{ route('projects.drawing-parts.store', ['project' => $project->id]) }}" method="POST" enctype="multipart/form-data" class="space-y-4">
        @csrf
        <!-- Part Name -->
        <div>
            <label for="part_name" class="block text-sm font-medium text-gray-700">Part Name</label>
            <input type="text" name="part_name" id="part_name" value="{{ old('part_name') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('part_name') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Part Number -->
        <div>
            <label for="part_number" class="block text-sm font-medium text-gray-700">Part Number</label>
            <input type="text" name="part_number" id="part_number" value="{{ old('part_number') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('part_number') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Part Type -->
        <div>
            <label for="part_type" class="block text-sm font-medium text-gray-700">Part Type</label>
            <input type="text" name="part_type" id="part_type" value="{{ old('part_type') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('part_type') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Material -->
        <div>
            <label for="part_material" class="block text-sm font-medium text-gray-700">Material</label>
            <input type="text" name="part_material" id="part_material" value="{{ old('part_material') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('part_material') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Device -->
        <div>
            <label for="device" class="block text-sm font-medium text-gray-700">Device</label>
            <input type="text" name="device" id="device" value="{{ old('device') }}" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('device') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Part Description -->
        <div>
            <label for="part_description" class="block text-sm font-medium text-gray-700">Description</label>
            <textarea name="part_description" id="part_description" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">{{ old('part_description') }}</textarea>
            @error('part_description') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Drawing Code -->
        <div>
            <label for="drawing_code" class="block text-sm font-medium text-gray-700">Drawing Code</label>
            <input type="text" name="drawing_code" id="drawing_code" value="{{ old('drawing_code') }}" required class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('drawing_code') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Drawing File -->
        <div>
            <label for="drawing_file" class="block text-sm font-medium text-gray-700">Upload Drawing File</label>
            <input type="file" name="drawing_file" id="drawing_file" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm">
            @error('drawing_file') <p class="text-sm text-red-600">{{ $message }}</p> @enderror
        </div>

        <!-- Submit Button -->
        <div>
            <button type="submit" class="px-4 py-2 text-white bg-blue-600 rounded-md shadow-md hover:bg-blue-700">Create Drawing Part</button>
        </div>
    </form>
</div>
