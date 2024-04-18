<?php
  session_start();
  include "../DBConnection.php";

  function updateEmploymentStatus() {
    global $conn;

    $es_id = $_POST['es_id'];
    $es_name = $_POST['es_name'];

    $query = "UPDATE employment_status SET es_name='$es_name' WHERE es_id = $es_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Education details.";
    } else {
      echo "Please check your query";
    }
  }
?>