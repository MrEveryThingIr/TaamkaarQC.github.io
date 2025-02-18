<?php include "partials/header.php"; ?>




    <?php
    if(isset($_GET['page'])){
        $page=$_GET['page'];
        if($page='dashboard'){
            include "pages/dashboard.php";
        }
    }
    ?>


<?php include "partials/footer.php"; ?>


