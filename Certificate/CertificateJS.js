$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var em_id = $('#em_id').val();
        var cert_description = $('#cert_description').val();
        var cert_media = $('#cert_media').val();
        var cert_date = $('#cert_date').val();

        if(cert_description == "" || cert_media == "" || cert_date == "" || em_id == ""){
            $('#message').html('Please fill in the required fields'); 
        } else {
            $.ajax({
                url: 'Certificate/insertCertificate.php',
                method: 'POST',
                data: {
                    cert_description : cert_description,
                    cert_media : cert_media,
                    cert_date : cert_date,
                    em_id : em_id
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
