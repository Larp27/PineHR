<?php
session_start();
include "../DBConnection.php";

function updateEmployee() {
    global $conn;

    $em_id = $_POST['em_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dep_id = $_POST['dep_id'];
    $des_id = $_POST['des_id'];
    $user_role = $_POST['role'];
    $em_gender = $_POST['gender'];
    $em_bt_id = $_POST['bt_id'];
    $em_phone = $_POST['phone'];
    $em_address = $_POST['address']; 
    $em_birthday = $_POST['birthday']; 
    $em_joining_date = $_POST['join_date'];
    $em_contract_end = $_POST['contract_end'];
    $em_email = $_POST['email']; 
    $leave_type_names = $_POST['leave_type_names'];

    // Construct the SQL query
    $query = "UPDATE `employee` SET `em_id`='$em_id', `des_id`='$des_id', `dep_id`='$dep_id', `bt_id`='$em_bt_id', `user_id`='$user_role', `first_name`='$first_name', `last_name`='$last_name', `em_email`='$em_email', `em_address`='$em_address', `em_gender`='$em_gender', `em_phone`='$em_phone', `em_birthday`='$em_birthday', `em_joining_date`='$em_joining_date', `em_contract_end`='$em_contract_end', `available_leave_types`='$leave_type_names' WHERE em_id = $em_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Successfully updated Employee details.";
    } else {
        echo "Please check your query: " . mysqli_error($conn);
    }
}
?>