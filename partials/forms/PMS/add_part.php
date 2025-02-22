<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class

// Handle form submission for part registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'name' => $_POST['name'],
        'material' => $_POST['material'],
        'project_id' => $_POST['project_id'],
        'location' => $_POST['location'],
        'type' => $_POST['type'],
        'dwg_id' => $_POST['dwg_id'],
        'samples_count' => $_POST['samples_count'],
        'description' => $_POST['description'],
    ];
    
    $controller = new DBController('part', 'create', null, $data);
    $result = $controller->executeAction();
    if ($result) {
        header('Location: index.php?page=PMS&sidebarClickedItem=part&navbarClickedItem=all');
        exit;
    } else {
        echo "<p class='text-red-500'>Failed to register part.</p>";
    }
}

// Initialize the DBController for the 'drawing' model to get drawing list
$controller = new DBController('drawing', 'read_all');
$drawings = $controller->executeAction();

// Initialize the DBController for the 'project' model to get project list
$controller = new DBController('project', 'read_all');
$projects = $controller->executeAction();
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg"> 
    <h2 class="text-2xl font-bold text-center mb-4">Part Registration Form</h2>
    <form method="post" action="" id="partForm">
        <label class="block font-semibold">Part Name</label>
        <input type="text" name="name" class="w-full border p-2 mb-4 rounded" required>
        <label class="block font-semibold">Material</label>
        <input type="text" name="material" class="w-full border p-2 mb-4 rounded">
        <label class="block font-semibold">Project ID</label>
        <select name="project_id" class="w-full border p-2 mb-4 rounded" required>
            <?php foreach ($projects as $project): ?>
                <option value="<?= $project['id'] ?>">Project #<?= htmlspecialchars($project['id']) ?> - <?= htmlspecialchars($project['title']) ?></option>
            <?php endforeach; ?>
        </select>
        <label class="block font-semibold">Location</label>
        <input type="text" name="location" class="w-full border p-2 mb-4 rounded">
        <label class="block font-semibold">Type</label>
        <input type="text" name="type" class="w-full border p-2 mb-4 rounded">
        <label class="block font-semibold">Drawing ID (DWG ID)</label>
        <select name="dwg_id" class="w-full border p-2 mb-4 rounded" required>
            <?php foreach ($drawings as $drawing): ?>
                <option value="<?= $drawing['id'] ?>">Drawing #<?= htmlspecialchars($drawing['id']) ?> - <?= htmlspecialchars($drawing['drawing_number']) ?></option>
            <?php endforeach; ?>
        </select>
        <label class="block font-semibold">Samples Count</label>
        <input type="number" name="samples_count" class="w-full border p-2 mb-4 rounded">
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 mb-4 rounded"></textarea>
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>