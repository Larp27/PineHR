<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $inq_id= $_GET['inq_id'];

    
    $query = "DELETE FROM inquiries WHERE inq_id = $inq_id";

    if(mysqli_query($conn, $query)) {
      echo "Message Deleted Successfully.";
      header("Location: ../Inquiries.php");
      exit();
    } else {
      header("Location: ../Inquiries.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>