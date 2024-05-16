$(document).ready(function() {
  $('#btnUpdateEducation').on('click', function() {
    var edu_id = $('#edu_id').val();
    var education = $('#update_education').val();
      
    if (education == "") {
      console.log(edu_id)
      console.log(education)
      $('#message').html('Please fill in the education field.');
    } else {
      $.ajax({
        url: 'Education/updateEDU.php',
        method: 'POST',
        data: {
          education: education, 
          edu_id: edu_id
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
