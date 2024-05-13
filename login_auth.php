<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include "DBConnection.php";

$em_email = $_POST['em_email'];
$em_password = $_POST['em_password'];

if (empty($em_email)) {
    header("location: login.php?error=Email is required.");
    exit();
} else if (empty($em_password)) {
    header("location: login.php?error=Password is required.");
    exit();
}

$query = "select * from employee where em_email = '$em_email' and em_password = '$em_password'";
$result = mysqli_query($conn, $query);

if (mysqli_num_rows($result) > 0) {
    $row = mysqli_fetch_assoc($result);

    $_SESSION['s_first_name'] = $row['first_name'];
    $_SESSION['s_last_name'] = $row['last_name'];
    $_SESSION['s_em_email'] = $row['em_email'];
    $_SESSION['s_user_id'] = $row['user_id'];
    $_SESSION['s_em_id'] = $row['em_id'];

      // SweetAlert integration with employee's first name and last name
    $first_name = $row['first_name'];
    $last_name = $row['last_name'];
    // SweetAlert integration
    echo "<script>
          document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                  icon: 'success',
                  title: ' Welcome $first_name $last_name.',
                  html: '<img src=\"bgimages/pine.png\" style=\"width: 200px;\">',
                  showConfirmButton: false,
                  timer: 2000
              }).then(() => {
                  window.location.href = 'Dashboard.php'; 
              });
          });
        </script>";
} else {
    header("location: login.php?error=Invalid username/password.");
    exit();
}
?>