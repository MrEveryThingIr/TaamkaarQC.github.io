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
        <div class="form-group">
            <label for="project_title" class="formlabel">عنوان پروژه</label>
            <input class="input-field" type="text" name="project_title" id="project_title" required>
            @error('project_title')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Order Number -->
        <div class="form-group">
            <label for="order_no" class="formlabel">شماره سفارش</label>
            <input class="input-field" type="text" name="order_no" id="order_no" required>
            @error('order_no')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Project Description -->
        <div class="form-group">
            <label for="project_description" class="formlabel">شرح پروژه</label>
            <textarea name="project_description" id="project_description" cols="30" rows="4" class="input-field"></textarea>
            @error('project_description')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Project Manager -->
        <div class="form-group">
            <label for="project_manager" class="formlabel">مدیر پروژه</label>
            <input class="input-field" type="text" name="project_manager" id="project_manager">
            @error('project_manager')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Start Date -->
        <div class="form-group">
            <label for="start_date" class="formlabel">تاریخ شروع بکار</label>
            <input class="input-field" type="date" name="start_date" id="start_date">
            @error('start_date')
                <p class="mt-1 text-sm text-red-500">{{ $message }}</p>
            @enderror
        </div>

        <!-- Submit Button -->
        <button class="btn-primary" type="submit">ثبت پروژه</button>
    </form>
</div>
