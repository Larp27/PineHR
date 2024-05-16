<?php
  session_start();
  include "../DBConnection.php";

  function updateBloodType() {
    global $conn;

    $bt_id = $_POST['bt_id'];
    $bt_name = $_POST['bt_name'];

    $query = "UPDATE blood_group SET bt_name='$bt_name' WHERE bt_id = $bt_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "success";
    } else {
      echo "Error updating blood type: " . mysqli_error($conn);
    }
  }
?>