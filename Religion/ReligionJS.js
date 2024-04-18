$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var r_name = $('#r_name').val();

        if(r_name == ""){
            $('#message').html('Please fill in the required fields'); 
        } else {
            $.ajax({
                url: 'Religion/insertReligion.php',
                method: 'POST',
                data: {
                    r_name: r_name  
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
