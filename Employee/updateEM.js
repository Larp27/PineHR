$(document).ready(function () {
  $('#btnUpdateEmployee').on('click', function() {
    var formData = new FormData(); // Create FormData object
    formData.append('em_id', $('#em_id').val());
    formData.append('first_name', $('#first_name').val());
    formData.append('last_name', $('#last_name').val());
    formData.append('em_gender', $('#em_gender').val());
    formData.append('ms_id', $('#ms_id').val());
    formData.append('r_id', $('#r_id').val());
    formData.append('bt_id', $('#bt_id').val());
    formData.append('em_birthday', $('#em_birthday').val());
    formData.append('em_phone', $('#em_phone').val());
    formData.append('em_email', $('#em_email').val());
    formData.append('address_id', $('#address_id').val());
    formData.append('edu_id', $('#edu_id').val());
    formData.append('dep_id', $('#dep_id').val());
    formData.append('des_id', $('#des_id').val());
    formData.append('es_id', $('#es_id').val());
    formData.append('user_id', $('#user_id').val());
    formData.append('em_joining_date', $('#em_joining_date').val());
    formData.append('em_contract_end', $('#em_contract_end').val());
    formData.append('em_password', $('#em_password').val());
    formData.append('em_profile_pic', $('#em_profile_pic')[0].files[0]);

    // Loop through each checkbox to gather selected leave types and their credits
    $('input[name="leave_type_ids[]"]:checked').each(function() {
      var leaveTypeId = $(this).val();
      var creditInputId = 'credits_' + leaveTypeId;
      var leaveCredit = $('#' + creditInputId).val();
      formData.append('leave_type_ids[]', leaveTypeId);
      formData.append('leave_credits[]', leaveCredit);
    });

    if (formData.get('first_name') == "" || formData.get('last_name') == "" || formData.get('dep_id') == "" || formData.get('des_id') == "" || formData.get('user_id') == "" || formData.get('em_gender') == "" || formData.get('bt_id') == "" || formData.get('em_phone') == "" || formData.get('em_birthday') == "" || formData.get('em_joining_date') == "" || formData.get('em_contract_end') == "" || formData.get('address_id') == "") {
      $('#message').html('Please fill in all required fields');
      console.log(formData);
    } else {
      $.ajax({
        url: "Employee/updateEM.php",
        method: 'POST',
        data: formData,
        processData: false,  // Ensure FormData is not processed
        contentType: false,  // Ensure FormData content type is not set
        success: function (data) {
          if (data.toLowerCase().includes('success')) {
            $('#exampleModalCenter').modal('show');
          } else {
            $('#message').html(data);
          }
          $('form').trigger('reset');
        }
      });
    }
  });
});
