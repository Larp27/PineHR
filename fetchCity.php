<?php
session_start();
include "../DBConnection.php";

function fetchCity() {
    global $conn;

    // Check if barangay is provided
    if (isset($_POST['barangay'])) {
        $barangay = $_POST['barangay'];

        // Fetch city from database
        $query = "SELECT city FROM address WHERE barangay = ?";
        $statement = $conn->prepare($query);
        $statement->bind_param("s", $barangay);
        $statement->execute();
        $result = $statement->get_result();

        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $city = $row['city'];
            // Return city as JSON response
            echo json_encode($city);
        } else {
            // If no city found for the provided barangay
            echo json_encode('');
        }
    } else {
        // If barangay is not provided
        echo json_encode('');
    }
}

fetchCity();
?>