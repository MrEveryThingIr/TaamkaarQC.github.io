<?php
require_once 'classes/Sample.php';

$sample = new Sample();
$data = $_POST;

// Insert data into database
$sample->create($data);

echo json_encode(["message" => "Sample saved successfully"]);
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Sample Registration Form</h2>
    
    <form method="post" action="" id="sampleForm">
        <!-- Part ID -->
        <label class="block font-semibold">Part ID</label>
        <input type="number" name="part_id" class="w-full border p-2 mb-4 rounded" required>

        <!-- Sample Code -->
        <label class="block font-semibold">Sample Code</label>
        <input type="text" name="sample_code" class="w-full border p-2 mb-4 rounded" required>

        <!-- Description -->
        <label class="block font-semibold">Description</label>
        <textarea name="description" class="w-full border p-2 mb-4 rounded"></textarea>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>

