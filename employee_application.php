<!--Declaration of user session -logout- -->
<?php
session_start();
include "DBConnection.php";
if (isset($_SESSION['s_em_email'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
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
  <link rel="stylesheet" href="css/navbar.css">

  <!--calendar links-->
  <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous" />
  <link rel="stylesheet" href="./css/bootstrap.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <link rel="stylesheet" href="./fullcalendar/lib/main.min.css">
  <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>
  <script src="./js/jquery-3.6.0.min.js"></script>
  <script src="./js/bootstrap.min.js"></script>
  <script src="./fullcalendar/lib/main.min.js"></script>
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
  <script src="./js/script.js"></script>
</head>
<body>
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
          <h10 style="font-family: 'Glacial Indifference';"><?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?></h10>
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
              <a class="nav-link fw-bold dropdown-toggle active" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Leave</a>
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
                echo '<li data-bs-toggle="tooltip" data-bs-placement="top" title="' . $tooltip_message . '"><a class="dropdown-item active fw-bold' . $application_disabled . '" href="employee_application.php" >Application</a></li>';
                ?>
                <li><a class="dropdown-item fw-bold" href="./employee_app_list.php">List</a></li>
              </ul>
            </li>
          </ul>
          <div class="panel panel-default m-4">
            <div class="panel-heading">
              <strong>
                <span><strong style="font-family: 'Glacial Indiffernce'" class="text-uppercase"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Leave Application</span></strong>
              </strong>
            </div>
            <div>
              <form id="leaveForm" class="form m-3" action="save_leave_application2.php" method="post">
                <div class="mb-3">
                  <label for="imId" class="form-label fw-bold">Employee ID</label>
                  <div class="input-group">
                    <input type="text" class="form-control" style="cursor:pointer;" id="emId" name="emId" data-bs-toggle="tooltip" data-bs-placement="top" title="The Employee ID is set by default and cannot be edited." value="<?php echo $_SESSION['s_em_id']; ?>" readonly>
                    <span class="input-group-text" data-bs-toggle="tooltip" data-bs-placement="top" title="This field is read-only.">
                      <i class="fa-solid fa-info-circle"></i>
                    </span>
                  </div>
                </div>
                <div class="mb-3">
                  <label for="leave" class="form-label fw-bold">Type of Leave</label>
                  <select name="leave" class="form-select" aria-label="Default select example" required>
                    <option class="fw-bold" selected disabled>Select a Leave</option>
                    <?php
                      $em_id = $_SESSION['s_em_id'];
                      $query = "SELECT lt.lt_id, lt.lt_name, ec.available_credits FROM leave_type lt
                                INNER JOIN employee_leave_credits ec ON lt.lt_id = ec.lt_id
                                WHERE ec.em_id = $em_id";
                      $result = mysqli_query($conn, $query);
                      while ($row = mysqli_fetch_assoc($result)) {
                        $disabled = ($row['available_credits'] == 0) ? 'disabled' : '';

                        // Output option with disabled attributes
                        echo '<option class="m-3" value="' . $row["lt_id"] . '" ' . $disabled . ' >' . $row["lt_name"] . ' (' . $row['available_credits'] . ' remaining credits)' .'</option>';
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
                  <button type="submit" id="submitLeave" class="btn btn-primary">ADD</button>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
    </div>
  <?php
    } else {
      header("location: login.php");
      exit();
    }
  ?>
</body>
</html>
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

  $('nav ul li').click(function() {
    $(this).addClass("active").siblings().removeClass("active");
  });

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
  var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl)
  });

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
            window.location.href = 'employee_app_list.php';
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