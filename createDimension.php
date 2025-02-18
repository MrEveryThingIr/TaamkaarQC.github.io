<?php include "partials/admin/header.php"; ?>
<?php include "partials/admin/navbar.php"; ?>

<?php
$partId = isset($_GET['part_id']) ? (int)$_GET['part_id'] : null;

if (isPostRequest()) {
    $dimension = new Dimension();

    $data['part_id'] = $partId ? $partId : getPostData('part_id');
    $data['tag'] = getPostData('tag');
	$data['station_code'] = getPostData('station_code');
    $data['nominal_size'] = getPostData('nominal_size');
    $data['tolerance_upper'] = getPostData('tolerance_upper');
    $data['tolerance_lower'] = getPostData('tolerance_lower');
    $data['description'] = getPostData('description', '');
    $data['accepted'] = getPostData('accepted', 0);

    if ($dimension->create($data)) {
        redirect("part-show.php?part_id={$data['part_id']}");
    } else {
        echo "<p class='text-danger'>Failed to create dimension. Please try again.</p>";
    }
}
?>


<main class="container my-5 ShowByClickAddPart">
<h2 class="mb-4">Create New Dimension</h2>
    <form method="post">
        <input type="hidden" name="part_id" value="<?= htmlspecialchars($partId); ?>">

        <!-- Tag -->
        <div class="mb-3">
            <label for="tag" class="form-label">Tag *</label>
            <input type="text" class="form-control" id="tag" name="tag" placeholder="Enter tag" required>
        </div>

		 <div class="mb-3">
            <label for="station_code" class="form-label">کد ایستگاه</label>
            <input type="text" class="form-control" id="station_code" name="station_code" placeholder="Enter station code" required>
        </div>

        <!-- Nominal Size -->
        <div class="mb-3">
            <label for="nominal_size" class="form-label">اندازه اصلی *</label>
            <input type="text" class="form-control" id="nominal_size" name="nominal_size" placeholder="Enter nominal size" required>
        </div>

        <!-- Upper Tolerance -->
        <div class="mb-3">
            <label for="tolerance_upper" class="form-label">تلرانس بالا</label>
            <input type="text" class="form-control" id="tolerance_upper" name="tolerance_upper" placeholder="Enter upper tolerance">
        </div>

        <!-- Lower Tolerance -->
        <div class="mb-3">
            <label for="tolerance_lower" class="form-label">تلرانس پایین</label>
            <input type="text" class="form-control" id="tolerance_lower" name="tolerance_lower" placeholder="Enter lower tolerance">
        </div>

        <!-- Description -->
        <div class="mb-3">
            <label for="description" class="form-label">دیگر توضیحات</label>
            <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter any additional notes or remarks"></textarea>
        </div>

        <!-- Accepted -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="accepted" name="accepted" value="1">
            <label for="accepted" class="form-check-label">Accepted</label>
        </div>

        <!-- Submit and Cancel Buttons -->
        <div class="d-flex justify-content-start mt-4">
            <button type="submit" class="btn btn-success me-2">افزودن بعد</button>
            <a href="part-show.php?part_id=<?= htmlspecialchars($partId); ?>" class="btn btn-secondary">لغو</a>
        </div>
    </form>
</main>

<?php include "partials/admin/footer.php"; ?>
