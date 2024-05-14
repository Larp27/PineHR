<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $bt_id= $_GET['bt_id'];

    
    $query = "DELETE FROM blood_group WHERE bt_id = $bt_id";

    if(mysqli_query($conn, $query)) {
      echo "Education Deleted Successfully.";
      header("Location: ../BloodType.php");
      exit();
    } else {
      header("Location: ../Education.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>