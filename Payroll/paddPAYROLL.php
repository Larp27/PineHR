<?php
session_start();
include "../DBConnection.php";

function insertRecord() {
    global $conn;

    // Check if the form fields are set and not empty
    if(isset($_POST['payroll_start_date'], $_POST['payroll_end_date'], $_POST['payroll_income'], $_POST['payroll_deduction'], $_POST['payroll_twd'], $_POST['em_id'])) {

        // Get the maximum payroll ID
        $query = "SELECT MAX(payroll_id) AS payroll_id FROM payroll";
        $result = mysqli_query($conn, $query);
        $row = mysqli_fetch_assoc($result);
        $nextId = $row['payroll_id'] + 1;

        // Get form field values
        $em_id = $_POST['em_id'];
        $payroll_start_date = $_POST['payroll_start_date'];
        $payroll_end_date = $_POST['payroll_end_date'];
        $payroll_income = $_POST['payroll_income'];
        $payroll_deduction = $_POST['payroll_deduction'];
        $payroll_twd = $_POST['payroll_twd'];
        $payroll_total = $_POST['payroll_total']; // Fetch the computed total directly from the form

        // Prepare and execute the insert query
        $query = "INSERT INTO payroll(payroll_id, em_id, payroll_start_date, payroll_end_date, payroll_income, payroll_deduction, payroll_twd, payroll_total) VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
        $stmt = mysqli_prepare($conn, $query);
        mysqli_stmt_bind_param($stmt, "isssdddi", $nextId, $em_id, $payroll_start_date, $payroll_end_date, $payroll_income, $payroll_deduction, $payroll_twd, $payroll_total);
        $result = mysqli_stmt_execute($stmt);

        // Check if the query executed successfully
        if($result){
            echo "Record inserted successfully";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } else {
        // If any required field is not set or empty
        echo "Error: Please fill in all the required fields";
    }
}

// Call the insertRecord function if the form is submitted
if(isset($_POST['buttonSAVE'])) {
    insertRecord();
}
?>
