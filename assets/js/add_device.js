$(document).ready(function() {
    $("#deviceForm").submit(function(e) {
        e.preventDefault();

        // Collect form data
        var formData = $(this).serialize();

        // Post data to the server
        $.ajax({
            type: "POST",
            url: "",  // specify your PHP script here for handling the form submission
            data: formData,
            success: function(response) {
                // Handle the server response here, like showing a success message
                alert('Device added successfully!');
            },
            error: function() {
                // Handle errors here
                alert('There was an error while submitting the form.');
            }
        });
    });
});