<?php
require_once 'classes/Part.php';

$part = new Part();
$data = $_POST;

// Insert data into database
$part->create($data);

echo json_encode(["message" => "Part saved successfully"]);
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Part Registration Form</h2>
    
    <form method="post" action="" id="partForm">
        <!-- Part Name -->
        <label class="block font-semibold">Part Name</label>
        <input type="text" name="name" class="w-full border p-2 mb-4 rounded" required>

        <!-- Material -->
        <label class="block font-semibold">Material</label>
        <input type="text" name="material" class="w-full border p-2 mb-4 rounded">

        <!-- Project ID -->
        <label class="block font-semibold">Project ID</label>
        <input type="number" name="project_id" class="w-full border p-2 mb-4 rounded" required>

        <!-- Location -->
        <label class="block font-semibold">Location</label>
        <input type="text" name="location" class="w-full border p-2 mb-4 rounded">

        <!-- Type -->
        <label class="block font-semibold">Type</label>
        <input type="text" name="type" class="w-full border p-2 mb-4 rounded">

        <!-- DWG ID (Foreign Key to Drawings) -->
        <label class="block font-semibold">Drawing ID (DWG ID)</label>
        <input type="number" name="dwg_id" class="w-full border p-2 mb-4 rounded" required>

        <!-- Sample Count -->
        <label class="block font-semibold">Samples Count</label>
        <input type="number" name="samples_count" class="w-full border p-2 mb-4 rounded">

        <!-- Description -->
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 mb-4 rounded"></textarea>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>