$(document).ready(function() {
    update_address_record();

  });
  
  function update_address_record() {
    $(document).on('click', '#btnUpdateAddress', function() {
      var a_id = $('#a_id').val();
      var a_name = $('#update_a_name').val();
        
      if (a_name == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Address/updateAddress.php',
          method: 'POST',
          data: {
            a_name : a_name,
            a_id: a_id
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
