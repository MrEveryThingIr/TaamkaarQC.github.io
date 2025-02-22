<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Dimension Form</h2>
    
    <form method="post" action="" id="dimensionForm">
     <!-- Drawing ID -->
     <div class="form-group">
            <label for="drawing_id">نقشه:</label>
            <select id="drawing_id" name="drawing_id" required>
                <option value="">نقشه را انتخاب کنید</option>
            </select>
        </div>

        <div class="form-group">
            <label for="part_id">قطعه</label>
            <select id="part_id" name="part_id" required>
                <option value="">قطعه را انتخاب کنید</option>
            </select>
        </div>

        <!-- Tag -->
        <label class="block font-semibold">Tag</label>
        <input type="text" name="tag" class="w-full border p-2 mb-4 rounded" required>

        <!-- Station Code -->
        <label class="block font-semibold">Station Code</label>
        <input type="text" name="station_code" class="w-full border p-2 mb-4 rounded">

        <!-- Nominal Size -->
        <label class="block font-semibold">Nominal Size</label>
        <input type="number" step="0.001" name="nominal_size" class="w-full border p-2 mb-4 rounded" required>

        <!-- Upper Tolerance -->
        <label class="block font-semibold">Upper Tolerance</label>
        <input type="number" step="0.001" name="upper_tolerance" class="w-full border p-2 mb-4 rounded">

        <!-- Lower Tolerance -->
        <label class="block font-semibold">Lower Tolerance</label>
        <input type="number" step="0.001" name="lower_tolerance" class="w-full border p-2 mb-4 rounded">

        <!-- Status -->
        <label class="block font-semibold">Status</label>
        <div class="flex gap-4 mb-4">
            <label><input type="radio" name="status" value="ACCEPT" checked> ACCEPT</label>
            <label><input type="radio" name="status" value="NCR"> NCR</label>
        </div>

        <!-- Description Voice -->
        <label class="block font-semibold">Description Voice</label>
        <input type="text" name="description_voice" class="w-full border p-2 mb-4 rounded">

        <!-- Submit Button -->
        <button type="submit" class="bg-blue-500 text-white px-6 py-2 rounded w-full">Submit</button>
    </form>
</div>

<script>
    $(document).ready(function () {
    // Load drawings dynamically
    $.getJSON('get_drawingParts.php', function (drawings) {
        $.each(drawings, function (index, drawing) {
            $("#drawing_id").append(`<option value="${drawing.id}">${drawing.name}</option>`);
        });
    });

    // Load cities when province changes
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
</script>
