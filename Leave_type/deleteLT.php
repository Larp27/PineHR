<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $lt_id= $_GET['lt_id'];

    
    $query = "DELETE FROM leave_type WHERE lt_id = $lt_id";

    if(mysqli_query($conn, $query)) {
      echo "Leave Type Deleted Successfully.";
      header("Location: ../Leave_type_list.php");
      exit();
    } else {
      header("Location: ../Leave_type_list.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>