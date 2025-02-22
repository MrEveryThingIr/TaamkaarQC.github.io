<?php
include 'classes/controllers/DBController.php';

// Initialize the DBController for the 'project' model
$controller = new DBController('project', 'read_all');

// Execute the action (fetch all projects)
$projects = $controller->executeAction();
?>
     <div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
        <h1 class="text-3xl font-bold text-center mb-8">Projects</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <?php foreach ($projects as $project): ?>
                <a href="index.php?page=PMS&project_id=<?= $project['id'] ?>" class="block transform transition duration-300 hover:scale-105">
                    <div class="bg-white rounded-lg shadow-lg overflow-hidden">
                        <!-- Project Image or Audio -->
                        <div class="relative h-48">
                            <?php if (in_array(pathinfo($project['orderer_brand'], PATHINFO_EXTENSION), ['jpg', 'jpeg', 'png', 'gif'])): ?>
                                <img class="w-full h-full object-cover" src="<?= uploads_url($project['orderer_brand']) ?>" alt="<?= htmlspecialchars($project['title']) ?>">
                            <?php elseif (in_array(pathinfo($project['orderer_brand'], PATHINFO_EXTENSION), ['mp3', 'wav'])): ?>
                                <audio controls class="w-full h-full">
                                    <source src="<?= uploads_url($project['orderer_brand']) ?>" type="audio/<?= pathinfo($project['orderer_brand'], PATHINFO_EXTENSION) ?>">
                                    Your browser does not support the audio element.
                                </audio>
                            <?php endif; ?>
                            <div class="absolute inset-0 bg-black opacity-25"></div>
                        </div>
                        <!-- Project Content -->
                        <div class="p-6">
                            <h2 class="text-xl font-semibold mb-2"><?= htmlspecialchars($project['title']) ?></h2>
                            <p class="text-gray-600 mb-4"><?= htmlspecialchars($project['description']) ?></p>
                            <div class="flex items-center text-sm text-gray-500">
                                <span class="mr-2"><?= date('M j, Y', strtotime($project['start_date'])) ?></span>
                                <span>•</span>
                                <span class="ml-2"><?= htmlspecialchars($project['orderer_name']) ?></span>
                            </div>
                        </div>
                    </div>
                </a>
            <?php endforeach; ?>
        </div>
    </div>