$(document).ready(function() {
    update_ms_record();

  });
  
  function update_ms_record() {
    $(document).on('click', '#btnUpdateMaritalStatus', function() {
      var ms_id = $('#ms_id').val();
      var ms_name = $('#update_ms_name').val();
        
      if (education == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'MaritalStatus/updateMS.php',
          method: 'POST',
          data: {
            ms_name: ms_name, 
            ms_id: ms_id,
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
