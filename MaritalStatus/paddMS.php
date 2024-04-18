<?php
session_start();
include "../DBConnection.php";

function insertRecord(){
    global $conn;

    // Check if ms_name is set in the POST data
    if(isset($_POST['ms_name']) && !empty($_POST['ms_name'])) {
        $ms_name = $_POST['ms_name'];

        $query = "SELECT MAX(ms_id) AS max_id FROM marital_status";
        $result = mysqli_query($conn, $query);

        if($result) {
            $row = mysqli_fetch_assoc($result);
            $nextId = $row['max_id'] + 1;

            $query = "INSERT INTO marital_status (ms_id, ms_name) VALUES ('$nextId', '$ms_name')";
            $result = mysqli_query($conn, $query);

            // Check if the query executed successfully
            if($result) {
              echo "";
            } else {
                echo "Error: " . mysqli_error($conn); // Display any error message
            }
        } else {
            echo "Error: Failed to retrieve max_id."; // Display error if query fails
        }
    } else {
        echo "Error: ms_name is empty or not set."; // Display error if ms_name is not provided in POST data
    }
} 
?>
