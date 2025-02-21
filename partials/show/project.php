<?php
if(isset($_GET['id'])){
    $id = $_GET['id'];
    // Initialize the DBController for the 'project' model
$controller = new DBController('project', 'readOne',$id);

// Execute the action (fetch all projects)
$project = $controller->executeAction();
foreach($project as $key=>$value){
    echo $key." : ".$value;
}
}