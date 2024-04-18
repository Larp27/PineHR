$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var ms_name = $('#ms_name').val();

        if(ms_name == ""){
            $('#message').html('Please fill in the required fields'); 
        } else {
            $.ajax({
                url: 'MaritalStatus/insertMaritalStatus.php',
                method: 'POST',
                data: {
                    ms_name: ms_name  
                },
                success: function(data){
                    $('#message').html(data);
                    $('#exampleModalCenter').modal('show');
                    $('form').trigger('reset'); 
                }
            });
        }
    });
}
