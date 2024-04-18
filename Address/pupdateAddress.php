<?php
  session_start();
  include "../DBConnection.php";

  function updateAddress() {
    global $conn;

    $address_id = $_POST['address_id'];
    $barangay = $_POST['barangay'];
    $city = $_POST['city'];

    $query = "UPDATE `address` SET barangay='$barangay', city='$city' WHERE address_id = $address_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated Education details.";
    } else {
      echo "Please check your query";
    }
  }
?>