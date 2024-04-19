$(document).ready(function() {
    update_att_record();

  });
  
  function update_att_record() {
    $(document).on('click', '#btnUpdateAttendance', function() {
        var em_id = $('#em_id').val();
        var att_date = $('#att_date').val();
        var att_s_in = $('#att_s_in').val();
        var att_s_out = $('#att_s_out').val();
        
      if (att_date == "" || att_s_in == "" || att_s_out == "" || em_id == "") {
        $('#message').html('Please fill in the required fields');
      } else {
        $.ajax({
          url: 'Attendance/updateATT.php',
          method: 'POST',
          data: {
                att_date : att_date,
                att_s_in : att_s_in,
                att_s_out : att_s_out,
                em_id : em_id
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
