<!--Declaration of user session -logout- -->
<?php
session_start();
include "DBConnection.php";
if (isset($_SESSION['s_em_email'])) {
?>
 
<body>
  <!--LOGOUT -- getting user role to display specific features and function -->
  <?php
  $em_id = $_SESSION['s_em_id'];
  if ($_SESSION['s_user_id'] == 2) {
    $query = "Select * from employee where em_id = $em_id";

    $result = mysqli_query($conn, $query);
  }
  ?>
  <div id="dashmaincontainer">
    <div class="dash_sidebar_menus">
      <?php if ($_SESSION['s_user_id'] == 2) : ?>
      <?php endif; ?>
    </div>
    <div class="dash_content_container" id="dash_content_container">
      <div class="dash_topnav" id="dash_topnav">
        <a href="Dashboard.php">
          <img src="bgimages/pine.png" alt="logo" style="width: 90px; margin-top: -20px; margin-left: -8px; margin-bottom: -20px;">
        </a>
        <h10 style="font-family: 'Glacial Indifference';">&nbsp; Welcome <?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?>!</h10>
        <a href="logout.php" id="lougoutbtn" style="font-family: 'Glacial Indiffernce'; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-duotone fa-arrow-right-from-bracket"></i>&nbsp; Logout</a>
      </div>
      <div>
        <div id="exampleModal" class="modal fade">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <form id="addProductForm" action="">
                <div class="modal-header">
                  <h4 class="modal-title">Are you sure you want to logout?</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-footer">
                  <a href="Dashboard.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
                  <a href="logout.php"><button type="button" class="btn btn-primary" name="btnSave2" id="btnSave2">Yes</button></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <div class="col-md-12">
        <ul class="nav nav-tabs">
          <li class="nav-item">
            <a class="nav-link fw-bold" href="employee.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="employee_profile.php">Profile</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fw-bold active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Leave</a>
            <ul class="dropdown-menu">
              <?php
              // Check if the user has any employee leave credits
              $em_id = $_SESSION['s_em_id'];
              $query = "SELECT COUNT(*) AS count FROM employee_leave_credits WHERE em_id = $em_id";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $leave_credit_count = $row['count'];

              // Check if all leave credits are 0
              $all_credits_zero = false;
              if ($leave_credit_count > 0) {
                $query = "SELECT SUM(available_credits) AS total_credits FROM employee_leave_credits WHERE em_id = $em_id";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_credits = $row['total_credits'];
                if ($total_credits == 0) {
                  $all_credits_zero = true;
                }
              }
              $application_disabled = ($leave_credit_count == 0 || $all_credits_zero) ? 'disabled' : '';
              $tooltip_message = "";
              if ($leave_credit_count == 0) {
                $tooltip_message = "You have no employee leave credits.";
              } elseif ($all_credits_zero) {
                $tooltip_message = "All your leave types have zero available credits.";
              }
              echo '<li data-bs-toggle="tooltip" data-bs-placement="top" title="' . $tooltip_message . '"><a class="dropdown-item fw-bold' . $application_disabled . '" href="employee_application.php" >Application</a></li>';
              ?>
              <li><a class="dropdown-item active fw-bold" href="./employee_app_list.php">List</a></li>
            </ul>
          </li>
        </ul>
        <div class="panel panel-default">
          <div class="panel-heading text-uppercase">
            <strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Applications</strong>
          </div>
        </div>
        <div class="col-md-12 mt-3">
          <div>
            <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
              <div class="panel-heading text-uppercase">
                <strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Leave Application List History</strong>
                <?php
                  // Fetch leave types for dropdown
                  $em_id = $_SESSION['s_em_id'];
                  $leave_types_query = "SELECT lt.lt_id, lt.lt_name, ec.available_credits FROM leave_type lt INNER JOIN employee_leave_credits ec ON lt.lt_id = ec.lt_id
                  WHERE ec.em_id = $em_id";
                  $leave_types_result = mysqli_query($conn, $leave_types_query);

                  // Fetch enum values for status dropdown
                  $status_query = "SHOW COLUMNS FROM `leave_application` LIKE 'la_status'";
                  $status_result = mysqli_query($conn, $status_query);
                  $row = mysqli_fetch_assoc($status_result);
                  $enum_values = explode("','", substr($row['Type'], 6, -2));
                ?>
                <div class="row my-3">
                  <div class="col-6"></div>
                  <div class="col-6">
                    <?php
                      // Fetch leave types for dropdown
                      $em_id = $_SESSION['s_em_id'];
                      $leave_types_query = "SELECT lt.lt_id, lt.lt_name, ec.available_credits FROM leave_type lt INNER JOIN employee_leave_credits ec ON lt.lt_id = ec.lt_id
                      WHERE ec.em_id = $em_id";
                      $leave_types_result = mysqli_query($conn, $leave_types_query);

                      // Fetch enum values for status dropdown
                      $status_query = "SHOW COLUMNS FROM `leave_application` LIKE 'la_status'";
                      $status_result = mysqli_query($conn, $status_query);
                      $row = mysqli_fetch_assoc($status_result);
                      $enum_values = explode("','", substr($row['Type'], 6, -2));

                      // Get filter values
                      $filter_lt_id = isset($_POST['leaveType']) ? $_POST['leaveType'] : '';
                      $filter_status = isset($_POST['status']) ? $_POST['status'] : '';

                      // Retrieve status parameter from URL
                      $url_status = isset($_GET['status']) ? $_GET['status'] : '';

                      // Set filter status based on URL parameter or form submission and only override if URL status is present
                      $filter_status = !empty($url_status) ? $url_status : $filter_status;
                    ?>
                    <form method="post" id="filterForm">
                      <div class="row align-items-end">
                        <div class="col-7">
                          <div class="row">
                            <div class="col-6">
                              <label for="leaveType" class="form-label text-capitalize fw-bold">Leave Type:</label>
                              <select name="leaveType" id="leaveType" class="form-select">
                                <option value="">All</option>
                                <?php while ($row = mysqli_fetch_assoc($leave_types_result)) { ?>
                                  <option value="<?php echo $row['lt_id']; ?>" <?php if ($row['lt_id'] == $filter_lt_id) echo 'selected'; ?>><?php echo $row['lt_name']; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            <div class="col-6">
                              <label for="status" class="form-label text-capitalize fw-bold">Status:</label>
                              <select name="status" id="status" class="form-select">
                                <option value="">All</option>
                                <?php foreach ($enum_values as $value) { ?>
                                  <option value="<?php echo $value; ?>" <?php if ($value == $filter_status) echo 'selected'; ?>><?php echo $value; ?></option>
                                <?php } ?>
                              </select>
                            </div>
                            </div>
                          </div>
                          <div class="col-5 text-end">
                            <button type="button" class="btn btn-primary fw-bold" onclick="submitFormWithSelectedStatus()">Apply Filter</button>
                            <button class="btn btn-secondary fw-bold" onclick="printTable('employeeTable')">Print Table</button>
                          </div>
                        </div>
                      </div>
                    </form>
                    <script>
                      // JavaScript function of the Filter Status to update status parameter and submit the form
                      function submitFormWithSelectedStatus() {
                        var form = document.getElementById('filterForm');
                        var url = new URL(window.location.href);
                        var selectedStatus = document.getElementById('status').value;
                        
                        // Update status parameter with selected value
                        url.searchParams.set('status', selectedStatus);
                        
                        // Update form action with modified URL
                        form.action = url.toString();
                        form.submit();
                      }
                    </script>


                  </div>
                </div>
                <?php
                  // Retrieve status parameter from URL
                  $url_status = isset($_GET['status']) ? $_GET['status'] : '';

                  // Set filter status based on URL parameter or form submission
                  $filter_status = !empty($url_status) ? $url_status : (isset($_POST['status']) ? $_POST['status'] : '');

                  // Check if the URL contains a status parameter and set the filter status accordingly
                  if (!empty($url_status)) {
                    $filter_status = $url_status;
                  }

                  $query = "SELECT la.*, lt.*, e.first_name, e.last_name
                            FROM `leave_application` la 
                            INNER JOIN `leave_type` lt ON la.lt_id = lt.lt_id 
                            INNER JOIN `employee` e ON la.em_id = e.em_id
                            WHERE la.em_id = $em_id ";

                  if (!empty($filter_lt_id)) {
                    $query .= "AND la.lt_id = $filter_lt_id ";
                  }

                  if (!empty($filter_status)) {
                    $query .= "AND la.la_status = '$filter_status' ";
                  }

                  $query .= "ORDER BY la.la_date_start DESC";

                  $result = mysqli_query($conn, $query);
                  if (mysqli_num_rows($result) > 0) {
              ?>
                <div class="row" style="margin: 20px !important;">
                <table class="table table-hover" id="employeeTable">
                    <thead style="background-color: rgb(255, 206, 46)">
                      <tr>
                        <th class="text-center p-1">Employee</th>
                        <th class="text-center p-1">Leave Type</th>
                        <th class="text-center p-1">Date</th>
                        <th class="text-center p-1">Status</th>
                      </tr>
                    </thead>
                    <tbody>
                    <?php
                      while ($row = mysqli_fetch_assoc($result)) {
                        $r_first_name = $row['first_name'];
                        $r_last_name = $row['last_name'];
                        $r_lt_code = $row['lt_code'];
                        $r_lt_name = $row['lt_name'];
                        $r_la_date_start = date("F j, Y", strtotime($row['la_date_start']));
                        $r_la_date_end = date("F j, Y", strtotime($row['la_date_end']));
                        $r_lt_status = $row['la_status'];
                        if (date("F Y", strtotime($r_la_date_start)) == date("F Y", strtotime($r_la_date_end))) {
                          $date_display = "$r_la_date_start";
                        } else {
                          $date_display = "$r_la_date_start - $r_la_date_end";
                        }
                        // Set status badge color based on the status value
                        $status_color = '';
                        switch ($r_lt_status) {
                          case 'Accepted':
                            $status_color = 'bg-success'; // Green
                            break;
                          case 'Declined':
                            $status_color = 'bg-danger'; // Red
                            break;
                          case 'Cancelled':
                            $status_color = 'bg-warning'; // Yellow
                            break;
                          case 'Pending':
                          default:
                            $status_color = 'bg-secondary'; // Default gray
                            break;
                        }
                      ?>
                        <tr>
                          <td class='text-center p-3'><?php echo "$r_last_name, $r_first_name"; ?></td>
                          <td class='text-center p-3'>[<?php echo $r_lt_code; ?>] - <?php echo $r_lt_name; ?></td>
                          <td class='text-center p-3'><?php echo $date_display; ?></td>
                          <td class='text-center'><span class='badge <?php echo $status_color; ?>'><?php echo $r_lt_status; ?></span></td>
                        </tr>
                      <?php
                      }
                    ?>
                    </tbody>
                  </table>
                </div>
                  
                <?php } else { ?>
                  <div class="row" style="margin: 20px !important;">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center p-1"  style="background-color: rgb(255, 206, 46) !important;">Employee</th>
                          <th class="text-center p-1"  style="background-color: rgb(255, 206, 46) !important;">Leave Type</th>
                          <th class="text-center p-1"  style="background-color: rgb(255, 206, 46) !important;">Date</th>
                          <th class="text-center p-1"  style="background-color: rgb(255, 206, 46) !important;">Status</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="4" class="text-center font-weight-bold">No records found.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php } ?>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<script>
  function printTable(tableId) {
    var tableToPrint = document.getElementById(tableId).cloneNode(true);
    var newWin = window.open('', 'Print-Window');
    newWin.document.open();
    newWin.document.write('<html><head><style>table { border-collapse: collapse; width: 100%; } th, td { text-align: left; padding: 8px; } tr:nth-child(even) { background-color: #f2f2f2; } th { background-color: #4CAF50; color: white; }</style></head><body onload="window.print()">' + tableToPrint.outerHTML + '</body></html>');
    newWin.document.close();
    setTimeout(function() {
      newWin.close();
    }, 10);
  }