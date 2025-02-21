<?php
require_once 'classes/DailyReport.php';

$report = new DailyReport();
$data = $_POST;

// Handle Voice File Upload
$voiceFile = handleFileUpload('voices', 'voice_file');
if ($voiceFile) {
    $data['description_voice'] = uploads_url("voices/$voiceFile"); 
} else {
    $data['description_voice'] = "";
}


// Insert data into database
$report->create($data);

echo json_encode(["message" => "Report saved successfully"]);
?>
