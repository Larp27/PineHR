$(document).ready(function() {
    update_r_record();

  });
  
  function update_r_record() {
    $(document).on('click', '#btnUpdateReligion', function() {
      var r_id = $('#r_id').val();
      var r_name = $('#update_r_name').val();
        
      if (education == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Religion/updateR.php',
          method: 'POST',
          data: {
            r_name: r_name, 
            r_id: r_id,
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
