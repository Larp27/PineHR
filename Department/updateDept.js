$(document).ready(function() {
    update_dep_record();

  });
  
  function update_dep_record() {
    $(document).on('click', '#btnUpdateDepartment', function() {
      var dep_id = $('#dep_id').val();
      var dep_name = $('#update_dep_name').val();
        
      if (dep_name == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Department/updateDEPT.php',
          method: 'POST',
          data: {
            dep_name: dep_name, 
            dep_id: dep_id,
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
