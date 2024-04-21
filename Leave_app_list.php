<?php
session_start();
include "DBConnection.php";
if (isset($_SESSION['s_em_email'])) {
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Leave Type List| PINE HR</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <!-- <link rel="stylesheet" href="css/main.css"> -->

  <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

  <script src="script.js"></script>
  <script src="imoJS.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

  <link rel="stylesheet" href="dashboard2.css" />
  <link rel="stylesheet" text="text/css" href="" />


  <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

  <!--Department Process Add and Update JS-->
  <script src="Department/DepartmentJS.js"></script>
  <script src="Department/updateDEPT.js"></script>

  <!--offline bootstrap-->
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <script src="js/all.js"></script>
  <script src="js/bootstrap.min.js"></script>

  <!--Navbar CSS-->
  <link rel="stylesheet" href="css/navbar2.css">
  <link rel="stylesheet" href="css/employee.css">

  <script src="./script.js"></script>
</head>
<style>
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

  <body>

    <!--LOGOUT -- getting user role to display specific features and function -->
    <?php
    if ($_SESSION['s_user_id'] == 1) {
      $query = "select * from user_type";

      $result = mysqli_query($conn, $query);
    }

    ?>
    <!-- cont LOGOUT Session  -- -->
    <div id="dashmaincontainer">
      <div class="dash_sidebar" id="dash_sidebar">
        <div class="dash_sidebar_menus">
          <br>
          <center><a href="Dashboard.php">
              <img src="bgimages/pine.png" alt="logo" style="width: 150px;height: 135px;margin-top: -15px; margin-left: -8px">
            </a>
          </center>
          <br>
          <nav class="sidebar">
            <ul>
              <li><a href="Dashboard.php" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-gauge fa-spin fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
              <li>
                <a href="#" class="org-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-landmark fa-2xl" style="color: #2468a0; "></i>&nbsp;&nbsp;&nbsp;&nbsp;Organization
                  <span class="fas fa-caret-down first"></span>
                </a>
                <ul class="org-show">
                  <li><a href="Department_list.php" style="font-family: 'Glacial Indifference';">Department</a></li>
                  <li><a href="Designation_list.php" style="font-family: 'Glacial Indifference';">Designation</a></li>
                </ul>
              </li>
              <li>
                <a href="#" class="pro-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-address-card fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;PROFILING
                  <span class="fas fa-caret-down sixth"></span>
                </a>
                <ul class="pro-show">
                  <li><i class="fa-solid fa-graduation-cap fa-sm" style="color: #2468a0;"><a href="Education.php" style="font-family: 'Glacial Indifference';">Educational Attainment</a></i></li>
                  <li><i class="fa-solid fa-droplet fa-sm" style="color: #2468a0;"><a href="BloodType.php" style="font-family: 'Glacial Indifference';">Blood Type</a></i></li>
                  <li><i class="fa-solid fa-location-dot fa-sm" style="color: #2468a0;"><a href="Address.php" style="font-family: 'Glacial Indifference';">Address</a></i></li>
                  <li><i class="fa-solid fa-briefcase fa-sm" style="color: #2468a0;"><a href="EmploymentStatus.php" style="font-family: 'Glacial Indifference';">Employment Status</a></i></li>
                  <li><i class="fa-solid fa-hands-praying fa-sm" style="color: #2468a0;"><a href="Religion.php" style="font-family: 'Glacial Indifference';">Religion</a></i></li>
                  <li><i class="fa-solid fa-people-roof fa-sm" style="color: #2468a0;"><a href="MaritalStatus.php" style="font-family: 'Glacial Indifference';">Marital Status</a></i></li>
                </ul>
              </li>
              <li>
                <a href="#" class="emp-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Employees
                  <span class="fas fa-caret-down third"></span>
                </a>
                <ul class="emp-show">
                  <li><a href="em_list.php" style="font-family: 'Glacial Indifference';">Employee List</a></li>
                  <li><a href="em_add.php" style="font-family: 'Glacial Indifference';">Add Employee</a></li>
                </ul>
              </li>
              <li class="active">
                <a href="#" class="lev-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-user-large-slash fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;LEAVE
                  <span class="fas fa-caret-down fourth"></span>
                </a>
                <ul class="lev-show">
                  <li><a href="Leave_type_list.php" style="font-family: 'Glacial Indifference';">Leave Type List</a></li>
                  <li><a href="Leave_app_list.php" style="font-family: 'Glacial Indifference';">Application List</a></li>
                </ul>
              </li>
              <li>
                <a href="attendance_list.php" style="font-family: 'Glacial Indifference';">&nbsp;<i class="fa-solid fa-calendar-days fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;ATTENDANCE
                </a>
              </li>
              <li>
                <a href="Payroll_list.php" style="font-family: 'Glacial Indifference';">&nbsp;<i class=" fa-solid fa-money-check-dollar fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;PAYROLL
                </a>
              </li>
              <li>
                <a href="#" class="rep-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-rectangle-list fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;REPORTS
                  <span class="fas fa-caret-down second"></span>
                </a>
                <ul class="rep-show">
                  <li><a href="Reports_att.php" style="font-family: 'Glacial Indifference';">Attendance Reports</a></li>
                  <li><a href="Reports_payroll.php" style="font-family: 'Glacial Indifference';">Payroll Reports</a></li>
                </ul>
              </li>
            </ul>
          </nav>

        </div>
      </div>
      <div class="dash_content_container" id="dash_content_container">
        <div class="dash_topnav" id="dash_topnav">
          <!--<a href="" id ="togglebtn"><i class ="fa-solid fa-bars"></i></a>-->
          <h10 style="font-family: 'Glacial Indifference';">&nbsp; Welcome <?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?>!</h10>

          <a href="logout.php" id="lougoutbtn" style="font-family: 'Glacial Indiffernce'; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-duotone fa-arrow-right-from-bracket"></i>&nbsp; Logout</a>
        </div>

        <!--Modal for logout-->
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
                    <a href="Leave_app_list.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
                    <a href="logout.php"><button type="button" class="btn btn-primary" name="btnSave2" id="btnSave2">Yes</button></a>
                  </div>
                </form>
              </div>
            </div>
          </div>
        </div>
        <!--End of modal logout-->


        <script>
          var sideBarIsOpen = true;

          togglebtn.addEventListener('click', (event) => {
            event.preventDefault();

            if (sideBarIsOpen) {
              dash_sidebar.style.width = '0%';
              dash_sidebar.style.transition = '0.3s all';
              dash_content_container.style.width = '100%';
              sideBarIsOpen = false;
            } else {

              dash_sidebar.style.width = '15%';
              dash_sidebar.style.height = 'auto';
              dash_content_container.style.width = '100%';
              sideBarIsOpen = true;
            }
          });
        </script>
        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
              <strong>
                &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Type of Leave</span></strong>
              </strong>
            </div><br>


            <div class="col-md-7" style="width: 100%">
              <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
                <div class="panel-heading">
                  <strong>
                    &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Leave Application List</span></strong>
                  </strong>

                  <?php if ($_SESSION['s_user_id'] == 1) {
                    $query = "select * from user_type";

                    $result = mysqli_query($conn, $query);
                  } {
                    echo '<a href="Leave_app_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Leave Application +</button> </a>';
                  }
                  ?>
                </div>

                <div class="dash_content">
                  <div class="dash_content_main">
                    <table class="table" id="example">
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
                        $r_la_reason = $row['la_reason']; // Define $r_la_reason here


                        // Check if start and end dates are in the same month and year
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

                        $final = "<tr> 
                    <td class='text-center'>$r_last_name, $r_first_name</td>
                    <td class='text-center'>[$r_lt_code] - $r_lt_name</td>
                    <td class='text-center'>$date_display</td>
                    <td class='text-center'><span class='badge $status_color'>$r_lt_status</span></td>";
                        echo $final;

                        // Show dropdown menu for Accept, Decline, Cancel, and View based on the status
                        if ($r_lt_status == 'Pending') {
                          $em_id = $_SESSION['s_em_id'];
                          echo "<td class='text-center'>
                <div class='col-auto d-flex justify-content-center m-2'>
                  <div class='dropdown'>
                    <button class='btn btn-secondary dropdown-toggle' type='button' id='dropdownMenuButton' data-bs-toggle='dropdown' aria-expanded='false'>
                      Actions
                    </button>
                    <ul class='dropdown-menu' aria-labelledby='dropdownMenuButton'>
                      <li><form action='update_leave_status.php' method='POST'>
                            <input type='hidden' name='la_id' value='$emp_id'>
                            <input type='hidden' name='s_em_id' value='$em_id'>
                            <input type='hidden' name='lt_id' value='$lt_id'>
                            <input type='hidden' name='lt_status' value='Accepted'>
                            <button type='submit' name='accept' class='dropdown-item btn btn-success btn-sm'><i class='fas fa-check'></i> Accept</button>
                          </form></li>
                      <li><form action='update_leave_status.php' method='POST'>
                            <input type='hidden' name='la_id' value='$emp_id'>
                            <input type='hidden' name='s_em_id' value='$em_id'>
                            <input type='hidden' name='lt_id' value='$lt_id'>
                            <input type='hidden' name='lt_status' value='Declined'>
                            <button type='submit' name='decline' class='dropdown-item btn btn-danger btn-sm'><i class='fas fa-times'></i> Decline</button>
                          </form></li>
                      <li><form action='update_leave_status.php' method='POST'>
                            <input type='hidden' name='la_id' value='$emp_id'>
                            <input type='hidden' name='s_em_id' value='$em_id'>
                            <input type='hidden' name='lt_id' value='$lt_id'>
                            <input type='hidden' name='lt_status' value='Cancelled'>
                            <button type='submit' name='cancel' class='dropdown-item btn btn-warning btn-sm'><i class='fas fa-ban'></i> Cancel</button>
                          </form></li>
                      <li><a class='dropdown-item btn btn-primary btn-sm' href='#' data-bs-toggle='modal' data-bs-target='#viewModal'><i class='fas fa-eye'></i> View</a></li>
                    </ul>
                  </div>
                </div>
              </td>";
                        } else {
                          echo "<td class='text-center'>
                          <div class='col-auto d-flex justify-content-center m-2 align-items-center'>
                              <button type='button' class='py-1 px-2 me-1 btn btn-primary btn-sm update-user-btn' data-bs-toggle='modal' data-bs-target='#viewModal'><i class='fas fa-eye'></i> View</button>";

                          if ($r_lt_status != 'Pending') {
                            echo "
                                <a href='Leave_application/deleteLA.php?la_id=$emp_id' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this Leave Application?\")'><i class='fas fa-trash'></i> Delete</a>";
                          } else {
                            echo "";
                          }

                          echo "</div>
                            </td>";
                        }
                      }
                      ?>


                      <!-- Bootstrap modal structure EDIT -->
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




                      <!-- Bootstrap modal structure VIEW -->
                      <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                          <div class="modal-content">
                            <div class="modal-header">
                              <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-eye"></i>&nbsp;Leave Application Details</h5>

                              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                              <p><strong>Employee Name:</strong> <?php echo $r_last_name ?>, <?php echo $r_first_name ?></p>
                              <p><strong>Leave Type:</strong> [<?php echo $r_lt_code ?>] - <?php echo $r_lt_name ?></p>
                              <p><strong>Date:</strong> <?php echo $date_display ?></p>
                              <p><strong>Reason:</strong> <?php echo $r_la_reason ?></p>
                            </div>
                            <div class="modal-footer">
                              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            </div>
                          </div>
                        </div>
                      </div>



                      <!-- JavaScript to handle modal population -->
                      <script>
                        // Function to populate the view modal with leave application data
                        function populateViewModal(employeeName, leaveType, leaveDate, leaveStatus) {
                          document.getElementById("view_employee_name").innerText = employeeName;
                          document.getElementById("view_leave_type").innerText = leaveType;
                          document.getElementById("view_leave_date").innerText = leaveDate;
                          document.getElementById("view_leave_reason").innerText = leaveReason;
                        }

                        // Event listener for view button click
                        document.querySelectorAll('.view-button').forEach(item => {
                          item.addEventListener('click', event => {
                            // Extract leave application data from the row
                            const row = event.target.closest('tr');
                            const employeeName = row.cells[0].innerText;
                            const leaveType = row.cells[1].innerText;
                            const leaveDate = row.cells[2].innerText;
                            const leaveReason = row.cells[3].innerText;

                            // Populate the view modal with the extracted data
                            populateViewModal(employeeName, leaveType, leaveDate, leaveReasons);

                            // Show the view modal
                            const viewModal = new bootstrap.Modal(document.getElementById('viewModal'));
                            viewModal.show();
                          });
                        });
                      </script>

                      <!--cont LOGOUT Session -- -->
                    <?php
                    if (isset($_GET['uid1'])) {
                      $uid1  = $_GET['uid1'];
                      mysqli_query($conn, "UPDATE `leave_application` SET `la_status`= 1 where `la_id` = $uid1");
                    }
                  } else {
                    header("location: login.php");
                    exit();
                  }
                    ?>
                    <!-- end of LOGOUT Session -->

                    <script>
                      var updateUserModal = document.getElementById('updateUserModal');
                      updateUserModal.addEventListener('show.bs.modal', function(event) {
                        var button = event.relatedTarget; // Button that triggered the modal
                        var dep_id = button.getAttribute('data-dep-id'); // Extract info from data-* attributes
                        var dep_name = button.getAttribute('data-dep-name'); // Extract info from data-* attributes

                        var modalBody = updateUserModal.querySelector('.modal-body');
                        modalBody.querySelector('#dep_id').value = dep_id;
                        modalBody.querySelector('#dep_name').value = dep_name;

                      })
                    </script>

                    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>


                    <!--Javascript Dashboard-->

                    <script>
                      $('.sidebar-btn').click(function() {
                        $(this).toggleClass("click");
                        $('.sidebar').toggleClass("show");
                        if ($('.sidebar').hasClass("show")) {
                          $('.sidebar').removeClass("hide");
                          $(this).removeClass("click");
                        } else {
                          $('.sidebar').addClass("hide");
                          $(this).addClass("click");
                        }
                      });


                      $('.org-btn').click(function() {
                        $('nav ul .org-show').toggleClass("show1");
                        $('nav ul .first').toggleClass("rotate");
                      });

                      $('.rep-btn').click(function() {
                        $('nav ul .rep-show').toggleClass("show2");
                        $('nav ul .second').toggleClass("rotate");
                      });

                      $('.emp-btn').click(function() {
                        $('nav ul .emp-show').toggleClass("show3");
                        $('nav ul .third').toggleClass("rotate");
                      });

                      $('.lev-btn').click(function() {
                        $('nav ul .lev-show').toggleClass("show4");
                        $('nav ul .fourth').toggleClass("rotate");
                      });

                      $('.not-btn').click(function() {
                        $('nav ul .not-show').toggleClass("show5");
                        $('nav ul .fifth').toggleClass("rotate");
                      });

                      $('.pro-btn').click(function() {
                        $('nav ul .pro-show').toggleClass("show6");
                        $('nav ul .sixth').toggleClass("rotate");
                      });

                      $('nav ul li').click(function() {
                        $(this).addClass("active").siblings().removeClass("active");
                      });
                    </script>
  </body>

  </html>