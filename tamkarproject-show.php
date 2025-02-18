<?php include "partials/admin/header.php"; ?>

<?php include "partials/admin/navbar.php"; ?>
<?php
$projectId = isset($_GET['id']) ? (int)$_GET['id'] : null;

if ($projectId !== null) {
    $project = new TamkarProject();
    $part = new Part();

    // Fetch project details and associated parts
    $projectDetails = $project->get_by_id($projectId);
    $parts = $part->getByProjectId($projectId);

    // Check if the project exists
    if (!$projectDetails) {
        echo "<p class='text-danger'>Project with ID {$projectId} not found.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger'>No project ID provided in the URL.</p>";
    exit;
}
?>

<main class="container my-5">
    <h2 class="mb-4">Project: <?= htmlspecialchars($projectDetails->title); ?></h2>

    <!-- Display project details in a table -->
    <div class="table-responsive mb-4">
        <table class="table table-bordered">
            <thead class="table-dark">
                <tr>
                    <th>Field</th>
                    <th>Value</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($projectDetails as $key => $value): ?>
                    <?php if ($key === 'orderer_brand'): ?>
                        <tr>
                            <td><?= ucfirst(str_replace('_', ' ', $key)); ?></td>
                            <td>
                                <?php if (!empty($value)): ?>
                                    <img src="uploads/orderers_brands/<?= htmlspecialchars($value); ?>" 
                                         class="img-fluid" 
                                         alt="Orderer Brand Image" 
                                         style="max-width: 200px;">
                                <?php else: ?>
                                    No image available
                                <?php endif; ?>
                            </td>
                        </tr>
                    <?php else: ?>
                        <tr>
                            <td><?= ucfirst(str_replace('_', ' ', $key)); ?></td>
                            <td><?= htmlspecialchars($value); ?></td>
                        </tr>
                    <?php endif; ?>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Part Button -->
    <div class="mb-4">
        <a href="create-part.php?project_id=<?= $projectId; ?>" class="btn btn-success">Add Part</a>
    </div>

    <!-- Display parts list in a table -->
    <h3>Parts List</h3>
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Material</th>
                    <th>Location</th>
                    <th>Type</th>
                    <th>DWG Code</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($parts)): ?>
                    <?php foreach ($parts as $p): ?>
                        <tr>
                            <td><?= htmlspecialchars($p->id); ?></td>
                            <td>
                                <a href="part-show.php?project_id=<?= $projectId; ?>&part_id=<?= $p->id; ?>">
                                    <?= htmlspecialchars($p->name); ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($p->material); ?></td>
                            <td><?= htmlspecialchars($p->location); ?></td>
                            <td><?= htmlspecialchars($p->type); ?></td>
                            <td><?= htmlspecialchars($p->dwg_code); ?></td>
                            <td>
                                <a href="edit_part.php?id=<?= $p->id; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete_part.php?id=<?= $p->id; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="7" class="text-center">No parts found for this project.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include "partials/admin/footer.php"; ?>
