<?php
  session_start();
  include "DBConnection.php";
  $fromdate = $_GET['fromdate'] ?? '';
  $todate = $_GET['todate'] ?? '';
  $employee = $_GET['employee'] ?? '';
  $department = $_GET['department'] ?? '';
  $employmentstatus = $_GET['employmentstatus'] ?? '';

  // Build the WHERE clause based on the provided filter values
  $whereClause = [];
  if (!empty($fromdate)) {
    $whereClause[] = "p.payroll_start_date >= '$fromdate'";
  }
  if (!empty($todate)) {
    $whereClause[] = "p.payroll_end_date <= '$todate'";
  }
  if (!empty($employee)) {
    $whereClause[] = "p.em_id = $employee";
  }

  if (!empty($department)) {
    $whereClause[] = "e.dep_id = $department";
  }

  if (!empty($employmentstatus)) {
    $whereClause[] = "e.es_id = $employmentstatus";
  }

  $query = "SELECT * FROM `employee` e
  INNER JOIN `address` a ON a.address_id =  e.address_id
  INNER JOIN `department` d ON d.dep_id = e.dep_id";

  // Add WHERE clause if any filter is provided
  if (!empty($whereClause)) {
    $query .= " WHERE " . implode(" AND ", $whereClause);
  }

  $result = mysqli_query($conn, $query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Employee List Print </title>

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
</head>
<body>
  <div class="container-sm mt-3">
    <table class="table">
    <colgroup>
      <col width="10%">
      <col width="15%">
      <col width="10%">
      <col width="10%">
      <col width="10%">
      <col width="10%">

    </colgroup>
      <thead class="text-center">
        <tr>
          <a href="index.php"><img src="bgimages/ormoc_seal.jpg" alt="logo" style="width: 100px;height: 100px; margin-left: 210px"></a>
          <?php
            if (!empty($employmentstatus)) {
              if ($employmentstatus == 1) {
                echo '<th colspan="6">Ormoc City LGU Regular List</th>';
              } else if ($employmentstatus == 2) {
                echo '<th colspan="6">Ormoc City LGU Casual List</th>';
              } else if ($employmentstatus == 3) {
                echo '<th colspan="6">Ormoc City LGU Job Order List</th>';
              }
            } else {
              echo '<th colspan="6">Ormoc City LGU Employee List</th>';
            }
          ?>
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
          <th>Department</th>
          <th>Gender</th>
          <th>Address</th>
          <th>Status</th>
          <th>Date Joining</th>
        </tr>
      </thead>
      <tbody>
        <?php
          // Fetch and display employee records
          while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . $row['last_name'] . " " . $row['first_name'] . "</td>";
            echo "<td>" . $row['dep_name'] . "</td>";
            echo "<td>" . $row['em_gender'] . "</td>";
            echo "<td>" . $row['barangay'] . " " . $row ['city'] . "</td>";
            echo "<td>" . $row['employee_status'] . "</td>";
            echo "<td>" . $row['em_joining_date'] . "</td>";
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