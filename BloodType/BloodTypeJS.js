$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var bt_name = $('#bt_name').val();

    if(bt_name == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'BloodType/insertBloodType.php',
            method:'POST',
            data: {
                bt_name
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