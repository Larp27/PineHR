<?php
session_start();
include "../DBConnection.php";

function insertRecord()
{
  global $conn;

  // Check if the file upload encountered any errors
  if (isset($_FILES['cert_media']['error'])) {
    $fileError = $_FILES['cert_media']['error'];
    if ($fileError !== UPLOAD_ERR_OK) {
      echo "File upload error: " . $fileError;
      return;
    }
  }

  // Retrieve the maximum cert_id
  $query = "SELECT MAX(cert_id) AS cert_id FROM `certificate`";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $nextId = $row['cert_id'] + 1;

  // Retrieve form data
  $cert_title = $_POST['cert_title'];
  $cert_description = $_POST['cert_description'];
  $cert_date = $_POST['cert_date'];
  $em_id = $_POST['em_id'];

  // Directory for storing uploaded files
  $targetDirectory = "../certificate_uploads/";
  $cert_media = '';

  // Check if a file was uploaded
  if (isset($_FILES['cert_media'])) {
    $fileName = $_FILES['cert_media']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
    $uniqueID = uniqid();
    $newFileName = $fileNameWithoutExt . '_' . $uniqueID . '.' . $fileExt;
    $targetFilePath = $targetDirectory . $newFileName;

    // Define allowed file types
    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array(strtolower($fileExt), $allowedTypes)) {
      if (move_uploaded_file($_FILES['cert_media']['tmp_name'], $targetFilePath)) {
        $cert_media = $targetFilePath;
      } else {
        echo "Error uploading file.";
        return;
      }
    } else {
      echo "File type not allowed.";
      return;
    }
  } else {
    echo "No file uploaded.";
    return;
  }

  $query = "INSERT INTO `certificate` (em_id, cert_title, cert_description, cert_date, cert_media) VALUES ('$em_id', '$cert_title', '$cert_description', '$cert_date', '$cert_media')";

  if (mysqli_query($conn, $query)) {
    echo "Record inserted successfully.";
  } else {
    echo "Please check your query: " . mysqli_error($conn);
  }
}
?>