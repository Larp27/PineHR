<?php
  session_start();
  include "../DBConnection.php";

  function updateDesignation() {
    global $conn;

    $des_id = $_POST['des_id'];
    $des_name = $_POST['des_name'];

    $query = "UPDATE designation SET des_name='$des_name' WHERE des_id = $des_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Designation details.";
    } else {
      echo "Please check your query";
    }
  }
?>