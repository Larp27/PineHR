$(document).ready(function() {
    insert_record();
});

function insert_record(){
    $(document).on('click', '#buttonSAVE', function(){

        var em_name = $('#payroll_id').val(); // Change em_id to payroll_id
        var payroll_start_date = $('#payroll_start_date').val(); // New field for payroll start date
        var payroll_end_date = $('#payroll_end_date').val(); // New field for payroll end date
        var payroll_income = $('#payroll_income').val();
        var payroll_deduction = $('#payroll_deduction').val();
        var payroll_twd = $('#payroll_twd').val();
        var payroll_total = $('#payroll_total').val();

        if(em_name == "" || payroll_start_date == "" || payroll_end_date == "" || payroll_income == "" || payroll_deduction == "" || payroll_twd == "" || payroll_total == ""){
            $('#message').html('Please fill in the required fields'); 
        } else {
            $.ajax({
                url:'Payroll/insertPayroll.php',
                method:'POST',
                data: {
                    em_name : em_name,
                    payroll_start_date : payroll_start_date,
                    payroll_end_date : payroll_end_date,
                    payroll_income : payroll_income,
                    payroll_deduction : payroll_deduction,
                    payroll_twd : payroll_twd,
                    payroll_total : payroll_total
                },
                success:function(data){
                    $('#message').html(data);
                    $('#exampleModalCenter').modal('show');
                    $('form').trigger('reset'); 
                }
            });
        }
    });
}
