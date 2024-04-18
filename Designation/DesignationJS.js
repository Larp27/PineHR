$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var des_name = $('#des_name').val();

    if(des_name == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Designation/insertDesignation.php',
            method:'POST',
            data: {
                des_name
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