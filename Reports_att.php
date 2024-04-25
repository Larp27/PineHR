<?php
$title = 'Attendance Report';
$page = 'reports_attendance';
include_once('DBConnection.php');
include_once('./main.php');

// Fetch employees from the database
$query = "SELECT em_id, first_name, last_name FROM employee";
$result = mysqli_query($conn, $query);

// Check if query was successful
if (!$result) {
  die("Database query failed.");
}
?>

<script src="./script.js"></script>
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
    <div class="col-md-12 p-4">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">Attendance Report</p>
        </div>

        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 pt-3">
              <div style="height:100vh;">
                <div class="d-flex justify-content-start align-items-start">
                  <div class="top-right-buttons">
                    <form method="post" id="filterForm">
                      <div class="d-flex">
                        <div class="col-md-3 mx-2">
                          <label for="employee_select" class="form-label text-capitalize fw-bold">Employee:</label>
                          <select id="employee_select" class="form-select" name="employee">
                            <option value="">All</option>
                            <?php
                              while ($row = mysqli_fetch_assoc($result)) {
                                $em_id = $row['em_id'];
                                $first_name = $row['first_name'];
                                $last_name = $row['last_name'];
                                // Check if the current employee ID matches the selected employee ID
                                $selected = ($_POST['employee'] ?? '') == $em_id ? 'selected' : '';
                                // Display employee's full name as the option text
                                echo "<option class='text-capitalize' value='$em_id' $selected>$first_name $last_name</option>";
                              }
                            ?>
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

                        <div class="col-md-4 mx-2 my-4 pt-2">
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
                    <tbody>
                      <?php
                        $query = "SELECT * FROM `attendance` a INNER JOIN `employee` e ON e.em_id = a.em_id";

                        // Check if filters are set
                        if(isset($_POST['apply_filter'])) {
                          $filter_conditions = array();
                      
                          // Employee filter
                          if (!empty($_POST['employee'])) {
                            $employee_id = $_POST['employee'];
                            $filter_conditions[] = "a.em_id = $employee_id";
                          }
                      
                          // Date range filter
                          if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
                            $from_date = $_POST['fromdate'];
                            $to_date = $_POST['todate'];
                            $filter_conditions[] = "a.att_date BETWEEN '$from_date' AND '$to_date'";
                          }
                      
                          // Add the filter conditions to the SQL query
                          if (!empty($filter_conditions)) {
                            $query .= " WHERE " . implode(" AND ", $filter_conditions);
                          }
                        }
                        
                        $result = mysqli_query($conn, $query);
                        
                        $i = 1;
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
<script>
  function printReport() {
    // Get filter values
    var employee = document.getElementById('employee_select').value;
    var fromdate = document.getElementById('fromdate_input').value;
    var todate = document.getElementById('todate_input').value;

    // Construct URL with filter parameters
    var url = 'printreport_att.php';
    var params = [];

    // Add filter parameters if they have values
    if (employee !== '') params.push('employee=' + employee);
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