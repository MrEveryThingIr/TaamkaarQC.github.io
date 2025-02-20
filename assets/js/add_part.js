$(document).ready(function() {
    $("#partForm").submit(function(event) {
        event.preventDefault();
        
        var formData = $(this).serialize();

        // Submit form via Ajax
        $.ajax({
            url: "", // Add PHP processing URL here
            type: "POST",
            data: formData,
            success: function(response) {
                alert("Part saved successfully!");
            },
            error: function() {
                alert("Error saving part");
            }
        });
    });
});
