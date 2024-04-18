<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $edu_id= $_GET['edu_id'];

    
    $query = "DELETE FROM education WHERE edu_id = $edu_id";

    if(mysqli_query($conn, $query)) {
      echo "Education Deleted Successfully.";
      header("Location: ../Education.php");
      exit();
    } else {
      header("Location: ../Education.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>