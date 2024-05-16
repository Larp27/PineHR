$(document).ready(function() {
  $('#btnUpdateReligion').on('click', function() {
    var r_id = $('#r_id').val();
    var r_name = $('#update_r_name').val();
      
    if (r_name == "") {
      console.log(r_id)
      $('#message').html('Please fill in the religion name field.');
    } else {
      $.ajax({
        url: 'Religion/updateR.php',
        method: 'POST',
        data: {
          r_name: r_name, 
          r_id: r_id,
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