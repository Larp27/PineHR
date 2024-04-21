<?php
$title = 'Payroll Report';
$page = 'reports_payroll';
include_once('./main.php');
?>

<script src="./script.js"></script>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-5 shadow-lg">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">PAYROLL REPORT</p>
        </div>
        <div class="container-sm mt-4">
          <form action="printreport_payroll.php" method="post">
            <div class="col-md-12">
              <div class="bg-white border-1 shadow-lg">
                <h5 class="fw-bold fs-6 p-3">PAYROLL REPORT BY DATE</h5>
                <div class="col-md-12 p-3 d-flex"> <!-- Modified this line -->
                  <div class="col-md-5 ms-5 me-5">
                    <label for="fromdate_input">Select start date:</label>
                    <input type="date" id="fromdate_input" class="form-control" name="fromdate" required>
                  </div>
                  <div class="col-md-5 ms-5">
                    <label for="todate_input">Select end date:</label>
                    <input type="date" id="todate_input" class="form-control" name="todate" required>
                  </div>
                </div> <!-- Removed the row div from here -->
              </div>
            </div>
            <div class="row mt-5">
              <div class="text-start justify-content-center align-items-center">
                <button type="submit" class="btn btn-primary mt-3">Generate Payroll Report</button>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>