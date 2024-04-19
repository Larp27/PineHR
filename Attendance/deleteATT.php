<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $att_id= $_GET['att_id'];

    
    $query = "DELETE FROM attendance WHERE att_id = $dep_id";

    if(mysqli_query($conn, $query)) {
      echo "Attendance Deleted Successfully.";
      header("Location: ../Attendance_list.php");
      exit();
    } else {
      header("Location: ../Attendance_list.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>