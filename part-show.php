<?php include "partials/admin/header.php"; ?>
<?php include "partials/admin/navbar.php"; ?>

<?php
$projectId = isset($_GET['project_id']) ? (int)$_GET['project_id'] : null;
$partId = isset($_GET['part_id']) ? (int)$_GET['part_id'] : null;

if ($partId !== null) {
    $part = new Part();
    $dimension = new Dimension();

    // Fetch part details
    $partDetails = $part->get_by_id($partId);

    // Fetch associated dimensions
    $dimensions = $dimension->getByPartId($partId);

    if (!$partDetails) {
        echo "<p class='text-danger'>Part with ID {$partId} not found.</p>";
        exit;
    }
} else {
    echo "<p class='text-danger'>No part ID provided in the URL.</p>";
    exit;
}
?>

<main class="container my-5">
    <h2 class="mb-4">Part: <?= htmlspecialchars($partDetails->name); ?></h2>

    <!-- Display part details in a horizontally scrollable table -->
    <div class="table-responsive mb-4 table-scroll">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <?php foreach ($partDetails as $key => $value): ?>
                        <th><?= ucfirst(str_replace('_', ' ', $key)); ?></th>
                    <?php endforeach; ?>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <?php foreach ($partDetails as $key => $value): ?>
                        <?php if ($key === 'dwg_file'): ?>
                            <td>
                                <?php if (!empty($value)): ?>
                                    <a href="<?= uploads_url('dwg_files/' . htmlspecialchars($value)); ?>" target="_blank">Download Drawing</a>
                                <?php else: ?>
                                    No drawing available
                                <?php endif; ?>
                            </td>
                        <?php else: ?>
                            <td><?= htmlspecialchars($value); ?></td>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tr>
            </tbody>
        </table>
    </div>


    <!-- Display the drawing image -->
    <div class="text-center mb-5">
        <?php if (!empty($partDetails->dwg_file)): ?>
            <img width="10000" src="<?= uploads_url('dwg_files/' . htmlspecialchars($partDetails->dwg_file)); ?>" 
                 class="img-fluid border rounded" 
                 alt="Drawing of <?= htmlspecialchars($partDetails->name); ?>" 
                 style="max-width: 100%; height: auto;">
        <?php else: ?>
            <p class="text-danger">No drawing available to display.</p>
        <?php endif; ?>
    </div>

    <!-- Display dimensions in a horizontally scrollable table -->
    <h3>Dimensions</h3>
    <div class="table-responsive mb-4">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Tag</th>
					<th>station Code</th>
                    <th>Nominal Size</th>
                    <th>Upper Tolerance</th>
                    <th>Lower Tolerance</th>
                    <th>Description</th>
                    <th>Accepted</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($dimensions)): ?>
                    <?php foreach ($dimensions as $dim): ?>
                        <tr>
                            <td><?= htmlspecialchars($dim->id); ?></td>
                            <td><?= htmlspecialchars($dim->tag); ?></td>
							<td><?= htmlspecialchars($dim->station_code); ?></td>
                            <td><?= htmlspecialchars($dim->nominal_size); ?></td>
                            <td><?= htmlspecialchars($dim->tolerance_upper); ?></td>
                            <td><?= htmlspecialchars($dim->tolerance_lower); ?></td>
                            <td><?= htmlspecialchars($dim->description); ?></td>
                            <td><?= $dim->accepted ? 'Yes' : 'No'; ?></td>
                            <td>
                                <a href="edit_dimension.php?id=<?= $dim->id; ?>" class="btn btn-sm btn-warning">Edit</a>
                                <a href="delete_dimension.php?id=<?= $dim->id; ?>" class="btn btn-sm btn-danger">Delete</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="8" class="text-center">No dimensions found for this part.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>

    <!-- Add Dimension Button -->
    <div class="mt-4">
        <a href="createDimension.php?part_id=<?= $partId; ?>" class="btn btn-success">Add Dimension</a>
    </div>
</main>

<?php include "partials/admin/footer.php"; ?>
