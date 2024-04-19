<?php
session_start();
include "../DBConnection.php";

if ($_SERVER["REQUEST_METHOD"] == "GET") {
  $payroll_id = $_GET['payroll_id'];

  $query = "DELETE FROM payroll WHERE payroll_id = $payroll_id";

  if(mysqli_query($conn, $query)) {
    echo "Payroll Deleted Successfully.";
    header("Location: ../Payroll.php");
    exit();
  } else {
    header("Location: ../Payroll.php");
    exit();
  }

  mysqli_close($conn); //Close database connection
}
?>
