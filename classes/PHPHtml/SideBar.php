<?php

class SideBar {
    private array $items;
    private array $jsConfig;
    private array $cssConfig;

    public function __construct(array $items, array $jsConfig, array $cssConfig) {
        $this->items = $items;
        $this->jsConfig = $jsConfig;
        $this->cssConfig = $cssConfig;
    }

    private function getActiveItem(): string {
        return $_GET['item_clicked'] ?? '';
    }

    private function renderMenuItems(array $items, string $activeItem) {
        foreach ($items as $title => $linkOrDropdownItems) {
            if (is_array($linkOrDropdownItems)) {
                // Check if any submenu item is active
                $isDropdownOpen = in_array($activeItem, array_values($linkOrDropdownItems)) ? 'true' : 'false';

                echo "<div {$this->generateJSAttributes($isDropdownOpen)}>";
                echo "<button class='{$this->cssConfig['dropdown_button']}'>{$title}</button>";
                echo "<div class='{$this->cssConfig['dropdown_menu']}' {$this->generateJSShowAttributes()}>";
                echo "<ul>";
                $this->renderMenuItems($linkOrDropdownItems, $activeItem);
                echo "</ul></div></div>";
            } else {
                // Check if item is active
                $activeClass = ($linkOrDropdownItems === "index.php?page=PMS&item_clicked=$activeItem") 
                    ? $this->cssConfig['active_item'] 
                    : '';

                echo "<a href='{$linkOrDropdownItems}' class='{$this->cssConfig['menu_item']} {$activeClass}'>{$title}</a>";
            }
        }
    }

    private function generateJSAttributes(string $isDropdownOpen): string {
        if ($this->jsConfig['framework'] === 'alpine') {
            return "x-data='{ open: $isDropdownOpen }' @click='open = !open'";
        } elseif ($this->jsConfig['framework'] === 'jquery') {
            return "class='dropdown-trigger' data-target='{$this->jsConfig['dropdown_class']}'";
        }
        return "";
    }

    private function generateJSShowAttributes(): string {
        if ($this->jsConfig['framework'] === 'alpine') {
            return "x-show='open' x-transition";
        } elseif ($this->jsConfig['framework'] === 'jquery') {
            return "style='display:none;'";
        }
        return "";
    }

    public function render() {
        $activeItem = $this->getActiveItem();
        echo "<aside class='{$this->cssConfig['sidebar']}'>";
        echo "<nav class='{$this->cssConfig['menu']}'>";
        $this->renderMenuItems($this->items, $activeItem);
        echo "</nav></aside>";

        if ($this->jsConfig['framework'] === 'jquery') {
            echo "<script>
                $(document).ready(function() {
                    $('.dropdown-trigger').click(function() {
                        var target = $(this).data('target');
                        $('.' + target).slideToggle();
                    });
                });
                </script>";
        }
    }
}
