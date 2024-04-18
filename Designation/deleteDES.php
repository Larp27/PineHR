<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $des_id= $_GET['des_id'];

    
    $query = "DELETE FROM designation WHERE des_id = $des_id";

    if(mysqli_query($conn, $query)) {
      echo "Designation Deleted Successfully.";
      header("Location: ../Designation_list.php");
      exit();
    } else {
      header("Location: ../Designation_list.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>