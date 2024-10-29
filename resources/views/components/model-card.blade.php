{{-- <div> --}}
    <!-- Well begun is half done. - Aristotle -->
{{-- </div> --}}

<div class="p-6 bg-white border border-gray-200 rounded-lg shadow-md">
    <div class="flex justify-between">
        <h2 class="text-2xl font-semibold text-gray-800">{{ $modelName }}</h2>
        <div class="flex space-x-2">
            <button class="px-4 py-2 text-white bg-green-600 rounded-md hover:bg-green-700">
                ایجاد نمونه از مدل
            </button>
            <button class="px-4 py-2 text-white bg-blue-600 rounded-md hover:bg-blue-700">
                ویرایش
            </button>
            <button class="px-4 py-2 text-white bg-red-600 rounded-md hover:bg-red-700">
                حذف
            </button>
        </div>
    </div>

    @if ($modelDescription)
        <div class="mt-4 text-gray-700">
            <p>{{ $modelDescription }}</p>
        </div>
    @endif

    <div class="grid grid-cols-1 gap-4 mt-6 sm:grid-cols-2 lg:grid-cols-3">
        @foreach ($modelAttributes as $attribute => $value)
            <div class="p-4 bg-gray-100 border border-gray-300 rounded-lg">
                <div class="text-sm font-semibold text-gray-600">{{ $attribute }}</div>
                <div class="text-lg font-medium text-gray-900">{{ $value }}</div>
            </div>
        @endforeach
    </div>

    @if ($modelStatistics)
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800">آمار و ارقام</h3>
            <div class="grid grid-cols-1 gap-4 mt-2 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($modelStatistics as $stat => $value)
                    <div class="p-4 border border-blue-200 rounded-lg bg-blue-50">
                        <div class="text-sm font-semibold text-blue-600">{{ $stat }}</div>
                        <div class="text-2xl font-medium text-blue-800">{{ $value }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    @endif

    @if ($isDrawingPart && $drawingImageUrl)
        <div class="mt-6">
            <h3 class="text-lg font-semibold text-gray-800">نقشه و قطعه مربوطه</h3>
            <div class="mt-4">
                <img src="{{ $drawingImageUrl }}" alt="Drawing Image" class="object-cover w-full h-auto rounded-lg shadow-md">
            </div>
        </div>
    @endif
</div>
