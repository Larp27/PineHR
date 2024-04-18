<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(bt_id) AS bt_id FROM blood_group";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['bt_id'] + 1;

    $bt_name = $_POST['bt_name'];

    $query = "INSERT into blood_group(bt_id, bt_name) VALUES ('$nextId', '$bt_name')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
