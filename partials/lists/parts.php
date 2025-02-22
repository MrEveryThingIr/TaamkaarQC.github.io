<?php
require_once 'classes/controllers/DBController.php'; // Include the DBController class
$controller = new DBController('part', 'read_all');
$parts = $controller->executeAction();
?>

<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <h1 class="text-3xl font-bold text-center mb-8">Parts</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($parts as $part): ?>
            <a href="index.php?page=PMS&sidebarClickedItem=parts&part_id=<?= $part['id'] ?>" class="block transform transition duration-300 hover:scale-105">
                <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                    <div class="p-6">
                        <h2 class="text-xl font-semibold mb-2">Part Name: <?= htmlspecialchars($part['name']) ?></h2>
                        <p class="text-gray-600 mb-4">Material: <?= htmlspecialchars($part['material']) ?></p>
                        <div class="flex items-center text-sm text-gray-500">
                            <span class="mr-2">Project ID: <?= htmlspecialchars($part['project_id']) ?></span>
                            <span>•</span>
                            <span class="ml-2">Drawing ID: <?= htmlspecialchars($part['dwg_id']) ?></span>
                        </div>
                    </div>
                </div>
            </a>
        <?php endforeach; ?>
    </div>
</div>
