<?php
  session_start();
  include "DBConnection.php";
  $fromdate = $_GET['fromdate'] ?? '';
  $todate = $_GET['todate'] ?? '';
  $employee = $_GET['employee'] ?? '';
  $department = $_GET['department'] ?? '';

  // Build the WHERE clause based on the provided filter values
  $whereClause = [];
  if (!empty($employee)) {
    $whereClause[] = "attendance.em_id = $employee";
  }

  if (!empty($department)) {
    $whereClause[] = "employee.dep_id = $department";
  }

  $query = "SELECT attendance.*, last_name, first_name FROM attendance 
            INNER JOIN employee ON attendance.em_id = employee.em_id";

  // Add WHERE clause if any filter is provided
  if (!empty($whereClause)) {
    $query .= " WHERE " . implode(" AND ", $whereClause);
  }

  // Add date range filter only if both fromdate and todate are present
  if (!empty($fromdate) && !empty($todate)) {
    $query .= " AND attendance.att_date BETWEEN '$fromdate' AND '$todate'";
  }

  $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Printable Attendance </title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="dashboard2.css" />
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
</head>
<body>
  <div class="container-sm mt-3">
    <table class="table">
      <thead class="text-center">
        <tr>
          <a href="index.php"><img src="bgimages/ormoc_seal.jpg" alt="logo" style="width: 100px;height: 100px; margin-left: 210px"></a>
          <th colspan="6">Ormoc City LGU Attendance</th>
        </tr>
        <?php
          $fromdate_obj = new DateTime($fromdate);
          $todate_obj = new DateTime($todate);

          $from_month = $fromdate_obj->format('F'); // Full month name
          $to_month = $todate_obj->format('F'); // Full month name
          $from_day = $fromdate_obj->format('j'); // Day without leading zeros
          $to_day = $todate_obj->format('j'); // Day without leading zeros
          $from_year = $fromdate_obj->format('Y'); // Full year
          $to_year = $todate_obj->format('Y'); // Full year

          // Format the date range string
          $date_range = '';
          if ($from_month === $to_month && $from_year === $to_year) {
            // Same month and year
            $date_range = "<td colspan='6'>Date from $from_month $from_day - $to_day, $to_year</td>";
          } elseif ($from_month !== $to_month && $from_year === $to_year) {
            // Different month but same year
            $date_range = "<td colspan='6'> Date from $from_month $from_day - $to_month $to_day, $to_year</td>";
          } else {
            // Different month and year
            $date_range = "<td colspan='6'>Date from $from_month $from_day, $from_year - $to_month $to_day, $to_year</td>";
          }

          // Output the formatted date range
          echo $date_range;
        ?>
        <tr>
          <th>Employee</th>
          <th>Attendance Date</th>
          <th>Sign in</th>
          <th>Sign Out</th>
          <th>Working Hour</th>
        </tr>
      </thead>
      <tbody>

        <?php
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['last_name'] . " " . $row['first_name'] . "</td>"; 
            echo "<td>" . $row['att_date'] . "</td>";
            echo "<td>" . date('H:i', strtotime($row['att_s_in'])) . "</td>";
            echo "<td>" . date('H:i', strtotime($row['att_s_out'])) . "</td>";
            echo "<td>" . $row['total_hr'] . "</td>";
            echo "</tr>";
          }
        ?>
      </tbody>
    </table>
  </div>
</body>
</html>
<script>
  window.print();

  // Close the new tab when the print dialog is closed or canceled
  window.onafterprint = function() {
    window.close();
  };
  window.onbeforeunload = function() {
    window.close();
  };
</script>