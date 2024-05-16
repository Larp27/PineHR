<?php
session_start();
include "../DBConnection.php";

function insertRecord()
{
  global $conn;

  $query = "SELECT MAX(cert_id) AS cert_id FROM `certificate`";
  $result = mysqli_query($conn, $query);
  $row = mysqli_fetch_assoc($result);
  $nextId = $row['cert_id'] + 1;

  $cert_description = $_POST['cert_description'];
  $cert_media = $_POST['cert_media'];
  $cert_date = $_POST['cert_date'];
  $em_id = $_POST['em_id'];
  $targetDirectory = "../certificate_uploads/";
  $cert_media = '';

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
      if (move_uploaded_file($_FILES['em_profile_pic']['tmp_name'], $targetFilePath)) {
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

  $query = "INSERT into `certificate`(em_id, cert_description, cert_date, cert_media) VALUES ('$nextId', '$em_id', '$cert_description', '$cert_media', '$cert_date')";

  $result = mysqli_query($conn, $query);

  if ($result) {
    echo "";
  } else {
    echo "Please check your query";
  }
}
