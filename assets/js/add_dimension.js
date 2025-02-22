$(document).ready(function () {
    // Load drawings dynamically
    $.getJSON('get_drawingParts.php', function (drawings) {
        $.each(drawings, function (index, drawing) {
            $("#drawing_id").append(`<option value="${drawing.id}">${drawing.name}</option>`);
        });
    });

    // Load parts when a drawing is selected
    $("#drawing_id").on("change", function () {
        let drawingId = $(this).val();
        $("#part_id").empty().append('<option value="">لطفا قطعه مورد نظر انتخاب شود</option>');
        
        if (drawingId) {
            $.post('get_drawingParts.php', { drawing_id: drawingId }, function (parts) {
                $.each(parts, function (index, part) {
                    $("#part_id").append(`<option value="${part.id}">${part.name}</option>`);
                });
            }, "json");
        }
    });
});
