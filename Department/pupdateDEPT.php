<?php
  session_start();
  include "../DBConnection.php";

  function updateDepartment() {
    global $conn;

    $dep_id = $_POST['dep_id'];
    $dep_name = $_POST['dep_name'];

    $query = "UPDATE department SET dep_name='$dep_name' WHERE dep_id = $dep_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Department details.";
    } else {
      echo "Please check your query";
    }
  }
?>