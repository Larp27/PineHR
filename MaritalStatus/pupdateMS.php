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
      echo "success";
    } else {
      echo "Error updating blood type: " . mysqli_error($conn);
    }
  }
?>