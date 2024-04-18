<?php
  session_start();
  include "../DBConnection.php";

  function updateMaritalStatus() {
    global $conn;

    $ms_id = $_POST['ms_id'];
    $ms_name = $_POST['ms_name'];

    $query = "UPDATE marital_status SET ms_name='$ms_name' WHERE ms_id = $ms_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Education details.";
    } else {
      echo "Please check your query";
    }
  }
?>