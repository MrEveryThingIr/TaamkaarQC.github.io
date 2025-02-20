$(document).ready(function() {
    $("#drawingForm").submit(function(event) {
        event.preventDefault();
        
        var formData = new FormData(this);

        // Submit form via Ajax
        $.ajax({
            url: "", // Add PHP processing URL here
            type: "POST",
            data: formData,
            success: function(response) {
                alert("Drawing saved successfully!");
            },
            error: function() {
                alert("Error saving drawing");
            },
            cache: false,
            contentType: false,
            processData: false
        });
    });
});
