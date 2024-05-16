$(document).ready(function() {
  $('#btnUpdateEmploymentStatus').on('click', function() {
    var es_id = $('#es_id').val();
    var es_name = $('#update_es_name').val();
    var es_income = $('#update_es_income').val();
      
    if (es_name == "" || es_income == "") {
      $('#message').html('Please fill in the employment status name and income field.');
    } else {
      $.ajax({
        url: 'EmploymentStatus/updateES.php',
        method: 'POST',
        data: {
          es_name: es_name, 
          es_income: es_income, 
          es_id: es_id,
        },
        success: function(data) {
          if (data.toLowerCase().includes('success')) {
            $('#updateUserModal').modal('hide');
            sessionStorage.setItem('showSuccessModal', 'true');
            location.reload();
          } else {
            $('#message').html(data);
          }
          $('form').trigger('reset');
        }
      });
    }
  });

  // Check if the success modal should be shown and show it if needed
  if (sessionStorage.getItem('showSuccessModal')) {
    $('#exampleModalCenter').modal('show');
    // Once shown, remove the flag from session storage
    sessionStorage.removeItem('showSuccessModal');
  }
});