<?php
$title = 'Reports Leave';
$page = 'reports_leave';
include_once('./main.php');

// Include your database connection
include_once('DBConnection.php');

// Fetch employees from the database
$query = "SELECT em_id, first_name, last_name FROM employee";
$result = mysqli_query($conn, $query);

// Fetch leave types for dropdown
$leave_types_query = "SELECT lt_id, lt_name FROM leave_type";
$leave_types_result = mysqli_query($conn, $leave_types_query);

// Get filter values
$filter_lt_id = isset($_POST['leaveType']) ? $_POST['leaveType'] : '';

// Retrieve leave type parameter from URL
$url_lt_id = isset($_GET['leaveType']) ? $_GET['leaveType'] : '';

// Set filter leave type based on URL parameter or form submission and only override if URL leave type is present
$filter_lt_id = !empty($url_lt_id) ? $url_lt_id : $filter_lt_id;

// Check if queries were successful
if (!$result || !$leave_types_result) {
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
                  <p class="fw-bold fs-5 text-uppercase">Report by filter:</p>
                  <div class="top-right-buttons">


                    <form action="printreport_leave.php" method="post">
                      <div class="d-flex">
                        <div class="col-md-3 me-3">
                          <label for="employee_select"><strong>Select Employee:</strong></label>
                          <select id="employee_select" class="form-control" name="employee[]" onchange="updateLeaveStatus(this.value)">
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
                            
                        <div class="col-md-2 me-3">
                          <label for="leaveType" class="form-label text-capitalize fw-bold">Leave Type:</label>
                          <select name="leaveType" id="leaveType" class="form-select">
                            <option value="">All</option>
                            <?php
                            // Iterate over the result to create options
                            while ($row = mysqli_fetch_assoc($leave_types_result)) {
                            ?>
                              <option value="<?php echo $row['lt_id']; ?>" <?php if ($row['lt_id'] == $filter_lt_id) echo 'selected'; ?>><?php echo $row['lt_name']; ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <?php
                        // Fetch enum values for status dropdown
                        $status_query = "SHOW COLUMNS FROM `leave_application` LIKE 'la_status'";
                        $status_result = mysqli_query($conn, $status_query);
                        $row = mysqli_fetch_assoc($status_result);
                        $enum_values = explode("','", substr($row['Type'], 6, -2));

                        // Get filter values
                        $filter_status = isset($_POST['status']) ? $_POST['status'] : '';

                        // Retrieve status parameter from URL
                        $url_status = isset($_GET['status']) ? $_GET['status'] : '';

                        // Set filter status based on URL parameter or form submission and only override if URL status is present
                        $filter_status = !empty($url_status) ? $url_status : $filter_status;
                        ?>

                        <div class="col-md-2 me-4">
                          <label for="status" class="form-label text-capitalize fw-bold">Status:</label>
                          <select name="status" id="status" class="form-select">
                            <option value="">All</option>
                            <?php foreach ($enum_values as $value) {
                              // Skip 'Pending' status
                              if ($value == 'Pending') continue;
                            ?>
                              <option value="<?php echo $value; ?>" <?php if ($value == $filter_status) echo 'selected'; ?>><?php echo ucfirst($value); ?></option>
                            <?php } ?>

                          </select>
                        </div>

                        <script>
                          function submitFormWithSelectedDate() {
                            document.getElementById("filterForm").submit();
                          }
                        </script>

                        <div class="col-md-2  me-3">
                          <label for="fromdate_input"><strong>Select start date:</strong></label>
                          <input type="date" id="fromdate_input" class="form-control" name="fromdate" required>
                        </div>
                        <div class="col-md-2  me-3">
                          <label for="todate_input"><strong>Select end date:</strong></label>
                          <input type="date" id="todate_input" class="form-control" name="todate" required>
                        </div>


                      </div>
                  </div>
                </div>


                <div class="dash_content mt-3">
                  <div class="dash_content_main">
                    <table class="table border shadow-lg" id="example">
                      <colgroup>
                        <col width="20%">
                        <col width="20%">
                        <col width="20%">
                        <col width="15%">
                      </colgroup>
                      <thead class="" style="background-color: rgb(255, 206, 46)">
                        <tr>
                          <th class="text-center p-1">Employee</th>
                          <th class="text-center p-1">Leave Type</th>
                          <th class="text-center p-1">Date</th>
                          <th class="text-center p-1">Status</th>
                        </tr>
                      </thead>
                      <tbody>
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

                          echo "<tr> 
                <td class='text-center'>$r_last_name, $r_first_name</td>
                <td class='text-center'>[$r_lt_code] - $r_lt_name</td>
                <td class='text-center'>$date_display</td>
                <td class='text-center'><span class='badge $status_color'>$r_lt_status</span></td>
            </tr>";
                        }
                        ?>
                      </tbody>
                    </table>




                    <div class="row mt-5">
                      <div class="text-start justify-content-center align-items-center">
                        <button type="submit" class="btn btn-primary">Generate Print Report</button>
                      </div>
                      </form>