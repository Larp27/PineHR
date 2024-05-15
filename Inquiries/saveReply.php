<?php
// Include database connection or initialization file
include_once('db_connection.php'); // Adjust the path as per your project structure

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $inq_id = $_POST['inq_id'];
    $reply_message = mysqli_real_escape_string($conn, $_POST['inq_reply']); // Escape special characters to prevent SQL injection
    
    // Prepare and execute SQL query to insert the reply into the database
    $insert_query = "INSERT INTO replies (inq_id, reply_message) VALUES ('$inq_id', '$reply_message')";
    if (mysqli_query($conn, $insert_query)) {
        // Reply inserted successfully
        $response = array("success" => true);
        echo json_encode($response);
    } else {
        // Error inserting reply
        $response = array("success" => false);
        echo json_encode($response);
    }
} else {
    // If the request method is not POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("error" => "Method Not Allowed"));
}
?>
