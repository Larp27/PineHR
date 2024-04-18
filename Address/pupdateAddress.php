<?php
  session_start();
  include "../DBConnection.php";

  function updateAddress() {
    global $conn;

    $a_id = $_POST['a_id'];
    $a_name = $_POST['a_name'];


    $query = "UPDATE `address` SET a_name='$a_name' WHERE a_id = $a_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Education details.";
    } else {
      echo "Please check your query";
    }
  }
?>