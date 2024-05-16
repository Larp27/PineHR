$(document).ready(function() {
  $('#btnUpdateMaritalStatus').on('click', function() {
    var ms_id = $('#ms_id').val();
    var ms_name = $('#update_ms_name').val();
      
    if (ms_name == "") {
      $('#message').html('Please fill in the marital status name field.');
    } else {
      $.ajax({
        url: 'MaritalStatus/updateMS.php',
        method: 'POST',
        data: {
          ms_name: ms_name, 
          ms_id: ms_id,
        },
        success: function(data) {
          if (data.toLowerCase().includes('success')) {
            $('#updateUserModal').modal('hide');
            sessionStorage.setItem('showSuccessModal', 'true');
            location.reload();
          } else {
            $('#message').html(data);
          }
          $('form').trigger('reset');
        }
      });
    }
  });

  // Check if the success modal should be shown and show it if needed
  if (sessionStorage.getItem('showSuccessModal')) {
    $('#exampleModalCenter').modal('show');
    // Once shown, remove the flag from session storage
    sessionStorage.removeItem('showSuccessModal');
  }
});