<?php include "partials/admin/header.php"; ?>
<?php include "partials/admin/navbar.php"; ?>
<?php
include "partials/admin/hero.php";
?>
<?php
$project = new TamkarProject();
$projects = $project->get_all(); // Assuming this fetches all projects
?>

<main class="container my-5">
    <h2 class="mb-4">Projects List</h2>

    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle">
            <thead class="table-dark">
                <tr>
                    <th>شناسه</th>
                    <th>عنوان پروژه</th>
                    <th>نام کارفرما</th>
					<th>برند کارفرما</th>
                    <th>مدیر پروژه</th>
                    <th>شماره سفارش</th>
					<th>کد کالا</th>
					<th>وضعیت</th>
                    <th>اعمال</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($projects)): ?>
                    <?php foreach ($projects as $projectDetails): ?>
                        <tr>
                            <td><?= htmlspecialchars($projectDetails->id); ?></td>
                            <td>
                                <a href="tamkarproject-show.php?id=<?= $projectDetails->id; ?>">
                                    <?= htmlspecialchars($projectDetails->title); ?>
                                </a>
                            </td>
                            <td><?= htmlspecialchars($projectDetails->orderer_name); ?></td>
							<td><img width=50 src="<?= uploads_url('orderers_brands/' . htmlspecialchars($projectDetails->orderer_brand)); ?>"></td>
                            <td><?= htmlspecialchars($projectDetails->project_manager); ?></td>
                            <td><?= htmlspecialchars($projectDetails->order_no); ?></td>
							<td><?= htmlspecialchars($projectDetails->product_code); ?></td>
							<td><?= htmlspecialchars($projectDetails->completed_at); ?></td>
                            <td>
                                <a href="edit_project.php?id=<?= $projectDetails->id; ?>" class="btn btn-sm btn-primary me-1">ویرایش</a>
                                <button class="btn btn-sm btn-danger" onclick="confirmDelete(<?= $projectDetails->id; ?>)">حذف</button>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="text-center">پروژه ای یافت نشد. <a href="create-project.php">پروژه جدید </a></td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</main>

<?php include "partials/admin/footer.php"; ?>


