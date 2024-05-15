<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(inq_id) AS inq_id FROM inquiries";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['inq_id'] + 1;

    $inq_name = $_POST['inq_name'];
    $inq_number = '+63' . $_POST['inq_number'];
    $inq_message = $_POST['inq_message'];
    $inq_status = 'Unanswered';


    $query = "INSERT INTO inquiries (inq_name, inq_number, inq_message, inq_status) VALUES ('$inq_name', '$inq_number', '$inq_message', '$inq_status')";
    $result = mysqli_query($conn, $query);
 
    if ($result) {
      echo "success";
    } else {
      echo "Error: " . mysqli_error($conn);
    }
  } 
?>