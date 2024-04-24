<?php
$title = 'Payroll Report';
$page = 'reports_payroll';
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
    <div class="col-md-12 p-5 shadow-lg">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">LEAVE APPLICATION REPORT</p>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 p-5 shadow-lg ">
              <div style="height:100vh;">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="fw-bold fs-5 text-uppercase">LEAVE APPLICATION Report Filter by:</p>
                  <div class="top-right-buttons">
                    <form action="printreport_payroll.php" method="post">
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
                        <div class="col-md-3 me-5">
                          <label for="date_input"><strong>Select date:</strong></label>
                          <input type="date" id="date_input" class="form-control" name="date" required>
                        </div>


                      </div>
                  </div>
                </div>


                <div class="dash_content mt-3">
                  <div class="dash_content_main">
                    <table class="table border shadow-lg" id="example">
                      <colgroup>
                        <col width="25%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">

                      </colgroup>
                      <thead class="" style="background-color: rgb(255, 206, 46)">
                        <tr>
                          <th class="text-center p-1">Employee</th>
                          <th class="text-center p-1">Leave Type</th>
                          <th class="text-center p-1">Date</th>
                          <th class="text-center p-1">Status</th>
    
                        </tr>
                      </thead>
                      <?php
                      $query = "SELECT la.*, e.first_name, e.last_name, lt.lt_code, lt.lt_name, la.la_reason
                      FROM `leave_application` la 
                      INNER JOIN `employee` e ON la.em_id = e.em_id 
                      INNER JOIN `leave_type` lt ON lt.lt_id = la.lt_id";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $r_first_name = $row['first_name'];
                        $r_last_name = $row['last_name'];
                        $r_lt_code = $row['lt_code'];
                        $r_lt_name = $row['lt_name'];
                        $emp_id = $row['la_id'];
                        $lt_id = $row['lt_id'];
                        $r_la_date_start = date("F j, Y", strtotime($row['la_date_start']));
                        $r_la_date_end = date("F j, Y", strtotime($row['la_date_end']));
                        $r_lt_status = $row['la_status'];
                        $r_la_reason = $row['la_reason'];

                        if (date("F Y", strtotime($r_la_date_start)) == date("F Y", strtotime($r_la_date_end))) {
                          $date_display = "$r_la_date_start";
                        } else {
                          $date_display = "$r_la_date_start - $r_la_date_end";
                        }
                        $status_color = '';
                        switch ($r_lt_status) {
                          case 'Accepted':
                            $status_color = 'bg-success'; 
                            break;
                          case 'Declined':
                            $status_color = 'bg-danger'; 
                            break;
                          case 'Cancelled':
                            $status_color = 'bg-warning'; 
                            break;
                          case 'Pending':
                          default:
                            $status_color = 'bg-secondary'; 
                            break;
                        }

                        $final = "<tr> 
                          <td class='text-center'>$r_last_name, $r_first_name</td>
                          <td class='text-center'>[$r_lt_code] - $r_lt_name</td>
                          <td class='text-center'>$date_display</td>
                          <td class='text-center'><span class='badge $status_color'>$r_lt_status</span></td>";
                         
                        }
                        ?>
                    </table>



                  <div class="row mt-5">
                    <div class="text-start justify-content-center align-items-center">
                      <button type="submit" class="btn btn-primary">Generate Print Report</button>
                    </div>
                    </form>