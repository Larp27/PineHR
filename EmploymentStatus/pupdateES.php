<?php
session_start();
include "../DBConnection.php";

function updateEmploymentStatus() {
    global $conn;

    $es_id = $_POST['es_id'];
    $es_name = $_POST['es_name'];
    $es_income = $_POST['es_income'];

    $query = "UPDATE employment_status SET es_name='$es_name', es_income='$es_income' WHERE es_id = $es_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        // If update is successful, create a JavaScript alert and redirect to EmploymentStatus.php
        echo "<script>alert('Successfully updated Employment Status details.'); window.location.href = '../EmploymentStatus.php';</script>";
    } else {
        // If update fails, create a JavaScript alert
        echo "<script>alert('Error: Unable to update Employment Status details. Please try again later.');</script>";
    }
}
?>
