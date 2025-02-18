<?php 
// Include necessary files (e.g., ReportController and Report classes)

require_once 'classes/controllers/ReportController.php';
// Initialize the ReportController
$reportController = new ReportController();

// Handle form submission
if (isPostRequest() && isset($_GET['action']) && $_GET['action'] === 'add') {
    // Collect and sanitize POST data
    $data = [
        'date' => getPostData('date'),
        'hall' => getPostData('hall'),
        'device' => getPostData('device'),
        'operator' => getPostData('operator'),
        'project' => getPostData('project'),
        'part_name' => getPostData('part_name'),
        'part_number' => getPostData('part_number'),
        'dwg_number' => getPostData('dwg_number'),
        'technology' => isset($_POST['technology']) ? 1 : 0, // Boolean: 1 for دارد, 0 for ندارد
        'self_control' => isset($_POST['self_control']) ? 1 : 0, // Boolean: 1 for دارد, 0 for ندارد
        'description' => getPostData('description')
    ];

    // Handle file upload (if needed)
    // Example: $data['file'] = handleFileUpload('reports', 'file');

    // Insert the data using the ReportController
    if ($reportController->handleAction('add', $data)) {
        redirect("index.php?page=dashboard&user_action=add_report&status=success");
    } else {
        echo "<div class='bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative mb-4' role='alert'>خطا در ذخیره گزارش.</div>";
    }
}
?>
<div class="w-full max-w-3xl bg-white p-8 rounded-lg shadow-lg">
    <form method="POST" id="projectForm" action="index.php?page=dashboard&user_action=add_report&action=add" class="mt-8">
      <!-- Form Fields -->
      <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <!-- Date -->
        <div class="mb-4">
        <label for="date" class="block text-gray-700 text-sm font-bold mb-2">تاریخ</label>
        <input type="text" name="date" id="date" readonly
               class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 bg-gray-100 leading-tight focus:outline-none focus:shadow-outline">
      </div>

        <!-- Hall -->
        <div class="mb-4">
          <label for="hall" class="block text-gray-700 text-sm font-bold mb-2">سالن</label>
          <input type="text" name="hall" id="hall" required
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Device -->
        <div class="mb-4">
          <label for="device" class="block text-gray-700 text-sm font-bold mb-2">دستگاه</label>
          <input type="text" name="device" id="device" required
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Operator -->
        <div class="mb-4">
          <label for="operator" class="block text-gray-700 text-sm font-bold mb-2">اپراتور</label>
          <input type="text" name="operator" id="operator" required
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Project -->
        <div class="mb-4">
          <label for="project" class="block text-gray-700 text-sm font-bold mb-2">پروژه</label>
          <input type="text" name="project" id="project" required
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Part Name -->
        <div class="mb-4">
          <label for="part_name" class="block text-gray-700 text-sm font-bold mb-2">قطعه</label>
          <input type="text" name="part_name" id="part_name" required
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Part Number -->
        <div class="mb-4">
          <label for="part_number" class="block text-gray-700 text-sm font-bold mb-2">تعداد</label>
          <input type="number" name="part_number" id="part_number" required min="1"
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Drawing Number -->
        <div class="mb-4">
          <label for="dwg_number" class="block text-gray-700 text-sm font-bold mb-2">شماره نقشه</label>
          <input type="text" name="dwg_number" id="dwg_number" required
                 class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
        </div>

        <!-- Technology Toggle -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">تکنولوژی</label>
          <div class="flex items-center space-x-4">
            <div class="relative inline-block w-10 align-middle select-none">
              <input type="checkbox" id="technology" name="technology" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 appearance-none cursor-pointer"/>
              <label for="technology" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
            <span id="technology-status" class="text-gray-700">ندارد</span>
          </div>
        </div>

        <!-- Self Control Toggle -->
        <div class="mb-4">
          <label class="block text-gray-700 text-sm font-bold mb-2">خودکنترلی</label>
          <div class="flex items-center space-x-4">
            <div class="relative inline-block w-10 align-middle select-none">
              <input type="checkbox" id="self_control" name="self_control" class="toggle-checkbox absolute block w-6 h-6 rounded-full bg-white border-2 appearance-none cursor-pointer"/>
              <label for="self_control" class="toggle-label block overflow-hidden h-6 rounded-full bg-gray-300 cursor-pointer"></label>
            </div>
            <span id="self-control-status" class="text-gray-700">ندارد</span>
          </div>
        </div>
      </div>

      <!-- Description -->
      <div class="mb-4">
        <label for="description" class="block text-gray-700 text-sm font-bold mb-2">توضیحات</label>
        <textarea name="description" id="description" rows="4" required
                  class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline"></textarea>
      </div>

      <!-- Save Button -->
      <div class="flex justify-center mt-6">
        <button type="submit" id="saveButton"
                class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-6 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:ring-offset-2 transition-all">
          ذخیره
        </button>
      </div>
    </form>
  </div>