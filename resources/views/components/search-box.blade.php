<!-- resources/views/components/search-box.blade.php -->
<form action="{{ route('dashboard.search') }}" method="GET" class="p-4 space-y-4 bg-white border border-gray-200 rounded shadow-md">
    @csrf

    <label for="field" class="block mb-2 text-lg font-semibold">جستجو براساس:</label>

    <div class="flex items-center space-x-4">
        <!-- Field Selection Dropdown -->
        <select name="field" id="field" class="w-1/3 p-2 text-sm bg-white border rounded">
            <option value="id">شناسه پروژه</option>
            <option value="project_name">عنوان پروژه</option>
            <option value="project_orderer">کارفرما</option>
            <option value="project_manager">مدیر پروژه</option>
            <option value="project_description">توضیحات پروژه</option>
            <option value="start_date">تاریخ شروع بکار</option>
            <option value="end_date">تاریخ پایان</option>
            <option value="completed">تکمیل شده یا خیر</option>
            <option value="part_name">عنوان قطعه</option>
            <option value="part_type">نوع قطعه</option>
            <option value="part_material">جنس قطعه</option>
            <option value="device">دستگاه</option>
            <option value="drawing_number">شماره نقشه مربوط به قطعه</option>
            <option value="part_description">شرح قطعه</option>
        </select>

        <!-- Search Input -->
        <input type="text" name="searched" id="searched" class="w-1/2 p-2 text-sm border rounded" placeholder="جستجو..." aria-label="جستجو">

        <!-- Submit Button -->
        <button type="submit" class="p-2 text-white transition-colors bg-blue-500 rounded hover:bg-blue-600">جستجو کن!</button>
    </div>
</form>
