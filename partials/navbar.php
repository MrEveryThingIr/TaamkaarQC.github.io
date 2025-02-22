<?php 
function generateNavbar($items) {
    echo '<div class="w-full border-b border-gray-300 dark:border-gray-700 bg-white dark:bg-gray-800 shadow-md">';
    echo '<ul class="flex flex-wrap -mb-px text-base font-semibold text-center text-gray-700 dark:text-gray-300">';

    foreach ($items as $item) {
        $isActive = isset($item['active']) && $item['active'] 
            ? 'text-blue-600 border-b-4 border-blue-600 dark:text-blue-400 dark:border-blue-400 bg-gray-100 dark:bg-gray-700' 
            : 'border-transparent hover:text-gray-600 hover:border-gray-300 dark:hover:text-gray-300 hover:bg-gray-100 dark:hover:bg-gray-700';
        
        $icon = isset($item['icon']) ? $item['icon'] : ''; // SVG icon

        echo '<li class="mx-2 my-1">';
        echo '<a href="' . htmlspecialchars($item['url']) . '" class="flex items-center gap-3 px-5 py-3 ' . $isActive . ' rounded-lg transition-all duration-200">';
        echo $icon . '<span>' . htmlspecialchars($item['label']) . '</span>';
        echo '</a>';
        echo '</li>';
    }

    echo '</ul>';
    echo '</div>';
}

$navbarItems = [];
$navbarClickedItem = $_GET['navbarClickedItem'] ?? ''; // Get navbar item from query

$navConfig = [
    'project' => [
        ['label' => 'همه پروژه ها', 'url' => 'index.php?page=PMS&sidebarClickedItem=project&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'تعریف پروژه جدید', 'url' => 'index.php?page=PMS&sidebarClickedItem=project&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
        ['label' => 'گزارش روزانه', 'url' => 'index.php?page=PMS&sidebarClickedItem=project&navbarClickedItem=daily_report', 'active' => $navbarClickedItem === 'daily_report'],
    ],
    'drawing' => [
        ['label' => 'همه ی نقشه ها', 'url' => 'index.php?page=PMS&sidebarClickedItem=drawing&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'انتساب نقشه', 'url' => 'index.php?page=PMS&sidebarClickedItem=drawing&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
    'part' => [
        ['label' => 'همه قطعات', 'url' => 'index.php?page=PMS&sidebarClickedItem=part&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'انتساب قطعه', 'url' => 'index.php?page=PMS&sidebarClickedItem=part&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
    'operator' => [
        ['label' => 'همه اپراتورها', 'url' => 'index.php?page=PMS&sidebarClickedItem=operator&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'تعریف اپراتور جدید', 'url' => 'index.php?page=PMS&sidebarClickedItem=operator&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
    'device' => [
        ['label' => 'همه دستگاه ها', 'url' => 'index.php?page=PMS&sidebarClickedItem=device&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'افزودن دستگاه', 'url' => 'index.php?page=PMS&sidebarClickedItem=device&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
    'sample' => [
        ['label' => 'همه نمونه ها', 'url' => 'index.php?page=PMS&sidebarClickedItem=sample&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'افزودن نمونه', 'url' => 'index.php?page=PMS&sidebarClickedItem=sample&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
    'dimension' => [
        ['label' => 'همه ابعاد', 'url' => 'index.php?page=PMS&sidebarClickedItem=dimension&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'افزودن بعد', 'url' => 'index.php?page=PMS&sidebarClickedItem=dimension&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
    'daily_report' => [
        ['label' => 'گزارشات روزانه', 'url' => 'index.php?page=PMS&sidebarClickedItem=daily_report&navbarClickedItem=all', 'active' => $navbarClickedItem === 'all'],
        ['label' => 'افزودن گزارش', 'url' => 'index.php?page=PMS&sidebarClickedItem=daily_report&navbarClickedItem=add', 'active' => $navbarClickedItem === 'add'],
    ],
];

if (isset($navConfig[$sidebarClickedItem])) {
    $navbarItems = $navConfig[$sidebarClickedItem];
}

// Render the navbar
generateNavbar($navbarItems);
?>
