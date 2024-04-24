$(document).ready(function() {
  update_payroll_record();
});

function update_payroll_record() {
  $(document).on('click', '#btnUpdatePayroll', function() {
      var payroll_id = $('#payroll_id').val();
      var em_id = $('#em_id').val();
      var payroll_date = $('#payroll_date').val();
      var payroll_income = $('#payroll_income').val();
      var payroll_deduction = $('#payroll_deduction').val();
      var payroll_twd = $('#payroll_twd').val();
      var payroll_total = $('#payroll_total').val();

      if (payroll_date == "" || payroll_income == "" || payroll_deduction == "" || payroll_twd == "" || payroll_total == "" || em_name == "") {
          $('#message').html('Please fill in the required fields');
      } else {
          $.ajax({
              url: 'Payroll/updatePayroll.php',
              method: 'POST',
              data: {
                  payroll_id: payroll_id,
                  em_id: em_id,
                  payroll_date: payroll_date,
                  payroll_income: payroll_income,
                  payroll_deduction: payroll_deduction,
                  payroll_twd: payroll_twd,
                  payroll_total: payroll_total
              },
              success: function(data) {
                  $('#message').html(data);
                  $('#updatePayrollModal').modal('hide');
                  location.reload();
              }
          });
      }
  });
}
