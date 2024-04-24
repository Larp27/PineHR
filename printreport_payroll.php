<!DOCTYPE html>
<?php
session_start();
include "DBConnection.php";
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$start_date  = $fromdate;
$end_date    = $todate;
$selected_employees = implode(",", $_POST['employee']); // Convert array of selected employee IDs to comma-separated string
?>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Printable Payroll </title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
<link rel="stylesheet" href="dashboard2.css" />
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js" integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
<script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>
<link rel="stylesheet" href="css/all.min.css">
<link rel="stylesheet" href="css/fontawesome.min.css">
<script src="js/all.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="script.js"></script>

<body>



  <div class="container-sm mt-3">
    <table class="table">
      <thead class="text-center">
        <tr>
          <a href="index.php"><img src="bgimages/ormoc_seal.jpg" alt="logo" style="width: 100px;height: 100px; margin-left: 210px"></a>
          <th colspan="6">Ormoc City LGU Employee's Payroll</th>
        </tr>
        <tr>
          <td colspan="6">Date from <?php echo $start_date; ?> To <?php echo $end_date; ?></td>

        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Employee</th>
          <th>Start Date</th>
          <th>End Date</th>
          <th>Daily Income</th>
          <th>Deduction</th>
          <th>Total Working Days</th>
          <th>Total Salary</th>
        </tr>

        <?php

        $query = "SELECT p.*, e.last_name, e.first_name FROM payroll p
        INNER JOIN employee e ON p.em_id = e.em_id";
         if (!empty($selected_employees)) {
          $query .= " AND e.em_id IN ($selected_employees)";
        }
        $result = mysqli_query($conn, $query);
        // Fetch and display attendance records
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['last_name'] . " " . $row['first_name'] . "</td>";
          echo "<td>" . $row['payroll_start_date'] . "</td>";
          echo "<td>" . $row['payroll_end_date'] . "</td>";
          echo "<td>" . $row['payroll_income'] . "</td>";
          echo "<td>" . $row['payroll_deduction'] . "</td>";
          echo "<td>" . $row['payroll_twd'] . "</td>";
          echo "<td>" . $row['payroll_total'] . "</td>";
        }
        echo "<tr>";
        echo "</tr>";


        ?>

      </tbody>
    </table>
  </div>

  <script>
    window.print(); // Print the page
    // Redirect back to reports page after 1 second (optional)
    setTimeout(function() {
      window.location.href = '../Pinehr/Reports_payroll.php';
    }, 1000);
  </script>
</body>

</html>