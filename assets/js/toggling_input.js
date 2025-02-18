$(document).ready(function () {
    // Toggle functionality for Technology
    $('#technology').change(function () {
      if (this.checked) {
        $('#technology-status').text('دارد').css('color', '#3b82f6');
      } else {
        $('#technology-status').text('ندارد').css('color', '#6b7280');
      }
    });

    // Toggle functionality for Self Control
    $('#self_control').change(function () {
      if (this.checked) {
        $('#self-control-status').text('دارد').css('color', '#3b82f6');
      } else {
        $('#self-control-status').text('ندارد').css('color', '#6b7280');
      }
    });
  });