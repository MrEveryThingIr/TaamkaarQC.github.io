<?php
include 'classes/controllers/DBController.php';

if ($project_id) {
    // Initialize the DBController for the 'project' model
    $controller = new DBController('project', 'readOne', $project_id);

    // Execute the action (fetch the project)
    $project = $controller->executeAction();

    if ($project) {
        ?>
      
            <div class="container mx-auto p-4">
                <div class="max-w-3xl mx-auto bg-white rounded-lg shadow-lg p-6">
                <div class="flex items-center gap-12 space-x-6">
    <!-- Orderer Brand Logo -->
    <div class="flex-shrink-0">
        <img width="200px" src="<?php echo 'uploads/' . $project['orderer_brand']; ?>" alt="orderer_brand" class="rounded-lg shadow-md">
    </div>
    <!-- Project Title -->
    <h1 class="text-3xl font-bold text-gray-800"><?php echo $project['title']; ?></h1>
</div>
                    <div class="space-y-4">
                        <?php
                        foreach ($project as $key => $value) {
                            if($key!=='orderer_brand' & $key!=='title'){
                            echo '
                            <div class="flex">
                                <strong class="w-1/3 text-gray-700">' . ucfirst(str_replace('_', ' ', $key)) . ':</strong>
                                <span class="w-2/3 text-gray-900">' . htmlspecialchars($value) . '</span>
                            </div>';
                        }}
                        ?>
                    </div>
                    <div class="flex gap-3 justify-center space-x-4 mt-8">
                        <button onclick="window.history.back();" class="bg-gray-500 text-white px-6 py-2 rounded-lg hover:bg-gray-600 transition duration-300">Back</button>
                        <button onclick="window.location.href='edit_project.php?id=<?php echo $id; ?>'" class="bg-blue-500 text-white px-6 py-2 rounded-lg hover:bg-blue-600 transition duration-300">Edit</button>
                        <button onclick="confirmDelete(<?php echo $id; ?>)" class="bg-red-500 text-white px-6 py-2 rounded-lg hover:bg-red-600 transition duration-300">Delete</button>
                    </div>
                </div>
            </div>

            <script>
                function confirmDelete(id) {
                    if (confirm("Are you sure you want to delete this project?")) {
                        window.location.href = 'delete_project.php?id=' + id;
                    }
                }
            </script>
     
        <?php
    } else {
        echo "<p class='text-center text-red-500'>Project not found.</p>";
    }
} else {
    echo "<p class='text-center text-red-500'>Invalid project ID.</p>";
}
?>