$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var dep_name = $('#dep_name').val();

    if(dep_name == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Department/insertDepartment.php',
            method:'POST',
            data: {
                dep_name
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