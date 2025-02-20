<?php
require_once 'classes/Drawing.php';

$drawing = new Drawing();
$data = $_POST;

// Handle drawing file upload
$drawingFile = handleFileUpload('drawings', 'drawing_file');
if ($drawingFile) {
    $data['drawing_file'] = uploads_url("drawings/$drawingFile"); 
} else {
    $data['drawing_file'] = "";
}

// Insert data into database
$drawing->create($data);

echo json_encode(["message" => "Drawing saved successfully"]);
?>
<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Drawing Registration Form</h2>
    
    <form method="post" action="" id="drawingForm" enctype="multipart/form-data">
        <!-- Project ID -->
        <label class="block font-semibold">Project ID</label>
        <input type="number" name="project_id" class="w-full border p-2 mb-4 rounded" required>

        <!-- Drawing Number -->
        <label class="block font-semibold">Drawing Number</label>
        <input type="text" name="drawing_number" class="w-full border p-2 mb-4 rounded" required>

        <!-- Drawing File Upload -->
        <label class="block font-semibold">Drawing File</label>
        <input type="file" name="drawing_file" id="drawingFileInput" class="w-full border p-2 mb-4 rounded" required>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>
