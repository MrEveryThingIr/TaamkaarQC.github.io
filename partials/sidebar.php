<?php 
// $items = [];

// if (isset($_GET['user_action'])) {
//     $user_action = $_GET['user_action'];
    
//     if ($user_action == 'profile') {
        $items = [
            'افزودن گزارش' => 'index.php?page=dashboard&user_action=add_report',
            ' لیست گزارشات روزانه' => 'index.php?page=dashboard&user_action=watch_list',
            'پیگیری پیشرفت قطعات' => 'index.php?page=dashboard&user_action=follow_part',
            'حذف گزارش' => 'index.php?page=dashboard&user_action=profile&action=delete',
            // 'مدیریت حساب' => [
            //     'تغییر رمز عبور' => 'index.php?page=dashboard&user_action=profile&action=change_password',
            //     'امنیت حساب' => [
            //         'فعال‌سازی دو مرحله‌ای' => 'index.php?page=dashboard&user_action=profile&action=2fa',
            //         'لیست دستگاه‌های فعال' => 'index.php?page=dashboard&user_action=profile&action=devices',
            //     ],
            // ],
        ];
//     }
// }
?>
<aside class="bg-sidebar h-screen w-64 hidden sm:block shadow-xl flex flex-col">
    <div class="p-6">
        <a href="index.php?page=home" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            پروین تایر
        </a>
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> اطلاعیه ها
        </button>
    </div>

    <nav class="text-white text-base font-semibold flex-grow overflow-y-auto">
        <?php 
        function renderMenuItems($items) {
            foreach ($items as $title => $linkOrDropdownItems) {
                if (is_array($linkOrDropdownItems)) {
                    echo "<div x-data='{ open: false }' class='w-full'>
                            <button @click='open = !open' class='flex items-center w-full text-white opacity-75 hover:opacity-100 py-4 pl-6 pr-6 nav-item'>
                                <i class='fas fa-chevron-down mr-3 transition-transform duration-200' :class='{ \"rotate-180\": open }'></i>
                                {$title}
                            </button>
                            <div x-show='open' class='ml-6 pl-2 bg-gray-800 rounded-md' x-transition>
                                <ul class='py-1'>";
                    renderMenuItems($linkOrDropdownItems);
                    echo "</ul>
                            </div>
                          </div>";
                } else {
                    // Normal link
                    echo "<a href='{$linkOrDropdownItems}' class='block text-white opacity-75 hover:opacity-100 py-3 pl-8 pr-6 nav-item'>
                            {$title}
                          </a>";
                }
            }
        }

        renderMenuItems($items);
        ?>
    </nav>

    <div class="p-6 mt-auto">
        <a href="#" class="w-full block text-center text-white opacity-75 hover:opacity-100 py-3 bg-gray-700 rounded-md">
            <i class="fas fa-arrow-circle-up mr-3"></i> Upgrade to Pro!
        </a>
    </div>
</aside>