<!-- resources/views/components/project-form.blade.php -->

<div class="p-6 bg-white rounded shadow-md">
    {{-- Optional content slot --}}
    @if (trim($slot))
        <div class="mb-4">
            {{ $slot }}
        </div>
    @endif

    <!-- Project Creation Form -->
    <form action="{{ route('orderers.projects.store', ['orderer' => $orderer->id]) }}" method="POST" class="space-y-6">
        @csrf

        <!-- Project Title -->
        <div class="mb-4">
            <x-label for="project_title" value="عنوان پروژه" />
            <x-input id="project_title" class="block w-full mt-1" type="text" name="project_title" required />
            @error('project_title')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Order Number -->
        <div class="mb-4">
            <x-label for="order_no" value="شماره سفارش" />
            <x-input id="order_no" class="block w-full mt-1" type="text" name="order_no" required />
            @error('order_no')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Project Description -->
        <div class="mb-4">
            <x-label for="project_description" value="شرح پروژه" />
            <textarea id="project_description" name="project_description" cols="30" rows="4" class="block w-full mt-1 border-gray-300 rounded-md shadow-sm"></textarea>
            @error('project_description')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Project Manager -->
        <div class="mb-4">
            <x-label for="project_manager" value="مدیر پروژه" />
            <x-input id="project_manager" class="block w-full mt-1" type="text" name="project_manager" />
            @error('project_manager')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Start Date (Persian Format YYYY-MM-DD) -->
        <div class="mb-4">
            <x-label for="start_date" value="تاریخ شروع بکار (فرمت: YYYY-MM-DD)" />
            <x-input id="start_date" class="block w-full mt-1" type="text" name="start_date" pattern="\d{4}-\d{2}-\d{2}" placeholder="مثال: 1400-01-01" required />
            @error('start_date')
                <div class="mt-1 text-sm text-red-500">{{ $message }}</div>
            @enderror
        </div>

        <!-- Submit Button -->
        <x-button class="mt-4">ثبت پروژه</x-button>
    </form>
</div>
