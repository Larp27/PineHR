$(document).ready(function () {
  $('#btnUpdateEmployee').on('click', function() {
    var formData = {
      em_id: $("#em_id").val(),
      gender: $("#gender").val(),
      first_name: $("#f_name").val(),
      last_name: $("#l_name").val(),
      des_id: $("#des_id").val(),
      dep_id: $("#dep_id").val(),
      es_id: $("#es_id").val(),
      bt_id: $("#bt_id").val(),
      phone: $("#em_phone").val(),
      address: $("#em_address").val(),
      birthday: $("#em_birthday").val(),
      role: $("#user_role").val(),
      email: $("#em_email").val(),
      join_date: $("#em_joining_date").val(),
      contract_end: $("#em_contract_end").val(),
      leave_type_names: $('input[name="leave_types[]"]:checked').map(function() {
        return this.value;
      }).get().join(', ')
    };

    if (formData.em_id == "" || formData.first_name == "" || formData.last_name == "" || formData.dep_id == "" || formData.des_id == "" || formData.bt_id == "" || formData.es_id == "" || formData.gender == ""|| formData.phone == "" || formData.birthday == "" || formData.join_date == "" || formData.contract_end == "" || formData.address == "" || formData.role == "") {
      $('#message').html('Please fill in the required fields');
      console.log(formData);
    } else {
      $.ajax({
        url: "Employee/updateEM.php",
        method: 'POST',
        data: formData,
        success: function (data) {
          $("#message").html(data);
          $("#updateUserModal").modal("hide");
          location.reload();
        },
      });
    }
  });
});