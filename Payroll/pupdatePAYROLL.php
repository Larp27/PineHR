<?php
  session_start();
  include "../DBConnection.php";

  function updatePayroll() {
    global $conn;

    $payroll_id = $_POST['payroll_id'];
    $em_id = $_POST['em_id'];
    $payroll_date = $_POST['payroll_date'];
    $payroll_income = $_POST['payroll_income'];
    $payroll_deduction = $_POST['payroll_deduction'];
    $payroll_twd = $_POST['payroll_twd'];
    $payroll_total = $_POST['payroll_total'];

    $query = "UPDATE payroll SET em_name='$em_id', payroll_date='$payroll_date', payroll_income='$payroll_income', payroll_deduction='$payroll_deduction', payroll_twd='$payroll_twd', payroll_total='$payroll_total' WHERE payroll_id = $payroll_id";

    $result = mysqli_query($conn, $query);

    if ($result) {
      echo "Successfully updated payroll details.";
    } else {
      echo "Please check your query";
    }
  }
?>
