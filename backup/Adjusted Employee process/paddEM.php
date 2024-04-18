<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(em_id) AS em_id FROM employee";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['em_id'] + 1;
    
    $em_id = $_POST['em_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $dep_name = $_POST['dep_id'];
    $des_name = $_POST['des_id'];
    $user_role = $_POST['user_role'];
    $em_gender = $_POST['em_gender'];
    $bt_name = $_POST['bt_id'];
    $em_phone = $_POST['em_phone'];
    $em_birthday = $_POST['em_birthday'];
    $em_joining_date = $_POST['em_joining_date'];
    $em_contract_end = $_POST['em_contract_end'];
    $em_image = $_POST['em_image'];


    $query = "INSERT into employee(em_id, first_name, last_name, dep_id, des_id, user_role, em_gender, bt_id, em_phone, em_birthday, em_joining_date, em_contract_end, em_image) VALUES ('$nextId', '$em_id', '$first_name', '$last_name', '$dep_id', '$des_id', '$user_role', '$em_gender', '$bt_id', '$em_phone', '$em_birthday', '$em_joining_date', '$em_contract_end', '$em_image', '$user_role')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "success";
    }else{
       echo "Please check your query";
    }
  } 
?>
