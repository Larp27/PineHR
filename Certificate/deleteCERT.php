<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $cert_id= $_GET['cert_id'];

    
    $query = "DELETE FROM `certificate` WHERE cert_id = $cert_id";

    if(mysqli_query($conn, $query)) {
      echo "Employee Certificate Deleted Successfully.";
      header("Location: ../Certificate.php");
      exit();
    } else {
      header("Location: ../Certificate.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>