$(document).ready(function () {
  update_lt_record();
});

function update_lt_record() {
  $(document).on("click", "#btnUpdateLeaveType", function () {
    var lt_id = $("#lt_id").val();
    var lt_code = $("#lt_code").val();
    var lt_name = $("#lt_name").val();
    var lt_description = $("#lt_description").val();
    var lt_credit = $("#lt_credit").val();
    var lt_status = $("#lt_status").val();

    if (
      lt_id == "" ||
      lt_code == "" ||
      lt_name == "" ||
      lt_description == "" ||
      lt_credit == "" ||
      lt_status == ""
    ) {
      $("#message").html("Please fill in the required fields");
    } else {
      $.ajax({
        url: "Leave_type/updateLT.php",
        method: "POST",
        data: {
          lt_id: lt_id,
          lt_code: lt_code,
          lt_name: lt_name,
          lt_description: lt_description,
          lt_credit: lt_credit,
          lt_status: lt_status,
        },
        success: function (data) {
          $("#message").html(data);
          $("#updateUserModal").modal("hide");
          location.reload();
        },
      });
    }
  });
}
