$(document).ready(function() {
  update_address_record();

});

function update_address_record() {
  $(document).on('click', '#btnUpdateAddress', function() {
    var address_id = $('#address_id').val();
    var barangay = $('#update_barangay').val();
    var city = $('#update_city').val();
      
    if (barangay == "" || city == "") {
      $('#message').html('Please fill in the required fields');
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
          $('#message').html(data);
          $('#updateUserModal').modal('hide');
          location.reload();
        }
      });
    }
  });
}
