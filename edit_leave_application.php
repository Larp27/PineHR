<?php
session_start();
include "DBConnection.php";

// Retrieve the submitted form data
$edit_la_status = $_POST['edit_la_status'];
$edit_la_id = $_POST['edit_la_id'];

// Perform any necessary validation

// Update the database record with the new leave status
$sql = "UPDATE leave_application SET la_status = '$edit_la_status' WHERE la_id = $edit_la_id";

// Execute the SQL query
$result = mysqli_query($conn, $sql);

// Check if the update was successful
if ($result) {
    // Redirect back to the page where the form was submitted from
    header("Location: Leave_app_list.php");
    exit();
} else {
    // Handle errors
    echo "Error: " . mysqli_error($conn);
}
?>
