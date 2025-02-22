<?php
require_once 'classes/controllers/DBController.php'; 

if (isPostRequest()) {
    // Handle file upload for voice recording
    $voiceFileName = handleFileUpload('daily_reports', 'voice_file');

    // Prepare data for insertion
    $data = [
        'date'            => getPostData('date'),
        'hall'            => getPostData('hall'),
        'device'          => getPostData('device'),
        'operator'        => getPostData('operator'),
        'project'         => getPostData('project'),
        'part'            => getPostData('part'),
        'dwg'             => getPostData('dwg'),
        'sample'          => getPostData('sample'),
        'dimension'       => getPostData('dimension'),
        'self_control'    => getPostData('self_control'),
        'technology'      => getPostData('technology'),
        'status'          => getPostData('status'),
        'attachment_note' => getPostData('attachment_note'),
        'description_voice' => $voiceFileName, // Save uploaded voice file path
    ];

    try {
        $controller = new DBController('daily_report', 'create', null, $data);
        $result = $controller->executeAction();

        if ($result) {
            redirect('index.php?page=PMS&sidebarClickedItem=daily_report&navbarClickedItem=all');
        } else {
            throw new Exception("Failed to create daily report.");
        }
    } catch (Exception $e) {
        logError($e->getMessage());
        redirect('error.php');
    }
}
?>

<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Daily Report Form</h2>
    
    <form method="post" action="" id="dailyReportForm" enctype="multipart/form-data">
        <!-- Date -->
        <label class="block font-semibold">Date</label>
        <input type="date" name="date" class="w-full border p-2 mb-4 rounded">

        <!-- Hall -->
        <label class="block font-semibold">Hall</label>
        <input type="text" name="hall" class="w-full border p-2 mb-4 rounded">

        <!-- Device -->
        <label class="block font-semibold">Device</label>
        <input type="number" name="device" class="w-full border p-2 mb-4 rounded">

        <!-- Operator -->
        <label class="block font-semibold">Operator</label>
        <input type="number" name="operator" class="w-full border p-2 mb-4 rounded">

        <!-- Project -->
        <label class="block font-semibold">Project</label>
        <input type="number" name="project"  class="w-full border p-2 mb-4 rounded">

        <!-- Part -->
        <label class="block font-semibold">Part</label>
        <input type="number" name="part"  class="w-full border p-2 mb-4 rounded">


        <!-- DWG Upload -->
        <label class="block font-semibold">DWG File</label>
        <input type="number" name="dwg" class="w-full border p-2 mb-4 rounded">


        <!-- Sample -->
        <label class="block font-semibold">Sample</label>
        <input type="number" name="sample" class="w-full border p-2 mb-4 rounded">

        <!-- Dimension -->
        <label class="block font-semibold">Dimension</label>
        <input type="number" name="dimension" class="w-full border p-2 mb-4 rounded">

        <!-- Self Control -->
        <label class="block font-semibold">Self Control</label>
        <div class="flex gap-4 mb-4">
            <label><input type="radio" name="self_control" value="دارد" checked> دارد</label>
            <label><input type="radio" name="self_control" value="ندارد"> ندارد</label>
        </div>

        <!-- Technology -->
        <label class="block font-semibold">Technology</label>
        <div class="flex gap-4 mb-4">
            <label><input type="radio" name="technology" value="دارد" > دارد</label>
            <label><input type="radio" name="technology" value="ندارد" checked> ندارد</label>
        </div>

        <!-- Status -->
        <label class="block font-semibold">Status</label>
        <div class="flex gap-4 mb-4">
            <label><input type="radio" name="status" value="ACCEPT" checked> ACCEPT</label>
            <label><input type="radio" name="status" value="NCR"> NCR</label>
        </div>

        <!-- Attachment Note -->
        <label class="block font-semibold">Attachment Note</label>
        <textarea name="attachment_note" class="w-full border p-2 mb-4 rounded"></textarea>

<!-- Voice Recording Section -->
<label class="block font-semibold">Description Voice</label>
<div class="flex gap-4 mb-4">
    <button type="button" id="startRecord" class="bg-green-500 text-white px-4 py-2 rounded">Start Recording</button>
    <button type="button" id="pauseRecord" class="bg-yellow-500 text-white px-4 py-2 rounded hidden">Pause</button>
    <button type="button" id="stopRecord" class="bg-red-500 text-white px-4 py-2 rounded hidden">Stop</button>
</div>

<!-- Audio Preview -->
<audio id="audioPlayback" controls class="w-full hidden"></audio>
<input type="hidden" name="description_voice" id="voiceData">
<input type="file" name="voice_file" id="voiceFileInput" class="hidden">


        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>
