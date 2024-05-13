<?php
  $title = 'Payroll Report';
  $page = 'reports_payroll';
  include_once('DBConnection.php');
  include_once('./main.php');

  if (!$result) {
    die("Database query failed: " . mysqli_error($conn));
  }

  // Fetch employees from the database
  $query = "SELECT em_id, first_name, last_name FROM employee";
  $result = mysqli_query($conn, $query);
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
          <p class="fw-bold fs-5 text-uppercase">PAYROLL REPORT</p>
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
                              // Assuming $result contains the query result with employee data
                              while ($row = mysqli_fetch_assoc($result)) {
                                  // Assuming the column names are 'em_id', 'first_name', and 'last_name'
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
                        <col width="4%">
                        <col width="15%">
                        <col width="15%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="10%">
                        <col width="15%">
                        <col width="10%">
                      </colgroup>
                      <thead class="" style="background-color: rgb(255, 206, 46)">
                        <tr>
                          <th class='text-center p-2'>#</th>
                          <th class='text-center p-2'>Employee Name</th>
                          <th class='text-center p-2'>Department</th>
                          <th class='text-center p-2'>Start Date</th>
                          <th class='text-center p-2'>End Date</th>
                          <th class='text-center p-2'>Daily Income</th>
                          <th class='text-center p-2'>Deduction</th>
                          <th class='text-center p-2'>Total Working Days</th>
                          <th class='text-center p-2'>Total Salary</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php
                          $query = "SELECT * FROM `payroll` p 
                          INNER JOIN `employee` e ON p.em_id = e.em_id
                          INNER JOIN `department` d ON e.dep_id = d.dep_id";

                          // Check if filters are set
                          if(isset($_POST['apply_filter'])) {
                            $filter_conditions = array();
                        
                            // Employee filter
                            if (!empty($_POST['employee'])) {
                              $employee_id = $_POST['employee'];
                              $filter_conditions[] = "p.em_id = $employee_id";
                            }
                        
                            // Date range filter
                            if (!empty($_POST['fromdate']) && !empty($_POST['todate'])) {
                              $from_date = $_POST['fromdate'];
                              $to_date = $_POST['todate'];
                              $filter_conditions[] = "p.payroll_start_date >= '$from_date' AND p.payroll_end_date <= '$to_date'";
                            }
                        
                            // Add the filter conditions to the SQL query
                            if (!empty($filter_conditions)) {
                              $query .= " WHERE " . implode(" AND ", $filter_conditions);
                            }
                          }
                        
                          $result = mysqli_query($conn, $query);
                          
                          $i = 1;
                          while ($row = mysqli_fetch_assoc($result)) {
                        ?>
                          <tr class="text-capitalize">
                            <td class='text-center p-3'> <?php echo $i++; ?> </td>
                            <td class='text-left p-3'> <?php echo $row["last_name"] . ", " . $row["first_name"]; ?> </td>
                            <td class='text-left p-3'> <?php echo $row["dep_name"]; ?> </td>
                            <td class='text-center p-3'> <?php echo $row["payroll_start_date"]; ?> </td>
                            <td class='text-center p-3'> <?php echo $row["payroll_end_date"]; ?> </td>
                            <td class='text-center p-3'> <?php echo $row["payroll_income"]; ?> </td>
                            <td class='text-center p-3'> <?php echo $row["payroll_deduction"]; ?> </td>
                            <td class='text-center p-3'> <?php echo $row["payroll_twd"]; ?> </td>
                            <td class='text-center p-3'> <?php echo $row["payroll_total"]; ?> </td>
                          </tr>
                        <?php } ?>
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
    var fromdate = document.getElementById('fromdate_input').value;
    var todate = document.getElementById('todate_input').value;

    // Construct URL with filter parameters
    var url = 'printreport_payroll.php';
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