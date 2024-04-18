$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var lt_code = $('#lt_code').val();
        var lt_name = $('#lt_name').val();
        var lt_description = $('#lt_description').val();
        var lt_credit = $('#lt_credit').val();
        var lt_status = $('#lt_status').val();


    if(lt_code == "" | lt_name == "" | lt_description == "" | lt_credit == "" | lt_status == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Leave_type/insertLeavetype.php',
            method:'POST',
            data: {
                lt_code,
                lt_name,
                lt_description,
                lt_credit,
                lt_status,
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