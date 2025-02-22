<?php
require 'classes/Database.php';
require 'classes/controllers/DBController.php';
require 'classes/Dimension.php';
// $dimension=new Dimension();


header('Content-Type: application/json');
$drawings = new DBController('drawing', 'read_all');
$drawings = $drawings->executeAction();
echo json_encode($drawings);


// if ($_SERVER['REQUEST_METHOD'] === 'GET') {
//     // Fetch drawings
//     // $query_provinces = "SELECT id, name FROM provinces ORDER BY name ASC";
//     // $stmt = $conn->prepare($query_provinces);
//     // $stmt->execute();
//     // $provinces = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
//     $drawings=new DBController('drawing','read_all');

//     echo json_encode($drawings);
//     exit;
// }

// if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drawing_id'])) {
//     $drawing_id = $_POST['drawing_id'];

//     // Fetch cities based on selected province
//     $query_parts = "SELECT id, name FROM parts WHERE drawing_id = :drawing_id ORDER BY name ASC";
//     $stmt = $conn->prepare($query_parts);
//     $stmt->bindParam(':drawing_id', $drawing_id, PDO::PARAM_INT);
//     $stmt->execute();
//     $parts = $stmt->fetchAll(PDO::FETCH_ASSOC);

//     echo json_encode($parts);
//     exit;
// }

// // If no valid request method
// echo json_encode(["error" => "Invalid request"]);
// exit;
?>
<?php
require 'classes/Database.php';
require 'classes/controllers/DBController.php';

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'GET') {
    $drawings = new DBController('drawing', 'read_all');
    echo json_encode($drawings->executeAction());
    exit;
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['drawing_id'])) {
    require 'classes/Database.php'; // Ensure database connection is included
    global $conn; // Ensure connection is available

    $drawing_id = $_POST['drawing_id'];

    $query_parts = "SELECT id, name FROM parts WHERE drawing_id = :drawing_id ORDER BY name ASC";
    $stmt = $conn->prepare($query_parts);
    $stmt->bindParam(':drawing_id', $drawing_id, PDO::PARAM_INT);
    $stmt->execute();
    $parts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode($parts);
    exit;
}

echo json_encode(["error" => "Invalid request"]);
exit;
?>
