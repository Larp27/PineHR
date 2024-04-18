<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $es_id= $_GET['es_id'];

    
    $query = "DELETE FROM employment_status WHERE es_id = $es_id";

    if(mysqli_query($conn, $query)) {
      echo "Employment Status Deleted Successfully.";
      header("Location: ../EmploymentStatus.php");
      exit();
    } else {
      header("Location: ../EmploymentStatus.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>