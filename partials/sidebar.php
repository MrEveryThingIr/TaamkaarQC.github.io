<?php 
$items = [];

if ($page == 'PMS') {
    $items = [
        'پروژه ها' => 'index.php?page=PMS&sidebarClickedItem=project',
        'نقشه ها' => 'index.php?page=PMS&sidebarClickedItem=drawing',
        'قطعه ها' => 'index.php?page=PMS&sidebarClickedItem=part',
        'اپراتورها' => 'index.php?page=PMS&sidebarClickedItem=operator',
        'دستگاه ها' => 'index.php?page=PMS&sidebarClickedItem=device',
        'نمونه ها' => 'index.php?page=PMS&sidebarClickedItem=sample',
        'ابعاد' => 'index.php?page=PMS&sidebarClickedItem=dimension',
        'گزارش روزانه' => 'index.php?page=PMS&sidebarClickedItem=daily_report',
    ];
}
?>

<aside class="bg-sidebar h-screen w-64 hidden sm:block shadow-xl flex flex-col">
    <div class="p-6">
        <a href="index.php?page=home" class="text-white text-3xl font-semibold uppercase hover:text-gray-300">
            مدیریت کیفی تامکار   
        </a>
        <button class="w-full bg-white cta-btn font-semibold py-2 mt-5 rounded-br-lg rounded-bl-lg rounded-tr-lg shadow-lg hover:shadow-xl hover:bg-gray-300 flex items-center justify-center">
            <i class="fas fa-plus mr-3"></i> اطلاعیه ها
        </button>
    </div>

    <nav class="text-white text-base font-semibold flex-grow overflow-y-auto">
        <?php 
        function renderMenuItems($items) {
            foreach ($items as $title => $link) {
                echo "<a href='{$link}' class='block text-white opacity-75 hover:opacity-100 py-3 pl-8 pr-6 nav-item'>
                        {$title}
                      </a>";
            }
        }

        renderMenuItems($items);
        ?>
    </nav>

    <div class="p-6 mt-auto">
        <a href="#" class="w-full block text-center text-white opacity-75 hover:opacity-100 py-3 bg-gray-700 rounded-md">
            <i class="fas fa-arrow-circle-up mr-3"></i> ارتباط باما
        </a>
    </div>
</aside>
