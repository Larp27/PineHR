<?php
header('Content-Type: application/json');

// Include the database connection file
include 'db_connect.php';

// Retrieve the input data and decode the JSON
$data = json_decode(file_get_contents('php://input'), true);

// Check if 'inq_id' is set in the input data
if (isset($data['inq_id']) && is_numeric($data['inq_id'])) {
    $inquiryId = $data['inq_id'];
    
    // Prepare the SQL statement to update the inquiry status
    $query = "UPDATE `inquiries` SET `inq_status` = 'Seen' WHERE `id` = ?";
    if ($stmt = $conn->prepare($query)) {
        // Bind the inquiry ID to the statement as an integer
        $stmt->bind_param('i', $inquiryId);

        // Execute the statement and check if it was successful
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to execute statement.']);
        }

        // Close the statement
        $stmt->close();
    } else {
        echo json_encode(['success' => false, 'message' => 'Failed to prepare statement.']);
    }
} else {
    echo json_encode(['success' => false, 'message' => 'Invalid ID']);
}

// Close the database connection
$conn->close();
?>
