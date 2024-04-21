<?php
  session_start();
  include "../DBConnection.php";

  function updateEducation() {
    global $conn;

    $edu_id = $_POST['edu_id'];
    $education = $_POST['education'];

    $query = "UPDATE education SET education='$education' WHERE edu_id = $edu_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "<script>alert('Successfully updated Education details.'); window.location.href = '../Education.php';</script>";
    } else {
      echo "<script>alert('Please check your query');</script>";
    }
  }
?>
