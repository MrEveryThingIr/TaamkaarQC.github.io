<?php include "partials/header.php"; ?>




    <?php
    if(isset($_GET['page'])){
        $page=$_GET['page'];
        include 'partials/sidebar.php';
        if($page=='dashboard'){
            include "pages/dashboard.php";
        }elseif($page=='PMS'){
          
            include 'pages/PMS.php';
        }
    }
    ?>


<?php include "partials/footer.php"; ?>


