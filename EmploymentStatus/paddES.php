<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(es_id) AS es_id FROM employment_status";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['es_id'] + 1;

    $es_name = $_POST['es_name'];
    $es_income = $_POST['es_income'];

    $query = "INSERT into employment_status(es_id, es_name, es_income) VALUES ('$nextId', '$es_name', '$es_income')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
