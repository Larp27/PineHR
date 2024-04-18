$(document).ready(function() {
    update_des_record();

  });
  
  function update_des_record() {
    $(document).on('click', '#btnUpdateDesignation', function() {
      var des_id = $('#des_id').val();
      var des_name = $('#update_des_name').val();
        
      if (des_name == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Designation/updateDES.php',
          method: 'POST',
          data: {
            des_name: des_name, 
            des_id: des_id,
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
