<div class="max-w-2xl mx-auto bg-white p-6 shadow-lg rounded-lg">
    <h2 class="text-2xl font-bold text-center mb-4">Dimension Form</h2>
    
    <form method="post" action="" id="dimensionForm">
        <!-- Drawing ID -->
        <label class="block font-semibold">Drawing ID</label>
        <input type="number" name="drawing_id" class="w-full border p-2 mb-4 rounded" required>

        <!-- Part ID -->
        <label class="block font-semibold">Part ID</label>
        <input type="number" name="part_id" class="w-full border p-2 mb-4 rounded" required>

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

