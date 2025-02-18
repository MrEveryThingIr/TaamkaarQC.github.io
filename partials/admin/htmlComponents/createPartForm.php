<div class="container">
    <h2 class="my-4">Create New Part</h2>
    <form method="post" enctype="multipart/form-data">
        <input type="hidden" name="project_id" value="<?= htmlspecialchars($_GET['project_id'] ?? '') ?>">

        <!-- Part Name -->
        <div class="mb-3">
            <label for="name" class="form-label">Part Name *</label>
            <input type="text" class="form-control" id="name" name="name" placeholder="Enter part name" required>
        </div>

        <!-- Material -->
        <div class="mb-3">
            <label for="material" class="form-label">Material *</label>
            <input type="text" class="form-control" id="material" name="material" placeholder="Enter material type" required>
        </div>

        <!-- Location -->
        <div class="mb-3">
            <label for="location" class="form-label">Location *</label>
            <input type="text" class="form-control" id="location" name="location" placeholder="Enter part location" required>
        </div>

        <!-- Type -->
        <div class="mb-3">
            <label for="type" class="form-label">Type *</label>
            <input type="text" class="form-control" id="type" name="type" placeholder="Enter part type" required>
        </div>

        <!-- DWG Code -->
        <div class="mb-3">
            <label for="dwg_code" class="form-label">DWG Code</label>
            <input type="text" class="form-control" id="dwg_code" name="dwg_code" placeholder="Enter DWG code">
        </div>

        <!-- DWG File -->
        <div class="mb-3">
            <label for="dwg_file" class="form-label">DWG File</label>
            <input type="file" class="form-control" id="dwg_file" name="dwg_file">
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-success me-2">Create Part</button>
            <a href="tamkarproject-show.php?id=<?= htmlspecialchars($_GET['project_id'] ?? '') ?>" class="btn btn-secondary">Cancel</a>
        </div>
    </form>
</div>