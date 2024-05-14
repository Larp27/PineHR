$(document).ready(function() {
  $('#inquiryButtonSAVE').on('click', function(e) {
    e.preventDefault();

    var inq_name = $('#inq_name').val();
    var inq_message = $('#inq_message').val();

    if (inq_name == "" || inq_message == "") {
      $('#message').html('Please fill in the required fields');
    } else {
      $.ajax({
        url: 'Inquiries/insertInq.php',
        method: 'POST',
        data: {
          inq_name: inq_name,
          inq_message: inq_message
        },
        success: function(data) {
          if (data.trim().toLowerCase() === 'success') {
            $('#exampleModalCenter').modal('show');
          } else {
            $('#message').html(data);
          }
          $('#inquiryForm')[0].reset(); // Reset form
        },
        error: function(xhr, status, error) {
          console.error(xhr.responseText); // Log error for debugging
        }
      });
    }
  });
});