<?php
// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Check if file is uploaded without errors
  if (isset($_FILES["em_profile_pic"]) && $_FILES["em_profile_pic"]["error"] == 0) {
    $target_dir = "uploads/"; // Directory where the file will be stored
    $target_file = $target_dir . basename($_FILES["em_profile_pic"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if file already exists
    if (file_exists($target_file)) {
      echo "Sorry, file already exists.";
      $uploadOk = 0;
    }
    // Check file size
    if ($_FILES["em_profile_pic"]["size"] > 500000) { // Adjust size as needed
      echo "Sorry, your file is too large.";
      $uploadOk = 0;
    }
    // Allow certain file formats
    if (
      $imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg"
      && $imageFileType != "gif"
    ) {
      echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
      $uploadOk = 0;
    }
    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
      echo "Sorry, your file was not uploaded.";
    } else {
      // If everything is ok, try to upload file
      if (move_uploaded_file($_FILES["em_profile_pic"]["tmp_name"], $target_file)) {
        echo "The file " . basename($_FILES["em_profile_pic"]["name"]) . " has been uploaded.";
      } else {
        echo "Sorry, there was an error uploading your file.";
      }
    }
  }
}
?>