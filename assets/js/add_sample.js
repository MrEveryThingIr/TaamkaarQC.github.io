$(document).ready(function() {
    $("#sampleForm").submit(function(event) {
        event.preventDefault();
        
        var formData = $(this).serialize();

        // Submit form via Ajax
        $.ajax({
            url: "", // Add PHP processing URL here
            type: "POST",
            data: formData,
            success: function(response) {
                alert("Sample saved successfully!");
            },
            error: function() {
                alert("Error saving sample");
            }
        });
    });
});
