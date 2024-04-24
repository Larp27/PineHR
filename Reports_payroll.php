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
          <p class="fw-bold fs-5 text-uppercase">PAYROLL REPORT</p>
        </div>

        <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-5 shadow-lg ">
        <div style="height:100vh;">
          <div class="d-flex justify-content-between align-items-center">
            <p class="fw-bold fs-5 text-uppercase">Payroll Report Filter by:</p>
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


          <div class="mt-3">
            <table class="table" id="example">
              <colgroup>
                <col width="5%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="10%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th>#</th>
                  <th>Employee Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Daily Income</th>
                  <th>Deduction</th>
                  <th>Total Working Days</th>
                  <th>Total Salary</th>
                </tr>
              </thead>
              <?php
              $i = 1;
              $rows = mysqli_query($conn, "SELECT * FROM `payroll` p INNER JOIN `employee` e ON p.em_id = e.em_id");
              foreach ($rows as $row) :
              ?>
                <tr>
                  <td> <?php echo $i++; ?> </td>
                  <td> <?php echo $row["last_name"] . ", " . $row["first_name"]; ?> </td>
                  <td> <?php echo $row["payroll_start_date"]; ?> </td>
                  <td> <?php echo $row["payroll_end_date"]; ?> </td>
                  <td> <?php echo $row["payroll_income"]; ?> </td>
                  <td> <?php echo $row["payroll_deduction"]; ?> </td>
                  <td> <?php echo $row["payroll_twd"]; ?> </td>
                  <td> <?php echo $row["payroll_total"]; ?> </td>
                </tr>
              <?php endforeach; ?>
          </table>

            <div class="row mt-5">
              <div class="text-start justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary">Generate Print Report</button>
              </div>
          </form>
