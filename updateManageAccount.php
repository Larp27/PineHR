<?php
session_start();
include "DBConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $em_id = $_POST['em_id'];
    $first_name = $_POST['first_name'];
    $last_name = $_POST['last_name'];
    $em_birthday = $_POST['em_birthday'];
    $em_phone = $_POST['em_phone'];
    $address_id = $_POST['address_id'];
    $em_email = $_POST['em_email'];
    $current_password = $_POST['current_password'];
    $new_password = $_POST['new_password'];

    $targetDirectory = "uploads/";
    $em_profile_pic = '';

    if(isset($_FILES['em_profile_pic']) && $_FILES['em_profile_pic']['error'] === UPLOAD_ERR_OK){
        $fileName = $_FILES['em_profile_pic']['name'];
        $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
        $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
        $uniqueID = uniqid();
        $newFileName = $fileNameWithoutExt . '_' . $uniqueID . '.' . $fileExt;
        $targetFilePath = $targetDirectory . $newFileName;

        $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');
        if (in_array(strtolower($fileExt), $allowedTypes)){
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
    }

    $update_query = "UPDATE employee SET first_name = '$first_name', last_name = '$last_name', em_birthday = '$em_birthday', em_phone = '$em_phone', address_id = $address_id, em_email = '$em_email'";

    if (!empty($em_profile_pic)) {
        $em_profile_pic = "../" . $em_profile_pic;
        $update_query .= ", em_profile_pic = '$em_profile_pic'";
    }

    if (!empty($current_password) && !empty($new_password)) {
        $check_password_query = "SELECT em_password FROM employee WHERE em_id = $em_id";
        $result = mysqli_query($conn, $check_password_query);
        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $stored_password = $row['em_password'];
            if ($current_password === $stored_password) {
              $update_query .= ", em_password = '$new_password'";
            } else {
              echo "Current password is incorrect";
                return;
            }
        } else {
            echo "Error fetching password from the database";
            return;
        }
    }

    $update_query .= " WHERE em_id = '$em_id'";

    if (mysqli_query($conn, $update_query)) {
        echo "Employee data updated successfully";
        header("Location: manage_account.php");
        exit(); // Exit to prevent further execution
    } else {
        echo "Error updating employee data: " . mysqli_error($conn);
    }
}
?>
