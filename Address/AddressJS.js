$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var barangay = $('#barangay').val();
        var city = $('#city').val();

    if(barangay == "" | city == ""){
        $('#message').html('Please fill in the required fields'); 
    }else{
        $.ajax({
            url:'Address/insertAddress.php',
            method:'POST',
            data: {
                barangay : barangay,
                city : city,
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