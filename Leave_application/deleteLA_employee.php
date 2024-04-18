<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $la_id= $_GET['la_id'];

    
    $query = "DELETE FROM leave_application WHERE la_id = $la_id";

    if(mysqli_query($conn, $query)) {
      echo "Leave Type Deleted Successfully.";
      header("Location: ../employee_app_list.php");
      exit();
    } else {
      header("Location: ../employee_app_list.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>