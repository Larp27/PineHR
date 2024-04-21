$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var es_name = $('#es_name').val();
        var es_income = $('#es_income').val();

        if(es_name == "" || es_income == ""){
            $('#message').html('Please fill in the required fields'); 
        } else {
            $.ajax({
                url: 'EmploymentStatus/insertEmploymentStatus.php',
                method: 'POST',
                data: {
                    es_name: es_name,
                    es_income: es_income
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
