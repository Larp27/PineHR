<?php
  session_start();
  include "../DBConnection.php";

  function insertRecord(){
    global $conn;

    $query = "SELECT MAX(inq_id) AS inq_id FROM inquiries";
    $result = mysqli_query($conn, $query);
    $row = mysqli_fetch_assoc($result);
    $nextId = $row['inq_id'] + 1;

    $inq_name = $_POST['inq_name'];
    $inq_message = $_POST['inq_message'];
    $inq_status = 'Unseen';
    $inq_date = date('Y-m-d H:i:s');

     // Prepare the insert query using prepared statements
     $stmt = $conn->prepare("INSERT INTO inquiries (inq_id, inq_name, inq_message, inq_status, inq_date) VALUES (?, ?, ?, ?, ?)");
     $stmt->bind_param("issss", $nextId, $inq_name, $inq_message, $inq_status, $inq_date);
 
     // Execute the query
     if ($stmt->execute()) {
         echo "";
    }else{
       echo "Please check your query";
    }
  } 
?>
