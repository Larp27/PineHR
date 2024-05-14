$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var  inq_name = $('#inq_name').val();
        var  inq_message = $('#inq_message').val();
        var  inq_status = $('#inq_status').val();
        var  inq_date = $('# inq_date').val();

    if(inq_name == "" || inq_message == "" || inq_status == "" || inq_date == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Inquiries/insertInq.php',
            method:'POST',
            data: {
                inq_name : inq_name,
                inq_message : inq_message,
                inq_status : inq_status,
                inq_date : inq_date
            },
            success:function(data){
                $('#message').html(data);
                $('#exampleModalCenter').modal('show');
                $('#exampleModal').modal('show');
                $('form').trigger('reset'); 
            }
        })
    }
    
})
}