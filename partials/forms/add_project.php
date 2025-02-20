<?php
require_once 'classes/TamkarProject.php';

$project = new TamkarProject();
$data = $_POST;

// Handle orderer_brand file upload
$ordererBrandImage = handleFileUpload('orderer_brands', 'orderer_brand');
if ($ordererBrandImage) {
    $data['orderer_brand'] = uploads_url("orderer_brands/$ordererBrandImage");
} else {
    $data['orderer_brand'] = "";
}

// Insert data into the database
$project->create($data);

echo json_encode(["message" => "Project saved successfully"]);
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Project Registration Form</h2>
    
    <form method="post" action="" id="tamkarProjectForm" enctype="multipart/form-data">
        <!-- Project Title -->
        <label class="block font-semibold">Project Title</label>
        <input type="text" name="title" class="w-full border p-2 mb-4 rounded" required>

        <!-- Orderer Name -->
        <label class="block font-semibold">Orderer Name</label>
        <input type="text" name="orderer_name" class="w-full border p-2 mb-4 rounded" required>

        <!-- Orderer Brand (Image Upload) -->
        <label class="block font-semibold">Orderer Brand (Image)</label>
        <input type="file" name="orderer_brand" id="ordererBrandInput" class="w-full border p-2 mb-4 rounded" accept="image/*" required>

        <!-- Project Manager -->
        <label class="block font-semibold">Project Manager</label>
        <input type="text" name="project_manager" class="w-full border p-2 mb-4 rounded">

        <!-- Order No -->
        <label class="block font-semibold">Order No</label>
        <input type="text" name="order_no" class="w-full border p-2 mb-4 rounded">

        <!-- Product Code -->
        <label class="block font-semibold">Product Code</label>
        <input type="text" name="product_code" class="w-full border p-2 mb-4 rounded">

        <!-- Start Date -->
        <label class="block font-semibold">Start Date</label>
        <input type="date" name="start_date" class="w-full border p-2 mb-4 rounded">

        <!-- Completed At -->
        <label class="block font-semibold">Completed At</label>
        <input type="date" name="completed_at" class="w-full border p-2 mb-4 rounded">

        <!-- Description -->
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 mb-4 rounded"></textarea>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>
