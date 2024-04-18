$(document).ready(function() {
    update_edu_record();

  });
  
  function update_edu_record() {
    $(document).on('click', '#btnUpdateEducation', function() {
      var edu_id = $('#edu_id').val();
      var education = $('#update_education').val();
        
      if (education == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Education/updateEDU.php',
          method: 'POST',
          data: {
            education: education, 
            edu_id: edu_id,
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
