<?php
session_start();
include "DBConnection.php";

if(isset($_GET['employeeId'])) {
  $employeeId = mysqli_real_escape_string($conn, $_GET['employeeId']);

  $query = "SELECT lt.lt_id, lt.lt_name
            FROM leave_type lt
            INNER JOIN employee_leave_credits ec ON lt.lt_id = ec.lt_id
            WHERE ec.em_id = '$employeeId'";
  
  $result = mysqli_query($conn, $query);

  if(mysqli_num_rows($result) > 0) {
    $leaveOptions = array();
    while ($row = mysqli_fetch_assoc($result)) {
      $leaveOptions[] = $row;
    }

    echo json_encode($leaveOptions);
  } else {
    echo json_encode(array());
  }
} else {
  echo json_encode(array('error' => 'Employee ID not provided'));
}
?>