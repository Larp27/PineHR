<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(r_id) AS r_id FROM religion";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['r_id'] + 1;

    $r_name = $_POST['r_name'];

    $query = "INSERT into religion(r_id, r_name) VALUES ('$nextId', '$r_name')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
