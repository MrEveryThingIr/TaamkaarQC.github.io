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
if($sidebarClickedItem == 'projects') {
$navbarClickedItem = $_GET['navbarClickedItem'] ?? ''; // Get navbar item from query

$navbarItems = [
    [
        'label' => 'همه پروژه ها',
        'url' => 'index.php?page=PMS&sidebarClickedItem=projects&navbarClickedItem=all',
        'icon' => '<svg class="w-6 h-6 text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M3 3h14a1 1 0 0 1 1 1v12a1 1 0 0 1-1 1H3a1 1 0 0 1-1-1V4a1 1 0 0 1 1-1Zm0 2v10h14V5H3Zm2 2h10v2H5V7Zm0 4h10v2H5v-2Z"/></svg>',
        'active' => $navbarClickedItem === 'all'
    ],
    [
        'label' => 'تعریف پروژه جدید',
        'url' => 'index.php?page=PMS&sidebarClickedItem=projects&navbarClickedItem=add_project',
        'icon' => '<svg class="w-6 h-6 text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M10 2a8 8 0 1 0 8 8 8.011 8.011 0 0 0-8-8Zm1 9h3a1 1 0 0 0 0-2h-3V6a1 1 0 0 0-2 0v3H6a1 1 0 0 0 0 2h3v3a1 1 0 0 0 2 0v-3Z"/></svg>',
        'active' => $navbarClickedItem === 'add_project'
    ],
    [
        'label' => 'گزارش روزانه',
        'url' => 'index.php?page=PMS&sidebarClickedItem=projects&navbarClickedItem=daily_report',
        'icon' => '<svg class="w-6 h-6 text-gray-500 group-hover:text-gray-700 dark:text-gray-400 dark:group-hover:text-gray-300" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 20 20"><path d="M4 2a2 2 0 0 0-2 2v12a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V6.828a2 2 0 0 0-.586-1.414L14.586 2.586A2 2 0 0 0 13.172 2H4Zm0 2h8v4h4v8H4V4Zm6 2a1 1 0 0 1 1 1v1h1a1 1 0 0 1 0 2h-1v1a1 1 0 1 1-2 0v-1H7a1 1 0 1 1 0-2h1V7a1 1 0 0 1 1-1Z"/></svg>',
        'active' => $navbarClickedItem === 'daily_report'
    ],
];
}

// if()

// Render the navbar
generateNavbar($navbarItems);
?>
