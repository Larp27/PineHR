$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var em_id = $('#em_id').val();
        var att_date = $('#att_date').val();
        var att_s_in = $('#att_s_in').val();
        var att_s_out = $('#att_s_out').val();
        var total_hr = $('#total_hr').text(); // Getting total_hr from the span

        if(em_id == "" || att_date == "" || att_s_in == "" || att_s_out == "" || total_hr == ""){
            $('#message').html('Please fill in the required fields'); 
        } else {
            $.ajax({
                url:'Attendance/insertAttendance.php',
                method:'POST',
                data: {
                    em_id : em_id,
                    att_date : att_date,
                    att_s_in : att_s_in,
                    att_s_out : att_s_out,
                    total_hr : total_hr // Include total_hr parameter
                },
                success:function(data){
                    $('#message').html(data);
                    $('#exampleModalCenter').modal('show');
                    $('#exampleModal').modal('show');
                    $('form').trigger('reset'); 
                }
            });
        }
    });
}
