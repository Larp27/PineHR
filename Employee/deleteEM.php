<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $em_id= $_GET['em_id'];

    
    $query = "DELETE FROM employee WHERE em_id = $em_id";

    if(mysqli_query($conn, $query)) {
      echo "Employee Removed Successfully.";
      header("Location: ../em_list.php");
      exit();
    } else {
      header("Location: ../em_list.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>