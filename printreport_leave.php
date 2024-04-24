<?php
session_start();
include "DBConnection.php";

$selected_employees = isset($_POST['employee']) ? implode(",", $_POST['employee']) : ''; // Convert array of selected employee IDs to comma-separated string, or empty if none selected
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Printable Leave Application</title>
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
          <th colspan="4" class="text-center">
            <a href="index.php"><img src="bgimages/ormoc_seal.jpg" alt="logo" style="width: 100px;height: 100px; margin-left: 210px"></a><br>
            Ormoc City LGU Leave Application
          </th>
        </tr>
        <tr>
          <th>Employee</th>
          <th>Leave Type</th>
          <th>Date</th>
          <th>Status</th>
        </tr>
      </thead>
      <tbody>
        <?php
        $query = "SELECT la.*, e.last_name, e.first_name, lt.lt_code, lt.lt_name
                  FROM leave_application la
                  INNER JOIN employee e ON la.em_id = e.em_id
                  INNER JOIN leave_type lt ON la.lt_id = lt.lt_id";
        // If specific employees are selected, add a condition to filter by their IDs
        if (!empty($selected_employees)) {
          $query .= " WHERE la.em_id IN ($selected_employees)";
        }
        $result = mysqli_query($conn, $query);
        // Fetch and display leave application records
        while ($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          echo "<td>" . $row['last_name'] . " " . $row['first_name'] . "</td>"; // Display last name and first name
          echo "<td>[" . $row['lt_code'] . "] " . $row['lt_name'] . "</td>"; // lt_code inside square brackets
          echo "<td>" . $row['la_date_start'] . "</td>";
          echo "<td>" . $row['la_status'] . "</td>";
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
      window.location.href = '../Pinehr/Reports_leave.php';
    }, 1000);
  </script>
</body>
</html>
