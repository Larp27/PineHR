<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $address_id= $_GET['address_id'];

    
    $query = "DELETE FROM `address` WHERE address_id = $address_id";

    if(mysqli_query($conn, $query)) {
      echo "Address Deleted Successfully.";
      header("Location: ../Address.php");
      exit();
    } else {
      header("Location: ../Address.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>