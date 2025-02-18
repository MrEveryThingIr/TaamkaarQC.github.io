<?php
require_once 'classes/controllers/ReportController.php';

// Initialize the ReportController
$reportController = new ReportController();

// Fetch all records
$reports = $reportController->handleAction('list');
?>

<div class="container mx-auto p-4">
    <h1 class="text-2xl font-bold text-gray-800 mb-6">لیست گزارش‌ها</h1>

    <!-- Table -->
    <div class="bg-white shadow-md rounded-lg overflow-hidden">
      <table class="min-w-full divide-y divide-gray-200">
        <thead class="bg-gray-50">
          <tr>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تاریخ</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">سالن</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">دستگاه</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">اپراتور</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">پروژه</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">قطعه</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تعداد</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">شماره نقشه</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">تکنولوژی</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">خودکنترلی</th>
            <th class="px-6 py-3 text-right text-xs font-medium text-gray-500 uppercase tracking-wider">عملیات</th>
          </tr>
        </thead>
        <tbody class="bg-white divide-y divide-gray-200">
          <?php if (!empty($reports)): ?>
            <?php foreach ($reports as $report): ?>
              <!-- Main Row -->
              <tr class="hover:bg-gray-50 transition-colors">
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['date']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['hall']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['device']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['operator']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['project']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['part_name']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['part_number']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900"><?= htmlspecialchars($report['dwg_number']) ?></td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $report['technology'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <?= $report['technology'] ? 'دارد' : 'ندارد' ?>
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-900">
                  <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium <?= $report['self_control'] ? 'bg-green-100 text-green-800' : 'bg-red-100 text-red-800' ?>">
                    <?= $report['self_control'] ? 'دارد' : 'ندارد' ?>
                  </span>
                </td>
                <td class="px-6 py-4 whitespace-nowrap text-sm font-medium">
                  <a href="edit.php?id=<?= $report['id'] ?>" class="text-indigo-600 hover:text-indigo-900">
                    <i class="fas fa-edit"></i>
                  </a>
                  <a href="index.php?page=dashboard&user_action=watch_listdelete.php?id=<?= $report['id'] ?>" class="text-red-600 hover:text-red-900 ml-2">
                    <i class="fas fa-trash"></i>
                  </a>
                </td>
              </tr>

              <!-- Description Row -->
              <tr>
                <td colspan="12" class="px-6 py-4 bg-gray-50">
                  <textarea class="w-full p-2 border border-gray-300 rounded-md resize-none" rows="3" readonly><?= htmlspecialchars($report['description']) ?></textarea>
                </td>
              </tr>
            <?php endforeach; ?>
          <?php else: ?>
            <tr>
              <td colspan="12" class="px-6 py-4 whitespace-nowrap text-sm text-gray-500 text-center">هیچ گزارشی یافت نشد.</td>
            </tr>
          <?php endif; ?>
        </tbody>
      </table>
    </div>
  </div>