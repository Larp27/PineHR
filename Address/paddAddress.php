<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(a_id) AS a_id FROM `address`";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['a_id'] + 1;

    $a_name = $_POST['a_name'];

    $query = "INSERT into `address`(a_id, a_name) VALUES ('$nextId', '$a_name')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
