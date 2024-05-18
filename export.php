<?php
	session_start();
	include "DBConnection.php";

  if (isset($_POST["payroll_export"])) {
    // Output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=payroll_data.csv');

    // Create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');

    // Output the column headings
    fputcsv($output, array('Employee Name', 'Department', 'Start Date', 'End Date', 'Daily Income', 'Deduction', 'Total Working Days', 'Total Salary'));

    $rows = mysqli_query($conn, "SELECT e.last_name, e.first_name, d.dep_name, p.payroll_start_date, p.payroll_end_date, p.payroll_income, p.payroll_deduction, p.payroll_twd, p.payroll_total FROM payroll p INNER JOIN employee e ON p.em_id = e.em_id INNER JOIN department d ON e.dep_id = d.dep_id");

    while ($row = mysqli_fetch_assoc($rows)) {
      fputcsv($output, array(
        $row['last_name'] . ", " . $row['first_name'],
        $row['dep_name'],
        $row['payroll_start_date'],
        $row['payroll_end_date'],
        $row['payroll_income'],
        $row['payroll_deduction'],
        $row['payroll_twd'],
        $row['payroll_total']
      ));
    }
  } else if (isset($_POST["attendance_export"])) {
    // Output headers so that the file is downloaded rather than displayed
    header('Content-Type: text/csv; charset=utf-8');
    header('Content-Disposition: attachment; filename=attendance_data.csv');
  
    // Create a file pointer connected to the output stream
    $output = fopen('php://output', 'w');
  
    // Output the column headings
    fputcsv($output, array('Employee Name', 'Department', 'Attendance Date', 'Sign In', 'Sign Out', 'Total Working Hours'));
  
    $rows = mysqli_query($conn, "SELECT e.last_name, e.first_name, d.dep_name, a.att_date, a.att_s_in, a.att_s_out, a.total_hr 
                                 FROM attendance a 
                                 INNER JOIN employee e ON a.em_id = e.em_id 
                                 INNER JOIN department d ON e.dep_id = d.dep_id");
  
    while ($row = mysqli_fetch_assoc($rows)) {
      fputcsv($output, array(
        $row['last_name'] . ", " . $row['first_name'],
        $row['dep_name'],
        $row['att_date'],
        $row['att_s_in'],
        $row['att_s_out'],
        $row['total_hr']
      ));
    }
    fclose($output);
  }
?>
