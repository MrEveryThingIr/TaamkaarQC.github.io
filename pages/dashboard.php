<?php include 'partials/sidebar.php' ?>


<main class="container my-5">
<?php 
if(isset($_GET['user_action'])){
    $user_action = $_GET['user_action'];
    if($user_action == 'add_report'){
        include 'partials/forms/add_report.php';

   
}elseif($user_action=='following_part'){
    include 'partials/forms/following_part.php';
    }else{
        include 'partials/watch_list.php';
}
}
?>

</main>