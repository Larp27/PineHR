<?php
  include "DBConnection.php";

  // Update the status of employees to "Inactive" once their contract end date has passed.
  $update_inactive_query = "UPDATE employee SET employee_status = 'Inactive' WHERE em_contract_end < CURDATE()";
  if (mysqli_query($conn, $update_inactive_query)) {
    $inactive_count = mysqli_affected_rows($conn);
    echo "Updated $inactive_count employee status to Inactive<br>";
  } else {
      echo "Error updating employee status to Inactive: " . mysqli_error($conn) . "<br>";
  }

  // Update the status of employees to "On Leave" during the duration of their approved leave 
  $update_on_leave_query = "UPDATE employee 
                            INNER JOIN leave_application ON employee.em_id = leave_application.em_id
                            SET employee.employee_status = 'On Leave'
                            WHERE leave_application.la_date_start <= CURDATE() 
                            AND leave_application.la_date_end >= CURDATE()
                            AND leave_application.la_status = 'Accepted'";
  if (mysqli_query($conn, $update_on_leave_query)) {
    $on_leave_count = mysqli_affected_rows($conn);
    echo "Updated $on_leave_count employee status to On Leave<br>";
  } else {
    echo "Error updating employee status to On Leave: " . mysqli_error($conn) . "<br>";
  }

  // Update the status if employees status "On Leave" should return to "Active" status
  $update_active_query = "UPDATE employee 
                          INNER JOIN leave_application ON employee.em_id = leave_application.em_id
                          SET employee.employee_status = 'Active'
                          WHERE employee.employee_status = 'On Leave' AND leave_application.la_date_end < CURDATE()";
  if (mysqli_query($conn, $update_active_query)) {
    $active_count = mysqli_affected_rows($conn);
    echo "Updated $active_count employee status from On Leave to Active<br>";
  } else {
    echo "Error updating employee status to Active: " . mysqli_error($conn) . "<br>";
  }

  mysqli_close($conn);
?>