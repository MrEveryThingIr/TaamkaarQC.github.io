<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class

// If form is submitted, process the request
if (isPostRequest()) {
    // Handle file upload for the Orderer Brand image or voice
    $ordererBrandFileName = handleFileUpload('project_brands', 'orderer_brand');
    if (!$ordererBrandFileName) {
        logError("Failed to upload Orderer Brand file.");
        redirect('error.php'); // Redirect to an error page
        exit;
    }

    // Prepare the data for insertion
    $data = [
        'title' => getPostData('title'),
        'orderer_name' => getPostData('orderer_name'),
        'orderer_brand' => $ordererBrandFileName, // Save the relative path
        'project_manager' => getPostData('project_manager'),
        'order_no' => getPostData('order_no'),
        'product_code' => getPostData('product_code'),
        'start_date' => getPostData('start_date'),
        'completed_at' => getPostData('completed_at'),
        'description' => getPostData('description'),
    ];

    try {
        // Initialize the DBController for the 'project' model
        $controller = new DBController('project', 'create', null, $data);

        // Execute the action (create a new project)
        $result = $controller->executeAction();

        if ($result) {
            // Redirect to a success page
            redirect('index.php?page=PMS&sidebarClickedItem=project&navbarClickedItem=all');
        } else {
            throw new Exception("Failed to create project.");
        }
    } catch (Exception $e) {
        logError($e->getMessage());
        redirect('error.php'); // Redirect to an error page
    }
}

?>


<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Project Registration Form</h2>
    
    <form method="post" action="" id="tamkarProjectForm" enctype="multipart/form-data">
        <label class="block font-semibold">Project Title</label>
        <input type="text" name="title" class="w-full border p-2 mb-4 rounded" required>

        <label class="block font-semibold">Orderer Name</label>
        <input type="text" name="orderer_name" class="w-full border p-2 mb-4 rounded" required>

        <label class="block font-semibold">Orderer Brand (Image)</label>
        <input type="file" name="orderer_brand" id="ordererBrandInput" class="w-full border p-2 mb-4 rounded" accept="image/*" required>

        <label class="block font-semibold">Project Manager</label>
        <input type="text" name="project_manager" class="w-full border p-2 mb-4 rounded">

        <label class="block font-semibold">Order No</label>
        <input type="text" name="order_no" class="w-full border p-2 mb-4 rounded">

        <label class="block font-semibold">Product Code</label>
        <input type="text" name="product_code" class="w-full border p-2 mb-4 rounded">

        <label class="block font-semibold">Start Date</label>
        <input type="text" name="start_date" class="w-full border p-2 mb-4 rounded">

        <label class="block font-semibold">Completed At</label>
        <input type="text" name="completed_at" class="w-full border p-2 mb-4 rounded">

        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 mb-4 rounded"></textarea>

        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>
