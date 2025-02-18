
$(document).ready(function(){
    // Function to fetch and display data
    function fetchData() {
        $.ajax({
            url: 'fetch_data.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var rows = '';
                data.forEach(function(row) {
                    rows += `<tr class="border-b border-gray-200 hover:bg-gray-100">
                        <td class="py-3 px-6 text-right">${row.date}</td>
                        <td class="py-3 px-6 text-right">${row.hall}</td>
                        <td class="py-3 px-6 text-right">${row.device}</td>
                        <td class="py-3 px-6 text-right">${row.operator}</td>
                        <td class="py-3 px-6 text-right">${row.project_name}</td>
                        <td class="py-3 px-6 text-right">${row.part_name}</td>
                        <td class="py-3 px-6 text-right">${row.part_number}</td>
                        <td class="py-3 px-6 text-right">${row.dwg_number}</td>
                        <td class="py-3 px-6 text-right">${row.control_stage}</td>
                        <td class="py-3 px-6 text-right">${row.technology}</td>
                        <td class="py-3 px-6 text-right">${row.self_control}</td>
                        <td class="py-3 px-6 text-right">${row.description}</td>
                    </tr>`;
                });
                $('#projectTableBody').html(rows);
            }
        });
    }
    
    // Fetch data when the page loads
    fetchData();
    
    // Function to insert data and update the table
    $('#saveButton').click(function(){
        $.ajax({
            url: 'insert_project.php',
            method: 'POST',
            data: $('#projectForm').serialize(),
            success: function(response){
                alert(response);
                fetchData(); // Refresh the table with the new data
            }
        });
    });
});


