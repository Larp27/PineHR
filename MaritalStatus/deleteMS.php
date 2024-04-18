<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $ms_id= $_GET['ms_id'];

    
    $query = "DELETE FROM marital_status WHERE ms_id = $ms_id";

    if(mysqli_query($conn, $query)) {
      echo "Marital Status Data Deleted Successfully.";
      header("Location: ../MaritalStatus.php");
      exit(); // Exit the script after redirect
    } else {
      header("Location: ../MaritalStatus.php");
      exit(); // Exit the script after redirect
    }

    mysqli_close($conn); //Close database connection (this line will not execute due to the previous exits)
  }
?>
