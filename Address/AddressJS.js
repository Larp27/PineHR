$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var address_name = $('#a_name').val();


    if(address_name == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Address/insertAddress.php',
            method:'POST',
            data: {
                address_name: address_name

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