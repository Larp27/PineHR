<?php
session_start();
include "../DBConnection.php";

function updateEmployee(){
  global $conn;

  $em_id = $_POST['em_id'];
  $first_name = $_POST['first_name'];
  $last_name = $_POST['last_name'];
  $em_gender = $_POST['em_gender'];
  $ms_id = $_POST['ms_id'];
  $r_id = $_POST['r_id'];
  $bt_id = $_POST['bt_id'];
  $em_birthday = $_POST['em_birthday'];
  $em_phone = $_POST['em_phone'];
  $em_email = $_POST['em_email'];
  $address_id = $_POST['address_id'];
  $edu_id = $_POST['edu_id'];
  $dep_id = $_POST['dep_id'];
  $des_id = $_POST['des_id'];
  $es_id = $_POST['es_id'];
  $user_id = $_POST['user_id'];
  $em_joining_date = $_POST['em_joining_date'];
  $em_contract_end = $_POST['em_contract_end'];
  $em_password = $_POST['em_password'];
  $leave_type_ids = $_POST['leave_type_ids'];
  $leave_credits = $_POST['leave_credits'];

  $em_profile_pic = '';
  $targetDirectory = "../uploads/";

  if(isset($_FILES['em_profile_pic']) && $_FILES['em_profile_pic']['error'] === UPLOAD_ERR_OK){
    $fileName = $_FILES['em_profile_pic']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
    $uniqueID = uniqid();
    $newFileName = $fileNameWithoutExt . '_' . $uniqueID . '.' . $fileExt;
    $targetFilePath = $targetDirectory . $newFileName;

    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
    if (in_array($fileExt, $allowedTypes)){
      if (move_uploaded_file($_FILES['em_profile_pic']['tmp_name'], $targetFilePath)){
        $em_profile_pic = $targetFilePath;
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

  $query = "UPDATE employee SET first_name = '$first_name', last_name = '$last_name', em_gender = '$em_gender', ms_id = '$ms_id', r_id = '$r_id', bt_id = '$bt_id', em_birthday = '$em_birthday', em_phone = '$em_phone', em_email = '$em_email', address_id = '$address_id', edu_id = '$edu_id', dep_id = '$dep_id', des_id = '$des_id', es_id = '$es_id', user_id = '$user_id', em_joining_date = '$em_joining_date', em_contract_end = '$em_contract_end', em_profile_pic = '$em_profile_pic'";
    
  if (!empty($em_password)) {
    $query .= ", em_password = '$em_password'";
  }

  $query .= " WHERE em_id = '$em_id'";

  if(mysqli_query($conn, $query)){
    // Loop through leave type IDs and corresponding credits
    foreach($leave_type_ids as $index => $leave_type_id) {
      $lt_id = $leave_type_id;
      $credits = $leave_credits[$index];

      // Check if the record already exists for the employee and leave type
      $checkQuery = "SELECT * FROM employee_leave_credits WHERE em_id = '$em_id' AND lt_id = '$lt_id'";
      $checkResult = mysqli_query($conn, $checkQuery);
      if(mysqli_num_rows($checkResult) > 0) {
        // If record exists, update the credits
        $updateCreditsQuery = "UPDATE employee_leave_credits SET available_credits = '$credits' WHERE em_id = '$em_id' AND lt_id = '$lt_id'";
        mysqli_query($conn, $updateCreditsQuery);
      } else {
        // If record doesn't exist, insert new record
        $insertCreditsQuery = "INSERT INTO employee_leave_credits (em_id, lt_id, available_credits) VALUES ('$em_id', '$lt_id', '$credits')";
        mysqli_query($conn, $insertCreditsQuery);
      }
    }
      
    echo "success";
  } else {
    echo "Please check your query: " . mysqli_error($conn);
  }
}
?>
