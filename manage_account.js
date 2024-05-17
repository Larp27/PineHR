$(document).ready(function () {
  $('#manage_account_btn').on('click', function() {
    var formData = new FormData();
    formData.append('em_id', $('#em_id').val());
    formData.append('first_name', $('#first_name').val());
    formData.append('last_name', $('#last_name').val());
    formData.append('em_birthday', $('#em_birthday').val());
    formData.append('em_phone', $('#em_phone').val());
    formData.append('em_email', $('#em_email').val());
    formData.append('address_id', $('#address_id').val());

    // Check if password field is empty, if not append it
    if ($('#current_password').val() !== "") {
      formData.append('current_password', $('#current_password').val());
    } else {
      formData.append('current_password', '');
    }

    // Check if password field is empty, if not append it
    if ($('#new_password').val() !== "") {
      formData.append('new_password', $('#new_password').val());
    } else {
      formData.append('new_password', '');
    }

    // Check if employee profile picture field exists and is not empty
    var profilePicInput = $('#em_profile_pic')[0];
    if (profilePicInput && profilePicInput.files && profilePicInput.files[0]) {
      formData.append('em_profile_pic', profilePicInput.files[0]);
    } else {
      formData.append('em_profile_pic', ''); 
    }

    $.ajax({
      url: "updateManageAccount.php",
      method: 'POST',
      data: formData,
      processData: false,
      contentType: false,
      success: function (data) {
        if (data.toLowerCase().includes('success')) {
          // Show success notification
          var notification = $('<div class="alert alert-success" role="alert">Inputs recorded successfully!</div>');
          $('body').append(notification);
          setTimeout(function() {
            notification.fadeOut('slow');
          }, 3000); // Hide notification after 3 seconds

          if ($('#exampleModalCenter').length) {
            $('#exampleModalCenter').modal('show');
          } else {
            window.location.href = 'user_manage_account.php';
          }
        } else {
          $('#message').html(data);
        }
        $('form').trigger('reset');
      }
    });
  });
});
