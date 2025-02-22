<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class

// If form is submitted, process the request
if (isPostRequest()) {
    // Prepare the data for insertion
    $data = [
        'hall' => getPostData('hall'),
        'device_name' => getPostData('device_name'),
    ];

    // Validate the data (you can add more validation as needed)
    if (empty($data['hall']) || empty($data['device_name'])) {
        logError("Validation failed: Hall or Device Name is empty.");
        redirect('error.php'); // Redirect to an error page
        exit;
    }

    try {
        // Initialize the DBController for the 'device' model
        $controller = new DBController('device', 'create', null, $data);

        // Execute the action (create a new device)
        $result = $controller->executeAction();

        if ($result) {
            // Redirect to a success page
            redirect('index.php?page=devices&sidebarClickedItem=device&navbarClickedItem=all');
        } else {
            throw new Exception("Failed to create device.");
        }
    } catch (Exception $e) {
        logError($e->getMessage());
        redirect('error.php'); // Redirect to an error page
    }
}
?>
<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Device Form</h2>
    
    <form method="post" action="" id="deviceForm">
        <!-- Hall -->
        <label class="block font-semibold">Hall</label>
        <select name="hall" class="w-full border p-2 mb-4 rounded">
            <option value="sabok">Sabok</option>
            <option value="sangin1">Sangin 1</option>
            <option value="sangin2">Sangin 2</option>
            <option value="7000metri">7000 Metri</option>
            <option value="4000metri">4000 Metri</option>
            <option value="sookhtpash1">Sookhtpash 1</option>
            <option value="sookhtpash2">Sookhtpash 2</option>
            <option value="khatte_ajor">Khatte Ajor</option>
        </select>

        <!-- Device Name -->
        <label class="block font-semibold">Device Name</label>
        <input type="text" name="device_name" class="w-full border p-2 mb-4 rounded" required>

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>
