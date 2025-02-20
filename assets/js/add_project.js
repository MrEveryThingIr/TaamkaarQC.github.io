$(document).ready(function() {
    $("#tamkarProjectForm").submit(function(event) {
        event.preventDefault();
        
        var formData = new FormData(this); // Use FormData to handle file uploads

        // Submit form via Ajax
        $.ajax({
            url: "", // Add PHP processing URL here
            type: "POST",
            data: formData,
            processData: false,  // Prevent jQuery from processing the data
            contentType: false,  // Let the browser set the correct content-type
            success: function(response) {
                alert("Project saved successfully!");
            },
            error: function() {
                alert("Error saving project");
            }
        });
    });
});
