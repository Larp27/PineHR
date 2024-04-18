<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $r_id= $_GET['r_id'];

    
    $query = "DELETE FROM religion WHERE r_id = $r_id";

    if(mysqli_query($conn, $query)) {
      echo "Religion Data Deleted Successfully.";
      header("Location: ../Religion.php");
      exit(); // Exit the script after redirect
    } else {
      header("Location: ../Religion.php");
      exit(); // Exit the script after redirect
    }

    mysqli_close($conn); //Close database connection (this line will not execute due to the previous exits)
  }
?>
