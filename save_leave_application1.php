<?php
session_start();
include "DBConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $emId = $_POST['imId']; // Changed from 'emId' to 'imId'
  $leaveTypeId = $_POST['leave'];
  $leaveReason = $_POST['reason'];
  $startDate = $_POST['st_day'];
  $endDate = $_POST['end_day'];
  $status = 'Pending';

  $query = "INSERT INTO leave_application (em_id, lt_id, la_reason, la_date_start, la_date_end, la_status)
          VALUES ('$emId', '$leaveTypeId', '$leaveReason', '$startDate', '$endDate', '$status')";
  
  if(mysqli_query($conn, $query)){
    $flash_message = "Leave application submitted successfully.";
    echo json_encode(["status" => "success", "flash_message" => $flash_message]);
  } else {
    echo json_encode(["status" => "error", "error_message" => mysqli_error($conn)]);
  }
}
?>
