<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class

// Initialize the DBController for the 'drawing' model
$controller = new DBController('drawing', 'read_all');

// Execute the action (fetch all drawings)
$drawings = $controller->executeAction();
?>

<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <h1 class="text-3xl font-bold text-center mb-8">Drawings</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($drawings as $drawing): ?>
            <a href="index.php?page=PMS&sidebarClickedItem=drawings&drawing_id=<?= $drawing['id'] ?>" class="block transform transition duration-300 hover:scale-105">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <!-- Drawing File -->
                    <div class="relative h-48">
                        <img class="w-full h-full object-cover" src="<?= uploads_url($drawing['drawing_file']) ?>" alt="<?= htmlspecialchars($drawing['drawing_number']) ?>">
                        <div class="absolute inset-0 bg-black opacity-25"></div>
                    </div>
                    <!-- Drawing Content -->
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">Drawing Number: <?= htmlspecialchars($drawing['drawing_number']) ?></h2>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-2">Project ID: <?= htmlspecialchars($drawing['project_id']) ?></span>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>