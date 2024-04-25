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

$status_query = "SHOW COLUMNS FROM `leave_application` LIKE 'la_status'";
$status_result = mysqli_query($conn, $status_query);
$row = mysqli_fetch_assoc($status_result);
$enum_values = explode("','", substr($row['Type'], 6, -2));

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
<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }

  div.dataTables_wrapper div.dataTables_length select{
    width: auto;
    display: inline-block;
    border-radius: 5px;
    padding-top: .30rem;
    padding-bottom: .30rem;
    padding-left: .5rem;
    padding-right: 2.5rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
  }

  div.dataTables_wrapper div.dataTables_length select {
    width: auto;
    display: inline-block;
    border-radius: 15px;
    padding-top: .30rem;
    padding-bottom: .30rem;
    padding-left: .5rem;
    padding-right: 2.5rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
  }

  th {
    text-transform: uppercase !important;
  }

  td {
    font-size: 15px !important;
  }

</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-4 shadow-lg">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">LEAVE APPLICATION REPORT</p>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 pt-3">
              <div style="height:100vh;">
                <div class="d-flex justify-content-start align-items-start">
                  <div class="top-right-buttons">
                    <form method="post" id="filterForm">
                      <div class="d-flex">
                        <div class="col-md-2 mx-2">
                          <label for="employee_select" class="form-label text-capitalize fw-bold">Employee:</label>
                          <select id="employee_select" class="form-select" name="employee">
                            <option value="">All</option>
                            <?php
                              // Assuming $result contains the query result with employee data
                              while ($row = mysqli_fetch_assoc($result)) {
                                  // Assuming the column names are 'em_id', 'first_name', and 'last_name'
                                  $em_id = $row['em_id'];
                                  $first_name = $row['first_name'];
                                  $last_name = $row['last_name'];
                                  // Check if the current employee ID matches the selected employee ID
                                  $selected = ($_POST['employee'] ?? '') == $em_id ? 'selected' : '';
                                  // Display employee's full name as the option text
                                  echo "<option value='$em_id' $selected>$first_name $last_name</option>";
                              }
                            ?>
                          </select>
                        </div>
                            
                        <div class="col-md-2 mx-2">
                          <label for="leaveType" class="form-label text-capitalize fw-bold">Leave Type:</label>
                          <select name="leaveType" id="leaveType" class="form-select">
                              <option value="">All</option>
                              <?php
                              // Iterate over the result to create options
                              while ($row = mysqli_fetch_assoc($leave_types_result)) {
                                  // Check if the current leave type ID matches the selected leave type ID
                                  $selected = ($_POST['leaveType'] ?? '') == $row['lt_id'] ? 'selected' : '';
                                  ?>
                                  <option value="<?php echo $row['lt_id']; ?>" <?php echo $selected; ?>><?php echo $row['lt_name']; ?></option>
                              <?php } ?>
                          </select>
                        </div>

                        <div class="col-md-1">
                          <label for="status" class="form-label text-capitalize fw-bold">Status:</label>
                          <select name="status" id="status" class="form-select">
                            <option value="">All</option>
                            <?php foreach ($enum_values as $value) { ?>
                              <?php $selected = ($_POST['status'] ?? '') == $value ? 'selected' : ''; ?>
                              <option value="<?php echo $value; ?>" <?php echo $selected; ?>><?php echo ucfirst($value); ?></option>
                            <?php } ?>
                          </select>
                        </div>

                        <div class="col-md-2 mx-2">
                          <label for="fromdate_input" class="form-label text-capitalize fw-bold">Start Date:</label>
                          <input type="date" id="fromdate_input" class="form-control" name="fromdate" value="<?php echo $_POST['fromdate'] ?? ''; ?>">
                        </div>

                        <div class="col-md-2 mx-2">
                          <label for="todate_input" class="form-label text-capitalize fw-bold">End Date:</label>
                          <input type="date" id="todate_input" class="form-control" name="todate" value="<?php echo $_POST['todate'] ?? ''; ?>">
                        </div>

                        <div class="col-md-3 mx-2 my-4 pt-2">
                          <button type="submit" name="apply_filter" class="btn btn-primary fw-bold mx-2">Apply Filter</button>
                          <button type="button" onclick="printReport()" class="btn btn-secondary fw-bold">Print Report</button>
                        </div>
                      </div>
                    </form>
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
                          // Define the SQL query to fetch data
                          $query = "SELECT la.*, e.first_name, e.last_name, lt.lt_code, lt.lt_name, la.la_reason
                                    FROM `leave_application` la 
                                    INNER JOIN `employee` e ON la.em_id = e.em_id 
                                    INNER JOIN `leave_type` lt ON lt.lt_id = la.lt_id";

                          // If the filter form is submitted, apply the filter conditions
                          if (isset($_POST['apply_filter'])) {
                            // Construct the filter conditions based on the form inputs
                            $filter_conditions = array();

                            // Employee filter
                            if (!empty($_POST['employee'])) {
                              $employee_id = $_POST['employee'];
                              $filter_conditions[] = "la.em_id = $employee_id";
                            }

                            // Leave type filter
                            if (!empty($_POST['leaveType'])) {
                              $leave_type_id = $_POST['leaveType'];
                              $filter_conditions[] = "la.lt_id = $leave_type_id";
                            }

                            // Status filter
                            if (!empty($_POST['status'])) {
                              $status = $_POST['status'];
                              $filter_conditions[] = "la.la_status = '$status'";
                            }

                            // Date range filter
                            if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
                              $from_date = $_POST['fromdate'];
                              $to_date = $_POST['todate'];
                              $filter_conditions[] = "la.la_date_start >= '$from_date' AND la.la_date_end <= '$to_date'";
                            }

                            // Add the filter conditions to the SQL query
                            if (!empty($filter_conditions)) {
                              $query .= " WHERE " . implode(" AND ", $filter_conditions);
                            }
                          }

                          // Execute the query
                          $result = mysqli_query($conn, $query);

                          // Display the results
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
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<script>
  function printReport() {
    // Get filter values
    var employee = document.getElementById('employee_select').value;
    var leaveType = document.getElementById('leaveType').value;
    var status = document.getElementById('status').value;
    var fromdate = document.getElementById('fromdate_input').value;
    var todate = document.getElementById('todate_input').value;

    // Construct URL with filter parameters
    var url = 'printreport_leave.php';
    var params = [];

    // Add filter parameters if they have values
    if (employee !== '') params.push('employee=' + employee);
    if (leaveType !== '') params.push('leaveType=' + leaveType);
    if (status !== '') params.push('status=' + status);
    if (fromdate !== '') params.push('fromdate=' + fromdate);
    if (todate !== '') params.push('todate=' + todate);

    // Check if any filter parameter is present
    if (params.length > 0) {
      url += '?' + params.join('&');
    }

    // Open new tab with the constructed URL
    var newTab = window.open(url, '_blank');

    // Detect if print dialog is canceled
    newTab.onbeforeunload = function() {
      newTab.close(); // Close the new tab
    };
  }

  // Function to reset all filter selections
  function resetFilters() {
    document.getElementById('employee_select').value = '';
    document.getElementById('leaveType').value = '';
    document.getElementById('status').value = '';
    document.getElementById('fromdate_input').value = '';
    document.getElementById('todate_input').value = '';
  }

  // Check if the page is refreshed
  window.onload = function() {
    if (performance.navigation.type === 1) {
      // Page is refreshed, reset filters
      resetFilters();
      // Redirect user to the same page with GET request
      window.location.href = window.location.href.split('?')[0];
    }
  };

  // JavaScript to toggle the 'required' attribute based on the presence of values in the start and end dates
  document.getElementById('fromdate_input').addEventListener('input', function() {
    var todate_input = document.getElementById('todate_input');
    if (this.value !== '') {
      todate_input.setAttribute('required', '');
    } else {
      todate_input.removeAttribute('required');
    }
  });

  document.getElementById('todate_input').addEventListener('input', function() {
    var fromdate_input = document.getElementById('fromdate_input');
    if (this.value !== '') {
      fromdate_input.setAttribute('required', '');
    } else {
      fromdate_input.removeAttribute('required');
    }
  });
</script>