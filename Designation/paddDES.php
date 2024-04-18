<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(des_id) AS des_id FROM designation";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['des_id'] + 1;

    $des_name = $_POST['des_name'];

    $query = "INSERT into designation(des_id, des_name) VALUES ('$nextId', '$des_name')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
