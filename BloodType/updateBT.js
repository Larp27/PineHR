$(document).ready(function() {
    update_bt_record();

  });
  
  function update_bt_record() {
    $(document).on('click', '#btnUpdateBloodType', function() {
      var bt_id = $('#bt_id').val();
      var bt_name = $('#update_bt_name').val();
        
      if (education == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Education/updateEDU.php',
          method: 'POST',
          data: {
            bt_name: bt_name, 
            bt_id: bt_id,
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
