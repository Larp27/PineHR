<?php
$title = 'Leave';
$page = 'leave_app_list';
include_once('./main.php');
?>

  
    <!--Department Process Add and Update JS-->
    <script src="Department/DepartmentJS.js"></script>
    <script src="Department/updateDEPT.js"></script>

  <style>
    div.dataTables_wrapper div.dataTables_paginate .paginate_button {
      border: none !important;
      padding: 0px !important;
    }

    div.dataTables_wrapper div.dataTables_length select {
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

    div.dataTables_wrapper div.dataTables_paginate .paginate_button {
      border: none !important;
      padding: 0px !important;
    }

    div.dataTables_wrapper div#example_paginate ul.pagination li.paginate_button .page-item .active .page-link {

      background-color: #EBB803 !important;

    }

    div.dataTables_wrapper div.dataTables_paginate ul.pagination li#example_previous,
    div.dataTables_wrapper div.dataTables_paginate a#example_next.paginate_button.disabled {
      background-color: #8080792b !important;
      border-color: #dee2e6 !important;
      color: rgba(33, 37, 41, 0.75) !important;
    }
  </style>
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-12 p-5 shadow-lg">
              <div style="height:100vh;">
                <div class="d-flex justify-content-between align-items-center">
                  <p class="fw-bold fs-5 text-uppercase">Leave Application List</p>
                  <?php if ($_SESSION['s_user_id'] == 1) {
                    $query = "select * from user_type";

                    $result = mysqli_query($conn, $query);
                  } {
                    echo '<a href="Leave_app_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Leave Application +</button> </a>';
                  }
                  ?>
                </div>

                <div class="dash_content mt-3">
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
                      
                      $leave_types_query = "SELECT * FROM leave_type";
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
                        <div class="col-8">
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
                          <div class="col-4 text-end">
                            <button type="button" class="btn btn-primary fw-bold" onclick="submitFormWithSelectedStatus()">Apply Filter</button>
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
                  <div class="dash_content_main">
                    <table class="table border shadow-lg" id="example">
                      <colgroup>
                        <col width="25%">
                        <col width="25%">
                        <col width="20%">
                        <col width="10%">
                        <col width="25%">
                      </colgroup>
                      <thead class="" style="background-color: rgb(255, 206, 46)">
                        <tr>
                          <th class="text-center p-1">Employee</th>
                          <th class="text-center p-1">Leave Type</th>
                          <th class="text-center p-1">Date</th>
                          <th class="text-center p-1">Status</th>
                          <th class="text-center p-1">Action</th>

                        </tr>
                      </thead>
                      <?php
                        $query = "SELECT la.*, e.first_name, e.last_name, lt.lt_code, lt.lt_name, la.la_reason
                        FROM `leave_application` la 
                        INNER JOIN `employee` e ON la.em_id = e.em_id 
                        INNER JOIN `leave_type` lt ON lt.lt_id = la.lt_id";
            
                        $whereClause = [];
                        
                        if (!empty($filter_lt_id)) {
                            $whereClause[] = "la.lt_id = $filter_lt_id";
                        }
                        
                        if (!empty($filter_status)) {
                            $whereClause[] = "la.la_status = '$filter_status'";
                        }
                        
                        if (!empty($whereClause)) {
                            $query .= " WHERE " . implode(" AND ", $whereClause);
                        }
                        
                        $query .= " ORDER BY la.la_date_start DESC";

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
                        $r_la_remarks = $row['la_remarks'];
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

                        echo "<div class='modal fade' id='declineModal_$emp_id' tabindex='-1' aria-labelledby='declineModalLabel' aria-hidden='true'>
                        <div class='modal-dialog'>
                            <div class='modal-content'>
                                <div class='modal-header'>
                                    <h5 class='modal-title' id='declineModalLabel'>Decline Leave Application</h5>
                                    <button type='button' class='btn-close' data-bs-dismiss='modal' aria-label='Close'></button>
                                </div>
                                <form id='declineForm' action='update_leave_status.php' method='POST'>
                                <div class='modal-body'>
                                    <p>Are you sure you want to decline this leave application?</p>
                                    <div class='mb-3'>
                                        <label for='la_remarks' class='form-label'>Remarks:</label>
                                        <textarea class='form-control' id='la_remarks' name='la_remarks' rows='5'></textarea>
                                    </div>
                                </div>
                                <div class='modal-footer'>
                                    <button type='button' class='btn btn-secondary' data-bs-dismiss='modal'>Close</button>
                                   
                                 
                                        <input type='hidden' name='la_id' value='$emp_id'>
                                        <input type='hidden' name='lt_id' value='$lt_id'>
                                        <input type='hidden' name='s_em_id' value='$em_id'>
                                        <button type='submit' name='decline' class='btn btn-danger'>Decline</button>
                                    
                                </div>
                            </div>
                            </form>
                        </div>
                    </div>
                    ";

                        $final = "<tr> 
                        <td class='text-left'>$r_last_name, $r_first_name</td>
                        <td class='text-left'>[$r_lt_code] - $r_lt_name</td>
                        <td class='text-center'>$date_display</td>
                        <td class='text-center'><span class='badge $status_color'>$r_lt_status</span></td>";
                        echo $final;

                        // Show dropdown menu for Accept, Decline, Cancel, and View based on the status
                        if ($r_lt_status == 'Pending') {
                          echo "<td class='text-center'>
                                  <div class='col-auto d-flex justify-content-center'>
                                    <button type='button' class='py-1 px-2 me-1 btn btn-primary btn-sm view-user-btn' data-bs-toggle='modal' data-bs-target='#viewModal' data-emp-id='$emp_id'><i class='fas fa-eye'></i> View</button>
                                    <div class='dropdown'>
                                      <button class='btn btn-secondary btn-sm dropdown-toggle' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                                        Actions
                                      </button>
                                      <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                                        <li>
                                          <form action='update_leave_status.php' method='POST'>
                                            <input type='hidden' name='la_id' value='$emp_id'>
                                            <input type='hidden' name='s_em_id' value='$em_id'>
                                            <input type='hidden' name='lt_id' value='$lt_id'>
                                            <input type='hidden' name='lt_status' value='Accepted'>
                                            <button type='submit' name='accept' class='dropdown-item btn btn-success btn-sm'><i class='fas fa-check'></i> Accept</button>
                                          </form>
                                        </li>
                                        <li>
                                          <!-- Decline modal trigger button -->
                                          <button type='button' class='dropdown-item btn btn-danger btn-sm' data-bs-toggle='modal' data-bs-target='#declineModal_$emp_id' data-em-id='$em_id'><i class='fas fa-times'></i> Decline</button>
                                        </li>
                                        <li>
                                          <form action='update_leave_status.php' method='POST'>
                                            <input type='hidden' name='la_id' value='$emp_id'>
                                            <input type='hidden' name='s_em_id' value='$em_id'>
                                            <input type='hidden' name='lt_id' value='$lt_id'>
                                            <input type='hidden' name='lt_status' value='Cancelled'>
                                            <button type='submit' name='cancel' class='dropdown-item btn btn-warning btn-sm'><i class='fas fa-ban'></i> Cancel</button>
                                          </form>
                                        </li>
                                      </ul>
                                    </div>
                                  </div>
                                </td>";
                        } else {
                          echo "<td class='text-center'>
                                  <div class='col-auto d-flex justify-content-center m-2 align-items-center'>
                                    <button type='button' class='py-1 px-2 me-1 btn btn-primary btn-sm view-user-btn' data-bs-toggle='modal' data-bs-target='#viewModal' data-emp-id='$emp_id'><i class='fas fa-eye'></i> View</button>";

                          if ($r_lt_status != 'Pending') {
                            echo "<a href='Leave_application/deleteLA.php?la_id=$emp_id' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this Leave Application?\")'><i class='fas fa-trash'></i> Delete</a>";
                          } else {
                            echo "";
                          }

                          echo "</div>
                              </td>";
                        }
                    }      
                 ?>
                <script>
                   /* document.getElementById('declineForm$emp_id').addEventListener('submit', function(event) {
                        var remarks = document.getElementById('la_remarks$emp_id').value;
                        var emp_id = document.getElementById('s_em_id$emp_id').value; // Retrieve emp_id
                        remarks += ' (Employee ID: ' + emp_id + ')'; // Append emp_id to remarks
                        document.getElementById('la_remarks_hidden_$emp_id').value = remarks;
                    });*/
                </script>



                    </table>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-header">
                <h5 class="modal-title" id="editModalLabel"><i class="fas fa-edit"></i>&nbsp;Edit Leave Application</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
              </div>
              <div class="modal-body">
                <form action="update_leave_application.php" method="POST">
                  <input type="hidden" name="la_id" value="<?php echo $emp_id ?>">
                  <!-- Add fields for editing the leave application details -->
                  <div class="mb-3">
                    <label for="edit_lt_code" class="form-label">Leave Type:</label>
                    <input type="text" class="form-control" id="edit_lt_code" name="edit_lt_code" value="<?php echo $r_lt_code ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="edit_date_display" class="form-label">Date:</label>
                    <input type="text" class="form-control" id="edit_date_display" name="edit_date_display" value="<?php echo $date_display ?>" readonly>
                  </div>
                  <div class="mb-3">
                    <label for="edit_la_reason" class="form-label">Reason:</label>
                    <textarea class="form-control" id="edit_la_reason" name="edit_la_reason" rows="3"><?php echo $r_la_reason ?></textarea>
                  </div>
                  <!-- Add additional fields for editing if needed -->
                  <button type="submit" class="btn btn-primary">Save Changes</button>
                </form>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              </div>
            </div>
          </div>
        </div>

       <!-- VIEW MODAL -->
       <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-eye"></i>&nbsp;Leave Application Details</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
              <!-- Content will be dynamically populated here -->
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
          </div>
        </div>
      </div>

      <script>
        $(document).ready(function() {
          $('.view-user-btn').click(function() {
            var empId = $(this).data('emp-id');
            $.ajax({
              url: 'get_leave_application_details.php',
              type: 'GET',
              data: { emp_id: empId },
              success: function(response) {
                $('#viewModalBody').html(response);
              }
            });
          });
        });
      </script>
      <?php
      if (isset($_GET['uid1'])) {
        $uid1  = $_GET['uid1'];
        mysqli_query($conn, "UPDATE `leave_application` SET `la_status`= 1 where `la_id` = $uid1");
      }
      ?>
      </div>
    </div>

