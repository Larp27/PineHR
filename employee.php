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
  <link rel="icon" type="image/png" href="./bgimages/img_tab.png">

  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/employee.css">

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.min.js" integrity="sha384-0pUGZvbkm6XF6gxjEnlmuGrJXVbNuzT9qBBavbLwCsOGabYfZo0T0to5eqruptLy" crossorigin="anonymous"></script>

  <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

  <!--offline bootstrap-->
  <script src="js/bootstrap.min.js"></script>

  <!-- Modal Jquery for logging in -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!--Navbar CSS-->
  <link rel="stylesheet" href="css/navbar.css">

  <!--calendar links-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
  <script src="./fullcalendar/lib/main.min.js"></script>
  <script src="./js/script.js"></script>
</head>

<style>
  .nav-tabs.nav-sm>li.nav-item>a.nav-link {
    padding: 0.25rem 0.5rem;
    font-size: 0.9rem;
  }

  .nav-tabs.nav-sm>li.nav-item {
    margin-bottom: 0;
  }

  table,
  tbody,
  td,
  tfoot,
  th,
  thead,
  tr {
    border-color: #2468a0 !important;
    border-style: solid;
    border-width: 1px !important;
  }

  #calendar {
    background-color: rgb(255, 251, 196) !important;
    height: 600px;
    border: 2px solid #2468a0;
    border-radius: 5px;
  }

  th {
    background-color: rgb(235, 220, 10);
  }

  .dashboard-card {
    height: 130px;
  }

  @media (min-width: 768px) and (max-width: 1198px) {
    .dashboard-card h5 {
      text-align: center;
      font-size: 16px !important;
    }
  }
</style>
<body>
  <?php
  if ($_SESSION['s_user_id'] == 1) {
    $query = "select * from user_type";

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
        <div class="row">
          <div class="col-auto">
            <a href="Dashboard.php">
              <img src="bgimages/pine.png" alt="logo" style="width: 100px; margin-top: -20px; margin-left: -8px; margin-bottom: -20px;">
            </a>
          </div>
          <div class="col text-end">
            <div class="dropdown" style="cursor: pointer;">
              <a class="dropdown-toggle bg-transparent border-0 index-nav-label fw-bold text-white text-uppercase user-account" style="text-decoration: none;" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                <?php
                  if (isset($_SESSION['em_profile_pic'])) {
                    $imageSource = '';
                    if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                      $imageSource = '../PINEHR/' . substr($_SESSION['em_profile_pic'], 3);
                    } else {
                      $imageSource = '../pinesolutions.com/' . substr($_SESSION['em_profile_pic'], 3);
                    }
                    echo "<img src='" . $imageSource . " 'style='width:60px; height:60px; border-radius: 50%;' alt='Profile Picture'>";
                  } else {
                    echo "<img src='../uploads/default_profile_pic.png' style='style='width:60px; height:60px; border-radius: 50%;' alt='default profile pic'>";
                  }
                ?>
                <?php 
                  $query = "SELECT * FROM employee WHERE em_id = $_SESSION[s_em_id]";
                  $result = mysqli_query($conn, $query);

                  while ($row = mysqli_fetch_assoc($result)) {
                    echo '<span class="fw-bold" style="font-size: 16px;">' . $row['first_name'] . ' ' . $row['last_name'] . '</span>';
                  }
                ?>
              </a>
              <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                <li><a class="dropdown-item fw-bold <?php echo (basename($_SERVER['PHP_SELF']) == 'manage_account.php') ? 'active' : ''; ?>" href="user_manage_account.php">Manage Account</a></li>
                  <li><a class="dropdown-item fw-bold" href="logout.php" data-bs-toggle="modal" data-bs-target="#exampleModal">Logout</a></li>
              </ul>
            </div>
          </div>
        </div>
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
            <a class="nav-link active fw-bold" aria-current="page" href="employee.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="employee_profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" aria-current="page" href="employee_certificate.php">Certificates</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link fw-bold dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Leave</a>
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
              <li><a class="dropdown-item fw-bold" href="./employee_app_list.php">List</a></li>
            </ul>
          </li>
        </ul>
        <div class="row">
          <div class="col-md-12">
            <div class="border border-light border-top-1 p-0 bg-white">
              <div class="d-flex" style="box-shadow: 0 2px 6px -1px #00213b; height: 50px;">
                <i class="fa-solid fa-house fa-lg mt-4 me-2 ps-2" style="color: #2468a0;"></i>
                <p class="fs-6 fw-bold mt-3 text-uppercase">Dashboard</p>
              </div>
            </div>
            <div class="row mx-auto">
              <div class="col-md-12 mt-4">
                <div class="row gap-5">
                  <div class="col-md-1"></div>
                  <div class="col-md-3">
                    <a href="employee_app_list.php?status=Pending" class="text-decoration-none">
                      <div class="p-3 dashboard-card" style="box-shadow: 2px 6px 12px #2468a0; background-color:#c1e8ff;">
                        <h1>
                          <?php
                          if (isset($_SESSION['s_em_id'])) {
                            $em_id = $_SESSION['s_em_id'];
                            $count_query = "SELECT COUNT(*) as ls_status FROM leave_application WHERE la_status = 'Pending' AND em_id = $em_id";
                            $count_query_run = mysqli_query($conn, $count_query);
                            if ($count_query_run) {
                              $row = mysqli_fetch_assoc($count_query_run);
                              $count_total = $row['ls_status'];
                              echo '<h1 class="text-end">' . $count_total . '</h1>';
                            } else {
                              echo '<h1 class="text-end">0</h1>';
                            }
                          }
                          ?>
                        </h1>
                        <div class="d-flex mt-2">
                          <i class="fa-solid fa-hourglass-half fa-xl me-1 mt-3 text-dark"></i>
                          <h5 class="fs-5 fw-bold mt-1 text-center text-md-start">Pending Leave Application </h5>
                        </div>
                    </a>
                  </div>
                </div>
                <div class="col-md-3">
                  <a href="employee_app_list.php?status=Accepted" class="text-decoration-none">
                    <div class="p-3 dashboard-card" style="box-shadow: 2px 6px 12px #2468a0; background-color:#c1e8ff;">
                      <h1>
                        <?php
                        if (isset($_SESSION['s_em_id'])) {
                          $em_id = $_SESSION['s_em_id'];
                          $count_query = "SELECT COUNT(*) as ls_status FROM leave_application WHERE la_status = 'Accepted' AND em_id = $em_id";
                          $count_query_run = mysqli_query($conn, $count_query);
                          if ($count_query_run) {
                            $row = mysqli_fetch_assoc($count_query_run);
                            $count_total = $row['ls_status'];
                            echo '<h1 class="text-end">' . $count_total . '</h1>';
                          } else {
                            echo '<h1 class="text-end">0</h1>';
                          }
                        }
                        ?>
                      </h1>
                    <div class="d-flex mt-3">
                      <i class="fa-solid fa-thumbs-up fa-xl me-1 mt-3 text-dark"></i>
                      <h5 class="fs-5 fw-bold mt-1 text-center text-md-start">Accepted Leave Application </h5>
                    </div>
                  </a>
                </div>
              </div>
              <div class="col-md-3">
                <a href="employee_app_list.php?status=Declined" class="text-decoration-none">
                  <div class="p-3 dashboard-card" style="box-shadow: 2px 6px 12px #2468a0; background-color:#c1e8ff;">
                    <h1>
                      <?php
                      if (isset($_SESSION['s_em_id'])) {
                        $em_id = $_SESSION['s_em_id'];
                        $count_query = "SELECT COUNT(*) as ls_status FROM leave_application WHERE la_status = 'Declined' AND em_id = $em_id";
                        $count_query_run = mysqli_query($conn, $count_query);
                        if ($count_query_run) {
                          $row = mysqli_fetch_assoc($count_query_run);
                          $count_total = $row['ls_status'];
                          echo '<h1 class="text-end">' . $count_total . '</h1>';
                        } else {
                          echo '<h1 class="text-end">0</h1>';
                        }
                      }
                      ?>
                    </h1>
                    <div class="d-flex mt-3">
                      <i class="fa-solid fa-thumbs-down fa-xl me-1 mt-3 text-dark"></i>
                      <h5 class="fs-5 fw-bold mt-1 text-center text-md-start">Declined Leave Application </h5>
                    </div>
                </a>
              </div>
            </div>
            <div class="col-md-2"></div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="col-md-12">
      <div class="border border-light border-top-1 p-0 bg-white">
        <div class="d-flex" style="box-shadow: 0 2px 6px -1px #00213b; height: 50px;">
          <i class="fa-solid fa-calendar-days fa-lg mt-4 me-2 ps-2" style="color: #2468a0;"></i>
          <p class="fs-6 fw-bold mt-3 text-uppercase">Schedule of Events</p>
        </div>
      </div>
      <div class="container py-12" id="page-container">
        <div class="row">
          <div class="col-md-12 mt-4">
            <div class="calendar-container" style="height: 70vh;">
              <div id="calendar" style="background-color: aquawhite;"></div>
            </div>
          </div>
        </div>
      </div>
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
      <?php
        $currentDateTime = date('Y-m-d H:i:s');
        $query = "SELECT * FROM `schedule_list` WHERE `start_datetime` > '$currentDateTime'";
        $schedules = $conn->query($query);
        $hasUpcomingSchedules = ($schedules && $schedules->num_rows > 0);
      ?>
      <?php if (isset($_SESSION['s_em_email']) && $hasUpcomingSchedules) : ?>
        <div class="modal fade" id="welcomeModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
          <div class="modal-dialog modal-dialog-centered">
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
      <?php endif; ?>
    </div>
  </div>
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

<?php
  } else {
    header("location: login.php");
    exit();
  }
?>
</body>
</html>
<script>
  var scheds = <?= json_encode($sched_res) ?>;

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });
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