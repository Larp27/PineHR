$(document).ready(function() {
  $('#btnUpdateBloodType').on('click', function() {
    var bt_id = $('#bt_id').val();
    var bt_name = $('#update_bt_name').val();
      
    if (bt_name == "") {
      $('#message').html('Please fill in the blood type field.');
    } else {
      $.ajax({
        url: 'BloodType/updateBT.php',
        method: 'POST',
        data: {
          bt_name: bt_name, 
          bt_id: bt_id,
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