<?php
include 'classes/controllers/DBController.php';

// Initialize the DBController for the 'daily_reports' model
$controller = new DBController('daily_report', 'read_all');

// Execute the action (fetch all daily reports)
$dailyReports = $controller->executeAction();
?>

<div class="max-w-screen-xl mx-auto p-5 sm:p-10 md:p-16">
    <h1 class="text-3xl font-bold text-center mb-8">Daily Reports</h1>
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        <?php foreach ($dailyReports as $report): ?>
            <div class="bg-white rounded-lg shadow-lg overflow-hidden p-6">
                <h2 class="text-xl font-semibold mb-2">Report Date: <?= htmlspecialchars($report['date']) ?></h2>
                <p class="text-gray-600 mb-4">Hall: <?= htmlspecialchars($report['hall']) ?></p>
                <p class="text-gray-600 mb-4">Device: <?= htmlspecialchars($report['device']) ?></p>
                <p class="text-gray-600 mb-4">Operator: <?= htmlspecialchars($report['operator']) ?></p>
                <p class="text-gray-600 mb-4">Project: <?= htmlspecialchars($report['project']) ?></p>
                <p class="text-gray-600 mb-4">Status: <?= htmlspecialchars($report['status']) ?></p>
                
                <!-- Display voice file if available -->
                <?php if (!empty($report['description_voice'])): ?>
                    <?php if (in_array(pathinfo($report['description_voice'], PATHINFO_EXTENSION), ['mp3', 'wav'])): ?>
                        <audio controls class="w-full">
                            <source src="<?= uploads_url($report['description_voice']) ?>" type="audio/<?= pathinfo($report['description_voice'], PATHINFO_EXTENSION) ?>">
                            Your browser does not support the audio element.
                        </audio>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
</div>
