$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var education = $('#education').val();

    if(education == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Education/insertEducation.php',
            method:'POST',
            data: {
                education
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