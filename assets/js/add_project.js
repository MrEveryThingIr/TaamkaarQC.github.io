$.ajax({
    url: "index.php?page=PMS&sidebarClickedItem=projects&navbarClickedItem=add_project",
    type: "POST",
    data: formData,
    processData: false,
    contentType: false,
    success: function (response, textStatus, xhr) {
        console.log("Full Response:", response); // Log the full response
        console.log("Status Code:", xhr.status);
        
        try {
            var jsonResponse = JSON.parse(response);
            if (jsonResponse.status === "success") {
                alert(jsonResponse.message);
                $("#tamkarProjectForm")[0].reset();
            } else {
                alert("Error: " + jsonResponse.message);
            }
        } catch (e) {
            alert("Invalid JSON response. Check console for details.");
            console.error("Parsing error:", e);
        }
    },
    error: function (xhr, status, error) {
        console.error("AJAX Error:", status, error);
        console.error("Response Text:", xhr.responseText); // Log full error response
        alert("An error occurred while saving the project. See console for details.");
    }
});
