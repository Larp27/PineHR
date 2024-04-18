<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(address_id) AS address_id FROM `address`";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['address_id'] + 1;

    $barangay = $_POST['barangay'];
    $city = $_POST['city'];

    $query = "INSERT into `address`(address_id, barangay, city) VALUES ('$nextId', '$barangay', '$city')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
