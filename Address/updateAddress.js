$(document).ready(function() {
  $('#btnUpdateAddress').on('click', function() {
    var address_id = $('#address_id').val();
    var barangay = $('#update_barangay').val();
    var city = $('#update_city').val();
      
    if (barangay == "" || city == "") {
      $('#message').html('Please fill in the barangay and city field.');
    } else {
      $.ajax({
        url: 'Address/updateAddress.php',
        method: 'POST',
        data: {
          barangay: barangay, 
          city: city,
          address_id: address_id
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