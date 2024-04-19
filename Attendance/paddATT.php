<?php
session_start();
include "../DBConnection.php";

function calculateTotalHours($att_s_in, $att_s_out) {
    // Parse time strings to DateTime objects
    $timeIn = new DateTime('1970-01-01T' . $att_s_in . 'Z');
    $timeOut = new DateTime('1970-01-01T' . $att_s_out . 'Z');

    // Calculate the difference in hours and minutes
    $interval = $timeIn->diff($timeOut);
    $hours = $interval->h + ($interval->i / 60);

    return $hours;
}

function insertRecord() {
    global $conn;

    $query = "SELECT MAX(att_id) AS att_id FROM attendance";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['att_id'] + 1;

    $em_id = $_POST['em_id'];
    $att_date = $_POST['att_date'];
    $att_s_in = $_POST['att_s_in'];
    $att_s_out = $_POST['att_s_out'];

    // Calculate total hours
    $total_hr = calculateTotalHours($att_s_in, $att_s_out);

    $query = "INSERT INTO attendance(att_id, att_date, att_s_in, att_s_out, em_id, total_hr) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = mysqli_prepare($conn, $query);

    // Bind parameters
    mysqli_stmt_bind_param($stmt, "issssd", $nextId, $att_date, $att_s_in, $att_s_out, $em_id, $total_hr);

    // Execute the statement
    $result = mysqli_stmt_execute($stmt);

    if($result){
        echo "Record inserted successfully";
    } else {
        echo "Error: " . mysqli_error($conn);
    }
}

// Call the insertRecord function if the form is submitted
if(isset($_POST['buttonSAVE'])) {
    insertRecord();
}
?>
