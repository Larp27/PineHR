<?php
  session_start();
  include "../DBConnection.php";

  if ($_SERVER["REQUEST_METHOD"] == "GET") {
    $dep_id= $_GET['dep_id'];

    
    $query = "DELETE FROM department WHERE dep_id = $dep_id";

    if(mysqli_query($conn, $query)) {
      echo "Department Deleted Successfully.";
      header("Location: ../Department_list.php");
      exit();
    } else {
      header("Location: ../Department_list.php");
      exit();
    }

    mysqli_close($conn); //Close database connection
  }
?>