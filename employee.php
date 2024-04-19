<!--Declaration of user session -logout- -->
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
    <title>Dashboard | PINE HR</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="script.js"></script>
    <script src="imoJS.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

    <!--offline bootstrap-->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <script src="js/all.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <!-- Modal Jquery for logging in -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!--Navbar CSS-->
    <link rel="stylesheet" href="css/navbar2.css">

    <!--calendar links-->
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
    <link rel="stylesheet" href="./css/bootstrap.min.css">
    <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
    <script src="./js/jquery-3.6.0.min.js"></script>
    <script src="./js/bootstrap.min.js"></script>
    <script src="./fullcalendar/lib/main.min.js"></script>
    <!--calendar links-->


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

      <div class="dash_sidebar_menus">
        <br>

        <br>

        <?php if ($_SESSION['s_user_id'] == 2) : ?>

        <?php endif; ?>
      </div>

      <div class="dash_content_container" id="dash_content_container">
        <div class="dash_topnav" id="dash_topnav">
          <a href="Dashboard.php">
            <img src="bgimages/pine.png" alt="logo" style="width: 100px;height: 60px;margin-top: -15px; margin-left: -8px">
          </a>

          <!--<a href="" id ="togglebtn"><i class ="fa-solid fa-bars"></i></a>-->
          <h10 style="font-family: 'Glacial Indifference';">&nbsp; Welcome <?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?>! (EMPLOYEE)</h10>

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
                    <a href="Dashboard.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
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

              dash_sidebar.style.width = '20%';
              dash_sidebar.style.height = 'auto';
              dash_content_container.style.width = '100%';
              sideBarIsOpen = true;
            }
          });
        </script>

        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link active" aria-current="page" href="employee.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="employee_profile.php">Profile</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Leave</a>
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

                // Disable the "Application" dropdown item if necessary
                $application_disabled = ($leave_credit_count == 0 || $all_credits_zero) ? 'disabled' : '';

                // Determine the tooltip message
                $tooltip_message = "";
                if ($leave_credit_count == 0) {
                  $tooltip_message = "You have no employee leave credits.";
                } elseif ($all_credits_zero) {
                  $tooltip_message = "All your leave types have zero available credits.";
                }

                // Output the dropdown items with tooltip
                echo '<li data-bs-toggle="tooltip" data-bs-placement="top" title="' . $tooltip_message . '"><a class="dropdown-item ' . $application_disabled . '" href="employee_application.php" >Application</a></li>';
                ?>
                <li><a class="dropdown-item" href="./employee_app_list.php">List</a></li>
              </ul>
            </li>
          </ul>

          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Dashboard</span></strong>
              </strong>
            </div>

            <div class="dash_content">
              <div class="dash_content_main">


                <style>
                  :root {
                    --bs-success-rgb: 71, 222, 152 !important;
                  }

                  html,
                  body {
                    height: 100%;
                    width: 100%;
                    font-family: Apple Chancery, cursive;
                  }

                  .btn-info.text-light:hover,
                  .btn-info.text-light:focus {
                    background: #000;
                  }

                  table,
                  tbody,
                  td,
                  tfoot,
                  th,
                  thead,
                  tr {
                    border-color: #ededed !important;
                    border-style: solid;
                    border-width: 1px !important;
                  }
                </style>


                <form>
                  <br>
                  <div class="">
                    <div class="panel panel-default">
                      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
                        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-calendar-days fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Schedule of events</span></strong>
                      </div>
                    </div>
                  </div>
                </form>
                <div class="container py-12" id="page-container">
                  <div class="row">
                    <div class="col-md-9">
                      <div id="calendar"></div>
                    </div>

                  </div>
                </div>
                <!-- Event Details Modal -->
                <div class="modal fade" tabindex="-1" data-bs-backdrop="static" id="event-details-modal">
                  <div class="modal-dialog modal-dialog-centered">
                    <div class="modal-content rounded-0">
                      <div class="modal-header rounded-0">
                        <h5 class="modal-title">Schedule Details</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body rounded-0">
                        <div class="container-fluid">
                          <dl>
                            <dt class="text-muted">Title</dt>
                            <dd id="title" class="fw-bold fs-4"></dd>
                            <dt class="text-muted">Description</dt>
                            <dd id="description" class=""></dd>
                            <dt class="text-muted">Start</dt>
                            <dd id="start" class=""></dd>
                            <dt class="text-muted">End</dt>
                            <dd id="end" class=""></dd>
                          </dl>
                        </div>
                      </div>
                      <div class="modal-footer rounded-0">
                        <div class="text-end">

                          <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                <!-- Event Details Modal -->

                <?php
                // Query to fetch upcoming schedules
                $currentDateTime = date('Y-m-d H:i:s');
                $query = "SELECT * FROM `schedule_list` WHERE `start_datetime` > '$currentDateTime'";
                $schedules = $conn->query($query);
                $hasUpcomingSchedules = ($schedules && $schedules->num_rows > 0);
                ?>

                <?php
                // Check if the welcome modal has been shown
                $welcomeModalShown = isset($_SESSION['welcome_modal_shown']) && $_SESSION['welcome_modal_shown'];

                // Check if the user is logged in and there are upcoming schedules
                if (isset($_SESSION['s_em_email']) && $hasUpcomingSchedules && !$welcomeModalShown) {
                  // Set the flag to indicate that the welcome modal has been shown
                  $_SESSION['welcome_modal_shown'] = true;
                ?>
                  <!-- Modal for Welcome Message -->
                  <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h5 class="modal-title" id="exampleModalLabel">Welcome <?php echo $_SESSION['s_first_name'] . " " . $_SESSION['s_last_name']; ?>!</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <!-- Add your welcome message or any other content here -->
                          <p>Announcement Upcoming Event!</p>
                          <p>Schedule Details</p>
                          <ul>
                            <!-- Output schedule details here -->
                            <?php
                            // Reset the internal pointer of $schedules to the beginning
                            $schedules->data_seek(0);
                            while ($row = $schedules->fetch_assoc()) {
                              $start_date = date("F d, Y h:i A", strtotime($row['start_datetime']));
                              $end_date = date("F d, Y h:i A", strtotime($row['end_datetime']));
                              echo "<li>Event Title: " . $row['title'] . "</li>";
                              echo "Start Date: " . $start_date . "<br>End Date: " . $end_date;
                            }
                            ?>
                          </ul>
                        </div>
                      </div>
                    </div>
                  </div>
                  <!-- End of Modal for Welcome Message -->
                <?php } ?>





                <?php
                // Opening PHP tag
                $schedules = $conn->query("SELECT * FROM `schedule_list`");
                $sched_res = [];
                foreach ($schedules->fetch_all(MYSQLI_ASSOC) as $row) {
                  $row['sdate'] = date("F d, Y h:i A", strtotime($row['start_datetime']));
                  $row['edate'] = date("F d, Y h:i A", strtotime($row['end_datetime']));
                  $sched_res[$row['id']] = $row;
                }
                if (isset($conn)) $conn->close();
                ?>
                <!-- Move script tags here -->
                <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
                <script>
                  var scheds = <?= json_encode($sched_res) ?>;
                </script>
                <script src="./js/script.js"></script>


                <!--cont LOGOUT Session -- -->
              <?php
            } else {
              header("location: login.php");
              exit();
            }
              ?>
              <!-- end of LOGOUT Session -->
              <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

              <script>
                var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
                var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
                  return new bootstrap.Tooltip(tooltipTriggerEl)
                })
              </script>

              <script>
                $(document).ready(function() {
                  // Show the welcome modal when the page loads
                  $('#welcomeModal').modal('show');

                  // Check the state of the checkbox and set the session variable accordingly
                  $('#showWelcomeModalCheckbox').change(function() {
                    if ($(this).is(":checked")) {
                      // Checkbox is checked, set session variable to true
                      <?php $_SESSION['show_welcome_modal'] = true; ?>
                    } else {
                      // Checkbox is unchecked, set session variable to false
                      <?php $_SESSION['show_welcome_modal'] = false; ?>
                    }
                  });
                });
              </script>

  </body>

  </html>
  <!--cont logout session-->