<!--Declaration of user session -logout- -->
<?php
session_start();
include "DBConnection.php";

// Check for user inactivity
$inactive_timeout = 300; // 5 minutes in seconds
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > $inactive_timeout)) {
    session_unset();     // unset $_SESSION variable for the run-time 
    session_destroy();   // destroy session data in storage
    echo '<script>alert("You have been logged out due to inactivity."); window.location.href = "logout.php";</script>'; // JavaScript alert message
    exit();
}

$_SESSION['last_activity'] = time(); // Update last activity time


if (isset($_SESSION['s_em_email'])) {
  // Fetch the profile picture path from the database based on the logged-in user's ID
  $query = "SELECT em_profile_pic FROM employee WHERE em_id = ?";
  $stmt = mysqli_prepare($conn, $query);
  mysqli_stmt_bind_param($stmt, 'i', $_SESSION['s_em_id']);
  mysqli_stmt_execute($stmt);
  mysqli_stmt_bind_result($stmt, $em_profile_pic);
  mysqli_stmt_fetch($stmt);

  $_SESSION['em_profile_pic'] = $em_profile_pic;
  mysqli_stmt_close($stmt);
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title><?php echo $title; ?> | PINE HR</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/navbar2.css">

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

  <!-- Font Awesome -->
  <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

  <!-- DataTables -->
  <link rel="stylesheet" href="DataTables/css/dataTables.bootstrap5.min.css">
  <script src="DataTables/js/jquery-3.7.0.js"></script>
  <script src="DataTables/js/jquery.dataTables.min.js"></script>
  <script src="DataTables/js/dataTables.bootstrap5.min.js"></script>

  <!-- Your custom script -->
  <script src="./script.js"></script>

  <!--font links google-->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap" rel="stylesheet">
</head>

<body>
  <!--LOGOUT -- getting user role to display specific features and function -->
  <?php
    if ($_SESSION['s_user_id'] == 1) {
      $query = "select * from user_type";

      $result = mysqli_query($conn, $query);
    } else {
      header("location: ./employee.php");
    }
    ?>
  <!-- cont LOGOUT Session  -- -->

  <div id="dashmaincontainer">
    <div class="dash_sidebar" id="dash_sidebar">
      <div class="dash_sidebar_menus">
        <div class="text-center pt-4">
          <a href="Dashboard.php">
            <img src="bgimages/pine.png" alt="logo" style="width: 150px;height: 135px;margin-top: -15px; margin-left: -8px">
          </a>
        </div>

        <?php if ($_SESSION['s_user_id'] == 1) : ?>
          <nav class="sidebar">
            <ul>
              <li <?php echo ($page == 'dashboard') ? 'class="active"' : '' ?>><a href="Dashboard.php" style=""><i class="fa-solid fa-gauge fa-spin fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
              <li <?php echo ($page == 'department_list') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'designation_list') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'designation_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'department_add') ? 'class="active"' : '' ?>>
                <a href="#" class="org-btn"><i class="fa-solid fa-landmark fa-2xl" style="color: #2468a0; "></i>&nbsp;&nbsp;&nbsp;&nbsp;Organization
                  <span class="fas fa-caret-down first"></span>
                </a>
                <ul class="org-show">
                  <li><i class="fa-solid fa-building-user fa-sm" style="color: #2468a0;"><a href="Department_list.php" style>Department</a></i></li>
                  <li> <i class="fa-solid fa-user-tie fa-xs" style="color: #2468a0;"><a href="Designation_list.php" style>Designation</a></i></li>
                </ul>
              </li>
              <li <?php echo ($page == 'education') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'education_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'bloodtype') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'bloodtype_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'address') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'address_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'employment_status') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'employment_status_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'religion') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'religion_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'marital_status') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'marital_status_add') ? 'class="active"' : '' ?>>
                <a href="#" class="pro-btn" style><i class="fa-solid fa-address-card fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;PROFILING
                  <span class="fas fa-caret-down sixth"></span>
                </a>
                <ul class="pro-show">
                  <li><i class="fa-solid fa-graduation-cap fa-sm" style="color: #2468a0;"><a href="Education.php" style>Educational Attainment</a></i></li>
                  <li><i class="fa-solid fa-droplet fa-sm" style="color: #2468a0;"><a href="BloodType.php" style>Blood Type</a></i></li>
                  <li><i class="fa-solid fa-location-dot fa-sm" style="color: #2468a0;"><a href="Address.php" style>Address</a></i></li>
                  <li><i class="fa-solid fa-briefcase fa-sm" style="color: #2468a0;"><a href="EmploymentStatus.php" style>Employment Status</a></i></li>
                  <li><i class="fa-solid fa-hands-praying fa-sm" style="color: #2468a0;"><a href="Religion.php" style>Religion</a></i></li>
                  <li><i class="fa-solid fa-people-roof fa-sm" style="color: #2468a0;"><a href="MaritalStatus.php" style>Marital Status</a></i></li>
                </ul>
              </li>
              <li <?php echo ($page == 'employee_list') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'employee_add') ? 'class="active"' : '' ?>
                  <?php echo ($page == 'profile') ? 'class="active"' : '' ?>>
                <a href="#" class="emp-btn" style><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Employees
                  <span class="fas fa-caret-down third"></span>
                </a>
                <ul class="emp-show">
                  <li><i class="fa-solid fa-clipboard-user fa-sm" style="color: #2468a0;"><a href="em_list.php" style>Employee List</a></i></li>
                  <li><i class="fa-solid fa-plus fa-sm" style="color: #2468a0;"><a href="em_add.php" style>Add Employee</a></i></li>
                </ul>
              </li>
              <li <?php echo ($page == 'leave_type_list') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'leave_type_add') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'leave_app_list') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'leave_app_add') ? 'class="active"' : '' ?>>
                <a href="#" class="lev-btn" style><i class="fa-solid fa-user-large-slash fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;LEAVE
                  <span class="fas fa-caret-down fourth"></span>
                </a>
                <ul class="lev-show">
                  <li><i class="fa-solid fa-list-check fa-sm" style="color: #2468a0;"><a href="Leave_type_list.php" style>Leave Type List</a></i></li>
                  <li><i class="fa-solid fa-list-check fa-sm" style="color: #2468a0;"><a href="Leave_app_list.php" style>Application List</a></i></li>
                </ul>
              </li>
              <li <?php echo ($page == 'attendance_list') ? 'class="active"' : '' ?>>
                <a href="attendance_list.php" style>&nbsp;<i class="fa-solid fa-calendar-days fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;ATTENDANCE
                </a>
              </li>
              <li <?php echo ($page == 'payroll_list') ? 'class="active"' : '' ?>>
                <a href="Payroll_list.php" style>&nbsp;<i class=" fa-solid fa-money-check-dollar fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;PAYROLL
                </a>
              </li>
              <li <?php echo ($page == 'reports_attendance') ? 'class="active"' : '' ?> 
                  <?php echo ($page == 'reports_payroll') ? 'class="active"' : '' ?>
                  <?php echo ($page == 'reports_leave') ? 'class="active"' : '' ?>>
                <a href="#" class="rep-btn" style><i class="fa-solid fa-rectangle-list fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;REPORTS
                  <span class="fas fa-caret-down second"></span>
                </a>
                <ul class="rep-show">
                  <li><i class="fa-solid fa-file fa-sm" style="color: #2468a0;"><a href="Reports_att.php" style>Attendance Reports</a></i></li>
                  <li><i class="fa-solid fa-file fa-sm" style="color: #2468a0;"><a href="Reports_payroll.php" style>Payroll Reports</a></i></li>
                  <li><i class="fa-solid fa-file fa-sm" style="color: #2468a0;"><a href="Reports_leave.php" style>Leave Reports</a></i></li>
                </ul>
              </li>

              </form>
            </ul>
          </nav>
        <?php endif; ?>
      </div>
    </div>
    <div class="dash_content_container" id="dash_content_container">
      <div class="dash_topnav" id="dash_topnav">
      <?php
        if (isset($_SESSION['em_profile_pic'])) {
          echo "<img src='../PINEHR/" . substr($_SESSION['em_profile_pic'], 3) . "' style='max-width:60px; max-height:50px; border-radius: 50%; ' alt='Profile Picture'>";
        } else {
          echo "<img src='..//uploads/default_profile_pic.png' style='max-width:50px; max-height:50px; border-radius: 50%; ' alt='default profile pic'>";
        }
        ?>
        <h10 style="font-family: 'Glacial Indifference';">&nbsp; Welcome <?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?>!</h10>

        <a href="logout.php" id="lougoutbtn" style="font-family: 'Glacial Indiffernce'; color: white; text-decoration:none;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-duotone fa-arrow-right-from-bracket"></i>&nbsp; Logout</a>
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
      <!--End of modal logout-->




      <!--<script>
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
      </script>-->

    <!--cont LOGOUT Session -- -->
    <?php
  } else {
    header("location: login.php");
    exit();
  }
    ?>
    <!-- end of LOGOUT Session -->
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