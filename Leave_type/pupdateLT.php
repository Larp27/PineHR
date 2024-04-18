<?php
  session_start();
  include "../DBConnection.php";

  function updateLeaveType() {
    global $conn;

    $lt_id = $_POST['lt_id'];
	$lt_code = $_POST['lt_code'];
    $lt_name = $_POST['lt_name'];
	$lt_description = $_POST['lt_description'];
	$lt_credit = $_POST['lt_credit'];
	$lt_status = $_POST['lt_status'];


    $query = "UPDATE leave_type SET lt_code='$lt_code', lt_name='$lt_name', lt_description='$lt_description', lt_credit='$lt_credit', lt_status='$lt_status' WHERE lt_id='$lt_id'";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Leave Type details.";
    } else {
      echo "Please check your query";
    }
  }
?>