<?php
include "DBConnection.php";

// Get the emp_id from the AJAX request
$empId = $_GET['emp_id'];

// Query to fetch leave application details based on emp_id
$query = "SELECT la.*, e.first_name, e.last_name, lt.lt_code, lt.lt_name, la.la_reason
          FROM `leave_application` la 
          INNER JOIN `employee` e ON la.em_id = e.em_id 
          INNER JOIN `leave_type` lt ON lt.lt_id = la.lt_id
          WHERE la.la_id = $empId";

$result = mysqli_query($conn, $query);

if ($row = mysqli_fetch_assoc($result)) {
    $r_first_name = $row['first_name'];
    $r_last_name = $row['last_name'];
    $r_lt_code = $row['lt_code'];
    $r_lt_name = $row['lt_name'];
    $r_la_date_start = date("F j, Y", strtotime($row['la_date_start']));
    $r_la_date_end = date("F j, Y", strtotime($row['la_date_end']));
    $r_la_reason = $row['la_reason'];
    $r_la_status = $row['la_status'];


    // Generate HTML content to display in the modal
    $modalContent = "
        <p><strong>Employee Name:</strong> $r_last_name, $r_first_name</p>
        <p><strong>Leave Type:</strong> [$r_lt_code] - $r_lt_name</p>
        <p><strong>Status:</strong> $r_la_status</p>
        <p><strong>Date Start:</strong> $r_la_date_start</p>
        <p><strong>Date End:</strong> $r_la_date_end</p>
        <p><strong>Reason:</strong> $r_la_reason</p>
    ";

    echo $modalContent;
} else {
    echo "No details found for the selected employee.";
}

// Close the database connection
mysqli_close($conn);
?>
