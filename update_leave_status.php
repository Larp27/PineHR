<?php
session_start();
include "DBConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  if (isset($_POST['accept'])) {
    $la_id = $_POST['la_id'];
    $approved_by = $_POST['s_em_id'];
    $lt_id = $_POST['lt_id'];

    // Retrieve em_id from leave_application
    $em_id_query = "SELECT em_id FROM leave_application WHERE la_id = '$la_id'";
    $result = mysqli_query($conn, $em_id_query);
    if ($result && mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      $approved_by = $row['em_id'];
    } else {
      echo "Error retrieving em_id from leave_application: " . mysqli_error($conn);
      exit; // Exit if em_id retrieval fails
    }

    // Update leave application status to Accepted
    $query = "UPDATE leave_application SET la_status = 'Accepted', la_approved_by = '$approved_by' WHERE la_id = '$la_id'";

    if (mysqli_query($conn, $query)) {
      // Deduct leave credits only when the leave application is accepted
      $deduct_query = "UPDATE employee_leave_credits SET available_credits = available_credits - 1 WHERE em_id = '$approved_by' AND lt_id = '$lt_id'";
      if (mysqli_query($conn, $deduct_query)) {
        echo "Leave application accepted successfully.";
        header("Location: Leave_app_list.php");
      } else {
        echo "Error deducting leave credits: " . mysqli_error($conn);
      }
    } else {
      echo "Error updating leave application status: " . mysqli_error($conn);
    }
  } elseif (isset($_POST['decline'])) { // Change to handle 'decline' action
    $la_id = $_POST['la_id'];

    // Update leave application status to Declined
    $query = "UPDATE leave_application SET la_status = 'Declined' WHERE la_id = '$la_id'";

    if (mysqli_query($conn, $query)) {
      echo "Leave application declined successfully.";
      header("Location: Leave_app_list.php");
    } else {
      echo "Error updating leave application status: " . mysqli_error($conn);
    }
  }
}
?>
