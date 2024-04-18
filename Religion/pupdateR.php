<?php
  session_start();
  include "../DBConnection.php";

  function updateReligion() {
    global $conn;

    $r_id = $_POST['r_id'];
    $r_name = $_POST['r_name'];

    $query = "UPDATE religion SET r_name='$r_name' WHERE r_id = $r_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Education details.";
    } else {
      echo "Please check your query";
    }
  }
?>