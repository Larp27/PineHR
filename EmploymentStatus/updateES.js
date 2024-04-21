$(document).ready(function() {
    update_es_record();

  });
  
  function update_es_record() {
    $(document).on('click', '#btnUpdateEmploymentStatus', function() {
      var es_id = $('#es_id').val();
      var es_name = $('#update_es_name').val();
      var es_income = $('#update_es_income').val();
        
      if (es_name == "" || es_income == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'EmploymentStatus/updateES.php',
          method: 'POST',
          data: {
            es_name: es_name, 
            es_income: es_income, 
            es_id: es_id,
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
