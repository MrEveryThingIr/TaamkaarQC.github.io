<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class

// If form is submitted, process the request
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Handle file upload for the Drawing File
    $drawingFileName = handleFileUpload('drawings', 'drawing_file');
    if (!$drawingFileName) {
        logError("Failed to upload Drawing file.");
        redirect('error.php'); // Redirect to an error page
        exit;
    }

    // Prepare the data for insertion
    $data = [
        'project_id' => $_POST['project_id'],
        'drawing_number' => $_POST['drawing_number'],
        'drawing_file' => $drawingFileName, // Save the relative path
    ];

    try {
        // Initialize the DBController for the 'drawing' model
        $controller = new DBController('drawing', 'create', null, $data);

        // Execute the action (create a new drawing)
        $result = $controller->executeAction();

        if ($result) {
            // Redirect to a success page
            redirect('index.php?page=PMS&sidebarClickedItem=drawing&navbarClickedItem=all');
        } else {
            throw new Exception("Failed to register drawing.");
        }
    } catch (Exception $e) {
        logError($e->getMessage());
        redirect('error.php'); // Redirect to an error page
    }
}

// Fetch project list dynamically
$controller = new DBController('project', 'read_all');
$projects = $controller->executeAction();
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Drawing Registration Form</h2>
    
    <form method="post" action="" id="drawingForm" enctype="multipart/form-data">
        <!-- Project ID -->
        <label class="block font-semibold">Project ID</label>
        <select name="project_id" class="w-full border p-2 mb-4 rounded" required>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project['id'] ?>">Project #<?= htmlspecialchars($project['id']) ?> - <?= htmlspecialchars($project['title']) ?></option>
            <?php endforeach; ?>
        </select>

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
