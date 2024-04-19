<?php
session_start();
include "DBConnection.php";
if (isset($_SESSION['s_em_email'])) {
?>
  <!--cont logout session-->

  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <title>Leave Type List| PINE HR</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

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
    <link rel="stylesheet" href="css/navbar.css">

    <script src="./script.js"></script>


  </head>

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

              <!--Declaration of user session -logout- -->
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

              // Disable the "Application" dropdown item if necessary
              $application_disabled = ($leave_credit_count == 0 || $all_credits_zero) ? 'disabled' : '';

              // Determine the tooltip message
              $tooltip_message = "";
              if ($leave_credit_count == 0) {
                $tooltip_message = "You have no employee leave credits.";
              } elseif ($all_credits_zero) {
                $tooltip_message = "All your leave types have zero available credits.";
              }
              ?>
              <!-- end Declaration of user session -logout- -->

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

        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
              <strong>
                &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Application List</span></strong>
              </strong>
            </div><br>

            <div class="row">
              <div class="col-md-5">
                <div class="panel panel-default" style="margin-left: 20px; width: 95%; box-shadow: 3px 5px 8px #2468a0;">
                  <div class="panel-heading">
                    <strong>
                      &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add Application</span></strong>
                    </strong>
                  </div>

                  <div class="panel-body">
                    <form id="leaveForm" class="form m-3" action="save_leave_application1.php" method="post">
                      <div class="mb-3">
                        <label for="imId" class="form-label fw-bold">Employee ID & Name</label>
                        <select class="form-select" id="imId" name="imId" required>
                          <option value="">Select Employee Here</option>
                          <?php
                          $query = "SELECT em_id, first_name, last_name FROM employee";
                          $result = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row["em_id"] . '">' . $row["em_id"] . ' - ' . $row["first_name"] . ' ' . $row["last_name"] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="leave" class="form-label fw-bold">Type of Leave</label>
                        <select name="leave" class="form-select" aria-label="Default select example" required>
                          <option class="fw-bold" selected disabled>Select a Leave</option>
                          <?php
                          // Query to select leave types based on employee's leave credits
                          $em_id = $_SESSION['s_em_id'];
                          $query = "SELECT lt.lt_id, lt.lt_name, ec.available_credits FROM leave_type lt
                          INNER JOIN employee_leave_credits ec ON lt.lt_id = ec.lt_id
                          WHERE ec.em_id = $em_id";
                          $result = mysqli_query($conn, $query);

                          // Loop through the result and populate dropdown options
                          while ($row = mysqli_fetch_assoc($result)) {
                            // Determine if the option should be disabled
                            $disabled = ($row['available_credits'] == 0) ? 'disabled' : '';

                            // Output option with disabled attributes
                            echo '<option class="m-3" value="' . $row["lt_id"] . '" ' . $disabled . ' >' . $row["lt_name"] . '</option>';
                          }
                          ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="leave_reason" class="form-label fw-bold">Leave Reason</label>
                        <textarea name="reason" cols="30" placeholder="State your Reason" rows="5" class="form-control" required></textarea>
                      </div>
                      <div class="mb-3">
                        <label for="st_day" class="form-label fw-bold">Starting Day</label>
                        <input type="date" class="form-control" name="st_day" required>
                      </div>
                      <div class="mb-3">
                        <label for="end_day" class="form-label fw-bold">Ending Day</label>
                        <input type="date" class="form-control" name="end_day" required>
                      </div>
                      <div class="mb-3 text-end">
                        <a href="Leave_app_list.php"> <button type="submit" id="submitLeave" class="btn btn-primary">ADD</button> </a>
                      </div>
                    </form>
                  </div>


                <?php

                /* Ang query */

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
                <script>
                  $(document).ready(function() {
                    $('#leaveForm').submit(function(e) {
                      e.preventDefault();
                      var formData = $(this).serialize();

                      $.ajax({
                        type: 'POST',
                        url: $(this).attr('action'),
                        data: formData,
                        dataType: 'json',
                        success: function(response) {
                          if (response.status === "success") {
                            // Show modal
                            $('#successModal').modal('show');
                          } else {
                            alert('An error occurred while submitting the leave application. Please try again.');
                          }
                        },
                        error: function(xhr, status, error) {
                          console.error(xhr.responseText);
                          alert('An error occurred while submitting the leave application. Please try again.');
                        }
                      });
                    });
                  });
                </script>

                <!-- Success Modal -->
                <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title" id="successModalLabel">Leave Application Submitted Successfully</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        Your leave application has been submitted successfully.
                      </div>
                      <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <!-- Redirect button -->
                        <a href="Leave_app_list.php" class="btn btn-primary">Go to Leave Application List</a>
                      </div>
                    </div>
                  </div>
                </div>

  </body>

  </html>