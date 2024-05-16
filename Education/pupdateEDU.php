<?php
  session_start();
  include "../DBConnection.php";

  function updateEducation(){
    global $conn;

    $edu_id = $_POST['edu_id'];
    $education = $_POST['education'];

    $query = "UPDATE education SET education = '$education' WHERE edu_id = '$edu_id'";

    $result = mysqli_query($conn, $query);
 
    if ($result) {
      echo "success";
    } else {
      echo "Error updating educational attainment: " . mysqli_error($conn);
    }
  } 
?>