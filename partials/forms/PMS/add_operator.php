<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class

// Handle form submission for operator registration
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'first_name' => $_POST['first_name'],
        'last_name' => $_POST['last_name'],
        'nick_name' => $_POST['nick_name'] ?? null, // Optional field
    ];

    // Initialize the DBController for the 'operator' model
    $controller = new DBController('operator', 'create', null, $data);
    $result = $controller->executeAction();
    
    if ($result) {
        header('Location: index.php?page=PMS&sidebarClickedItem=operator&navbarClickedItem=all');
        exit;
    } else {
        echo "<p class='text-red-500'>Failed to register operator.</p>";
    }
}
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Operator Registration Form</h2>
    
    <form method="post" action="" id="operatorForm">
        <!-- First Name -->
        <label class="block font-semibold">First Name</label>
        <input type="text" name="first_name" class="w-full border p-2 mb-4 rounded" required>

        <!-- Last Name -->
        <label class="block font-semibold">Last Name</label>
        <input type="text" name="last_name" class="w-full border p-2 mb-4 rounded" required>

        <!-- Nick Name -->
        <label class="block font-semibold">Nick Name</label>
        <input type="text" name="nick_name" class="w-full border p-2 mb-4 rounded">

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>
