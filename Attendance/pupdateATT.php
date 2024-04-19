<?php
  session_start();
  include "../DBConnection.php";

  function updateAttendance() {
    global $conn;

    $em_id = $_POST['em_id'];
    $att_id = $_POST['att_id'];
    $att_date = $_POST['att_date'];
    $att_s_in = $_POST['att_s_in'];
    $att_s_out = $_POST['att_s_out'];
    $total_hr = $_POST['total_hr'];

    $query = "UPDATE attendance SET att_id=$att_id, att_date=$att_date , total_hr=$total_hr, att_s_in=$att_s_in, att_s_out=$att_s_out, em_id=$em_id WHERE att_id = $att_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Department details.";
    } else {
      echo "Please check your query";
    }
  }
?>