<?php 
$items=['project','drawing','part','dimension','sample','device','operator','daily_report'];
foreach($items as $item){

if($sidebarClickedItem==$item&$navbarClickedItem=='all'){
    include "partials/lists/{$item}s.php";

}elseif($sidebarClickedItem==$item&$navbarClickedItem=="add"){
    include "partials/forms/PMS/add_{$item}.php";
} 

}