<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(lt_id) AS lt_id FROM leave_type";
    $result = mysqli_query($conn, $query);
 

    $lt_code = $_POST['lt_code'];
    $lt_name = $_POST['lt_name'];
    $lt_description = $_POST['lt_description'];
    $lt_credit = $_POST['lt_credit'];
    $lt_status = $_POST['lt_status'];

    $query = "INSERT into leave_type (lt_code, lt_name, lt_description, lt_credit, lt_status) VALUES ('$lt_code', '$lt_name', '$lt_description', '$lt_credit', '$lt_status')";

    $result = mysqli_query($conn, $query);

    if($result){
      echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
