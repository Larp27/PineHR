<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(dep_id) AS dep_id FROM department";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['dep_id'] + 1;

    $dep_name = $_POST['dep_name'];

    $query = "INSERT into department(dep_id, dep_name) VALUES ('$nextId', '$dep_name')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
