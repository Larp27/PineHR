<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(edu_id) AS edu_id FROM education";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['edu_id'] + 1;

    $education = $_POST['education'];

    $query = "INSERT into education(edu_id, education) VALUES ('$nextId', '$education')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
