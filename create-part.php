<?php
include "partials/admin/header.php";
include "partials/admin/navbar.php";

$projectId = isset($_GET['project_id']) ? (int)$_GET['project_id'] : null;

if (isPostRequest()) {
    $part = new Part();
    $data['name'] = getPostData('name');
    $data['material'] = getPostData('material');
    $data['project_id'] = $projectId ? $projectId : getPostData('project_id');
    $data['location'] = getPostData('location');
    $data['type'] = getPostData('type');
    $data['dwg_code'] = getPostData('dwg_code');
    $data['samples_number'] = getPostData('samples_number');
    $data['description'] = getPostData('description');

    // Handle file upload for `dwg_file`
    $data['dwg_file'] = fileUploade('dwg_files', 'dwg_file');

    $part_id = $part->create($data);
	if ($part_id && $part_id !== "partCreationFailed!") {
        for ($i = 0; $i < $data['samples_number']; $i++) {
            $sample = new Sample();
            $result = $sample->create([
                'part_id' => $part_id
            ]);
    
            if ($result !== "created sample") {
                echo "<p class='text-danger'>Sample creation failed for iteration {$i}.</p>";
            }
        }
        redirect("part-show.php?part_id={$part_id}");
    } else {
        echo "<p class='text-danger'>Failed to create part. Please try again.</p>";
    }
}
?>

<main class="container my-5">
    <div class="container">
        <h2 class="my-4">ایجاد قطعه جدید</h2>
        <form method="post" enctype="multipart/form-data">
            <input type="hidden" name="project_id" value="<?= htmlspecialchars($_GET['project_id'] ?? '') ?>">
            <!-- Part Name -->
            <div class="mb-3">
                <label for="name" class="form-label">نام قطعه *</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Enter part name" required>
            </div>
            <!-- Material -->
            <div class="mb-3">
                <label for="material" class="form-label">جنس قطعه *</label>
                <input type="text" class="form-control" id="material" name="material" placeholder="Enter material type" required>
            </div>
            <!-- Location -->
            <div class="mb-3">
                <label for="location" class="form-label">موقعیت قطعه *</label>
                <input type="text" class="form-control" id="location" name="location" placeholder="Enter part location" required>
            </div>
            <!-- Type -->
            <div class="mb-3">
                <label for="type" class="form-label">نوع قطعه *</label>
                <input type="text" class="form-control" id="type" name="type" placeholder="Enter part type" required>
            </div>
            <!-- DWG Code -->
            <div class="mb-3">
                <label for="dwg_code" class="form-label">کد نقشه</label>
                <input type="text" class="form-control" id="dwg_code" name="dwg_code" placeholder="Enter DWG code">
            </div>
            <!-- DWG File -->
            <div class="mb-3">
                <label for="dwg_file" class="form-label">بارگذاری نقشه</label>
                <input type="file" class="form-control" id="dwg_file" name="dwg_file">
            </div>
            <div class="mb-3">
                <label for="samples_number" class="form-label">تعداد نمونه از این قطعه</label>
                <input type="number" class="form-control" id="samples_number" name="samples_number">
            </div>
            <div class="mb-3">
                <label for="description" class="form-label">دیگر توضیحات</label>
                <textarea class="form-control" name="description" id="description" rows="10" cols="30"></textarea>
            </div>
            <!-- Submit and Cancel Buttons -->
            <div class="d-flex justify-content-start mt-4">
                <button type="submit" class="btn btn-success me-2">افزودن قطعه</button>
                <a href="tamkarproject-show.php?id=<?= htmlspecialchars($_GET['project_id'] ?? '') ?>" class="btn btn-secondary">لغو</a>
            </div>
        </form>
    </div>
</main>
<?php include "partials/admin/footer.php"; ?>
