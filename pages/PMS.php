

<main class="container my-5">
<?php 
  if(isset($_GET['sidebarClickedItem'])){
    $sidebarClickedItem=$_GET['sidebarClickedItem'];
    include 'partials/navbar.php';
    if(isset($_GET['navbarClickedItem'])){
        $navbarClickedItem=$_GET['navbarClickedItem'];
        include 'partials/main.php';
    }
}
?>


</main>