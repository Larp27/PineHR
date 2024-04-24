<?php
session_start();
include "DBConnection.php";
$fromdate = $_POST['fromdate'];
$todate = $_POST['todate'];
$start_date  = $fromdate;
$end_date    = $todate;
$selected_employees = implode(",", $_POST['employee']); // Convert array of selected employee IDs to comma-separated string
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
        <tr>
          <td colspan="6">Date from <?php echo $start_date; ?> To <?php echo $end_date; ?></td>
        </tr>
      </thead>
      <tbody>
        <tr>
          <th>Employee</th>
          <th>Attendance Date</th>
          <th>Sign in</th>
          <th>Sign Out</th>
          <th>Working Hour</th>
        </tr>
        <?php
        $query = "SELECT attendance.*, last_name, first_name 
                  FROM attendance 
                  INNER JOIN employee ON attendance.em_id = employee.em_id 
                  WHERE attendance.att_date BETWEEN '" . $start_date . "' AND '" . $end_date . "'";
        // If specific employees are selected, add a condition to filter by their IDs
        if (!empty($selected_employees)) {
          $query .= " AND employee.em_id IN ($selected_employees)";
        }
        $result = mysqli_query($conn, $query);
        // Fetch and display attendance records
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['last_name'] . " " . $row['first_name'] . "</td>"; // Display last name and first name
          echo "<td>" . $row['att_date'] . "</td>";
          echo "<td>" . date('H:i', strtotime($row['att_s_in'])) . "</td>"; // Format sign in time to hour and minute
          echo "<td>" . date('H:i', strtotime($row['att_s_out'])) . "</td>"; // Format sign out time to hour and minute
          echo "<td>" . $row['total_hr'] . "</td>";
          echo "</tr>";
        }
        ?>
      </tbody>
    </table>
  </div>
  <script>
    window.print(); // Print the page
    // Redirect back to reports page after 1 second (optional)
    setTimeout(function() {
      window.location.href = '../Pinehr/Reports_att.php';
    }, 1000);
  </script>
</body>
</html>
