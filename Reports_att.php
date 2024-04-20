<!--Declaration of user session -logout- -->
<?php
$title = 'Attendance Report';
$page = 'reports_attendance';
include_once('./main.php');
?>
<!--cont logout session-->

<script src="./script.js"></script>



<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-calendar-days fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance Reports</span></strong>
      </strong>
    </div><br>


    <div class="col-md-7" style="width: 100%">
      <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
        <div class="panel-heading">
          <strong>
            &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-list-check fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance Date</span></strong>
          </strong>

          <body>
        </div>
        <div class="container-sm mt-4">
          <form action="printreport_att.php" method="post">

            <div class="row">
              <h5 class="fw-bold">ATTENDANCE REPORT BY DATE</h5>
              <div class="col">
                <label for="fromdate_input">Select start date:</label>
                <input type="date" id="fromdate_input" class="form-control" name="fromdate" required>
              </div>
              <div class="col">
                <label for="todate_input">Select end date:</label>
                <input type="date" id="todate_input" class="form-control" name="todate" required>
              </div>
            </div>
            <button type="submit" class="btn btn-primary mt-3">Generate Attendance Report</button>
            <br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br><br>
        </div>
        </form>