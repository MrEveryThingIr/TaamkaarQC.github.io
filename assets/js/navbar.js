$(document).ready(function() {
    $(".nav-item").click(function(e) {
        e.preventDefault(); // Prevents page reload
        
        // Remove active class from all items
        $(".nav-item").removeClass("active-tab").addClass("inactive-tab");
        
        // Add active class to clicked item
        $(this).addClass("active-tab").removeClass("inactive-tab");

        // Redirect to clicked item's link
        window.location.href = $(this).attr("href");
    });
});



