<?php
$title = 'Dashboard';
$page = 'dashboard';
include_once('./main.php');

// Check if the welcome modal has been shown before
if (!isset($_SESSION['show_welcome_modal'])) {
  // Set the session variable to true to indicate that the modal has not been shown
  $_SESSION['show_welcome_modal'] = true;
}
?>
<!--cont logout session-->
<?php
if (isset($_SESSION['s_em_email']) && $_SESSION['show_welcome_modal']) {
    // Query to fetch upcoming schedules
    $currentDateTime = date('Y-m-d H:i:s');
    $query = "SELECT * FROM `schedule_list` WHERE `start_datetime` > '$currentDateTime'";
    $schedules = $conn->query($query);

    // Check if there are any upcoming schedules
    if ($schedules && $schedules->num_rows > 0) {
        // Display the welcome modal only if there are upcoming schedules
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
                            <?php
                            // Display the schedule details
                            while ($row = $schedules->fetch_assoc()) {
                                $start_date = date("F d, Y h:i A", strtotime($row['start_datetime']));
                                $end_date = date("F d, Y h:i A", strtotime($row['end_datetime']));
                                echo "<li>Event: " . $row['title'] . "</li>";
                                echo "Start Date: " . $start_date . "<br>End Date: " . $end_date;
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
        <!-- End of Modal for Welcome Message -->

        <script>
            $(document).ready(function() {
                $('#welcomeModal').modal('show');
                <?php
                // Reset the session variable to false to prevent the modal from appearing again
                $_SESSION['show_welcome_modal'] = false;
                ?>
            });
        </script>
<?php
    }
}
?>

<!--calendar links-->
<link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
<link rel="stylesheet" href="./css/bootstrap.min.css">
<link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
<script src="./js/jquery-3.6.0.min.js"></script>
<script src="./js/bootstrap.min.js"></script>
<script src="./fullcalendar/lib/main.min.js"></script>
<!--calendar links-->

<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          <span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>Dashboard</span></strong>
        </strong>
      </div>
      <div class="dash_content_main">
        <?php if ($_SESSION['s_user_id'] == 1) : ?>
          <!--1st Card-->
          <div class="cards">
            <div class="row ms-5">
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="Leave_type_list.php">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $lt_query = "SELECT * from leave_type";
                        $lt_query_run = mysqli_query($conn, $lt_query);

                        if ($lt_total = mysqli_num_rows($lt_query_run)) {
                          echo '<h1 class="card-number">' . $lt_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fas fa-pen-square"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Leave Type</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--2nd Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="Leave_app_list.php">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $dep_query = "SELECT * from leave_application";
                        $dep_query_run = mysqli_query($conn, $dep_query);

                        if ($dep_total = mysqli_num_rows($dep_query_run)) {
                          echo '<h1 class="card-number">' . $dep_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Leave Application</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--3rd Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="Department_list.php" class="card-link">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $dep_query = "SELECT * from department";
                        $dep_query_run = mysqli_query($conn, $dep_query);

                        if ($dep_total = mysqli_num_rows($dep_query_run)) {
                          echo '<h1 class="card-number">' . $dep_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa-solid fa-user-tie"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Department</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--4th Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="Designation_list.php">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $des_query = "SELECT * from designation";
                        $des_query_run = mysqli_query($conn, $des_query);

                        if ($des_total = mysqli_num_rows($des_query_run)) {
                          echo '<h1 class="card-number">' . $des_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Designation</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--5th Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="Leave_type_list.php" class="card-link align-horizontal">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $app_query = "SELECT COUNT(*) as ls_status FROM leave_application WHERE la_status = 1";
                        $app_query_run = mysqli_query($conn, $app_query);

                        if ($app_query_run) {
                          $row = mysqli_fetch_assoc($app_query_run);
                          $app_total = $row['ls_status'];
                          echo '<h1 class="card-number">' . $app_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa-solid fa-thumbs-up"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Approved Leave Application</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--6th Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="Leave_type_list.php" class="card-link align-horizontal">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $dec_query = "SELECT COUNT(*) as ls_status FROM leave_application WHERE la_status != 1";
                        $dec_query_run = mysqli_query($conn, $dec_query);

                        if ($dec_query_run) {
                          $row = mysqli_fetch_assoc($dec_query_run);
                          $dec_total = $row['ls_status'];
                          echo '<h1 class="card-number">' . $dec_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa-solid fa-hourglass-half"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Pending Leave Application</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--7th Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="" class="card-link align-horizontal">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        // Your PHP code here
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa-solid fa-thumbs-down"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Declined Leave Application</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>

              <!--8th Card-->
              <div class="col-md-3 col-sm-6 mb-4">
                <a href="em_list.php">
                  <div class="card-box">
                    <div>
                      <h1>
                        <?php
                        $em_query = "SELECT COUNT(*) as em_id FROM employee";
                        $em_query_run = mysqli_query($conn, $em_query);

                        if ($em_query_run) {
                          $row = mysqli_fetch_assoc($em_query_run);
                          $em_total = $row['em_id'];
                          echo '<h1 class="card-number">' . $em_total . '</h1>';
                        } else {
                          echo '<h1 class="card-number">0</h1>';
                        }
                        ?>
                      </h1><br>
                      <div class="icon-label">
                        <i class="fa fa-light fa-users"></i>
                        <h5><strong style="font-family: 'Glacial Indifference'">Total Employees</strong></h5>
                      </div>
                    </div>
                  </div>
                </a>
              </div>
            </div>
          </div>
      </div>
    </div>
  </div>
</form>
<?php endif; ?>

<style>
  :root {
    --bs-success-rgb: 71, 222, 152 !important;
  }

  html,
  body {
    height: 100%;
    width: 100%;
    font-family: Apple Chancery, cursive;
    text-decoration: none;
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
        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-calendar-days fa-2xl" style="color: #2468a0;"></i>&nbsp;Announcement</span></strong>
      </div>
    </div>
  </div>
</form>
<div class="container py-12" id="page-container">
  <div class="row">
    <div class="col-md-9">
      <div id="calendar"></div>
    </div>
    <div class="col-md-3">
      <div class="cardt rounded-0 shadow">
        <div class="card-header bg-gradient bg-primary text-light">
          <h5 class="card-title">Schedule Form</h5>
        </div>
        <div class="card-body">
          <div class="container-fluid">
            <form action="save_schedule.php" method="post" id="schedule-form">
              <input type="hidden" name="id" value="">
              <div class="form-group mb-2">
                <label for="title" class="control-label">Title</label>
                <input type="text" class="form-control form-control-sm rounded-0" name="title" id="title" required>
              </div>
              <div class="form-group mb-2">
                <label for="description" class="control-label">Description</label>
                <textarea rows="3" class="form-control form-control-sm rounded-0" name="description" id="description" required></textarea>
              </div>
              <div class="form-group mb-2">
                <label for="start_datetime" class="control-label">Start</label>
                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="start_datetime" id="start_datetime" required>
              </div>
              <div class="form-group mb-2">
                <label for="end_datetime" class="control-label">End</label>
                <input type="datetime-local" class="form-control form-control-sm rounded-0" name="end_datetime" id="end_datetime" required>
              </div>
              <div class="card-footer">
                <div class="text-center">
                  <button class="btn btn-primary btn-sm rounded-0" type="submit" form="schedule-form"><i class="fa fa-save"></i> Save</button>
                  <button class="btn btn-default border btn-sm rounded-0" type="reset" form="schedule-form"><i class="fa fa-reset"></i> Cancel</button>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
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
          <button type="button" class="btn btn-primary btn-sm rounded-0" id="edit" data-id="">Edit</button>
          <button type="button" class="btn btn-danger btn-sm rounded-0" id="delete" data-id="">Delete</button>
          <button type="button" class="btn btn-secondary btn-sm rounded-0" data-bs-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Event Details Modal -->
<script>
  $(document).ready(function() {
    $('#welcomeModal').modal('show'); // Show the welcome modal when the page loads
  });
</script>
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