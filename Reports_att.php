<?php
$title = 'Attendance Report';
$page = 'reports_attendance';
include_once('./main.php');

// Include your database connection
include_once('DBConnection.php');

// Fetch employees from the database
$query = "SELECT em_id, first_name, last_name FROM employee";
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
  die("Database query failed."); // You can handle this error better in your actual application
}
?>

<script src="./script.js"></script>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-5 shadow-lg ">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">Attendance Report</p>
        </div>
        <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-5 shadow-lg ">
        <div style="height:100vh;">
          <div class="d-flex justify-content-between align-items-center">
            <p class="fw-bold fs-5 text-uppercase">Attendance Report Filter by:</p>
            <div class="top-right-buttons">
            <form action="printreport_att.php" method="post">
              <div class="d-flex">
              <div class="col-md-4 me-5">
                    <label for="employee_select"><strong>Select Employee:</strong></label>
                    <select id="employee_select" class="form-control" name="employee[]">
                      <option value="" disabled selected>Select an Employee here</option>
                      <?php
                      // Assuming $result contains the query result with employee data
                      while ($row = mysqli_fetch_assoc($result)) {
                        // Assuming the column names are 'em_id', 'first_name', and 'last_name'
                        $em_id = $row['em_id'];
                        $first_name = $row['first_name'];
                        $last_name = $row['last_name'];
                        // Display employee's full name as the option text
                        echo "<option value='$em_id'>$first_name $last_name</option>";
                      }
                      ?>
                    </select>
                  </div>
              <div class="col-md-3  me-5">
                    <label for="fromdate_input"><strong>Select start date:</strong></label>
                    <input type="date" id="fromdate_input" class="form-control" name="fromdate" required>
                  </div>
                  <div class="col-md-3  me-2">
                    <label for="todate_input"><strong>Select end date:</strong></label>
                    <input type="date" id="todate_input" class="form-control" name="todate" required>
                  </div>
                  
              </div>
            </div>
          </div>
          
          <div class="mt-4">
            <table class="table" id="example">
              <colgroup>
                <col width="10%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Employee Name</th>
                  <th class="text-center p-2">Attendance Date</th>
                  <th class="text-center p-2">Sign In</th>
                  <th class="text-center p-2">Sign Out</th>
                  <th class="text-center p-2">Total Working Hours</th>
                </tr>
              </thead>
              <?php
              $i = 1;
              $query = "SELECT * FROM `attendance` a INNER JOIN `employee` e ON e.em_id = a.em_id";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                $r_first_name = $row['first_name'];
                $r_last_name = $row['last_name'];
                $r_att_date = $row['att_date'];
                $r_att_s_in = date("h:i A", strtotime($row['att_s_in']));
                $r_att_s_out = date("h:i A", strtotime($row['att_s_out'])); 
                $total_hours = floor($row['total_hr']); 

                echo 
                "<tr> 
                    <td class='text-center p-3'>" . $i++ . "</td>
                    <td class='text-center p-3'>$r_last_name, $r_first_name </td>
                    <td class='text-center p-3'> $r_att_date </td>
                    <td class='text-center p-3'> $r_att_s_in </td>
                    <td class='text-center p-3'> $r_att_s_out </td>
                    <td class='text-center p-3'> $total_hours hours </td>
                  </tr>";
              ?>
              <?php
              }
              ?>
              
            </table>
            <div class="row mt-5">
              <div class="text-start justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Generate Print Report</button>
              </div>
          </form>


