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

    <!--Navbar CSS-->
    <link rel="stylesheet" href="css/navbar.css">
  </head>

  <body>

    <!--LOGOUT -- getting user role to display specific features and function -->
    <?php
    $em_id = $_SESSION['s_em_id'];
    if ($_SESSION['s_user_id'] == 2) {
      $query = "Select * from employee where em_id = $em_id";

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

        <form>
          <div class="col-md-12">
            <ul class="nav nav-tabs">
              <li class="nav-item">
                <a class="nav-link" href="employee.php">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="employee_profile.php">Profile</a>
              </li>
              <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle active" aria-current="page" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Leave</a>
                <ul class="dropdown-menu">
                  <li><a class="dropdown-item" href="employee_application.php">Application</a></li>
                  <li><a class="dropdown-item" href="./employee_app_list.php">List</a></li>
                </ul>
              </li>
            </ul>
            <div class="panel panel-default">
              <div class="panel-heading">
                <strong>
                  &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Applications</span></strong>
                </strong>
              </div>
              <div class="col-md-12">
                <div class="panel panel-default">



                  <div class="col-md-7" style="width: 100%">
                    <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
                      <div class="panel-heading">
                        <strong>
                          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Leave Application List</span></strong>
                        </strong>

                        <?php
                        // Check the user's role and set up the appropriate query
                        $em_id = $_SESSION['s_em_id'];
                        if ($_SESSION['s_user_id'] == 2) {
                          $query = "SELECT * FROM employee WHERE em_id = $em_id";
                          $result = mysqli_query($conn, $query);
                          // Fetch the employee's first name and last name
                          $employee = mysqli_fetch_assoc($result);
                          $first_name = $employee['first_name'];
                          $last_name = $employee['last_name'];
                        ?>
                        <?php } ?>
                      </div>

                      <?php
                      // Modify the query to fetch leave applications for the logged-in employee only
                      $query = "SELECT la.*, lt.*, e.first_name, e.last_name
                      FROM `leave_application` la 
                      INNER JOIN `leave_type` lt ON la.lt_id = lt.lt_id 
                      INNER JOIN `employee` e ON la.em_id = e.em_id
                      WHERE la.em_id = $em_id";
            

                      // Execute the modified query
                      $result = mysqli_query($conn, $query);

                      // Check if there are any rows returned
                      if (mysqli_num_rows($result) > 0) {
                      ?>
                        <!-- Table header -->
                        <table class="table" id="example">
                          <colgroup>
                            <!-- Define column widths if needed -->
                          </colgroup>
                          <thead class="" style="background-color: rgb(255, 206, 46)">
                            <tr>
                              <th class="text-center p-1">Employee</th>
                              <th class="text-center p-1">Leave Type</th>
                              <th class="text-center p-1">Date</th>
                              <th class="text-center p-1">Status</th>
                              <!-- Add any additional columns as needed -->
                            </tr>
                          </thead>
                          <tbody>
                            <?php
                            // Fetch and display the leave applications
                            while ($row = mysqli_fetch_assoc($result)) {
                              // Process each row of data and display it in the table
                              // You can customize this part based on your database structure
                              $r_first_name = $row['first_name'];
                              $r_last_name = $row['last_name'];
                              $r_lt_code = $row['lt_code'];
                              $r_lt_name = $row['lt_name'];
                              $r_la_date_start = date("F j, Y", strtotime($row['la_date_start']));
                              $r_la_date_end = date("F j, Y", strtotime($row['la_date_end']));
                              $r_lt_status = $row['la_status'];

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
                                  $status_color = 'bg-primary';
                                  break;
                                case 'Declined':
                                case 'Cancelled':
                                  $status_color = 'bg-danger';
                                  break;
                                case 'Pending':
                                default:
                                  $status_color = 'bg-secondary';
                                  break;
                              }
                            ?>
                              <!-- Table row -->
                              <tr>
                                <td class='text-center p-3'><?php echo "$r_last_name, $r_first_name"; ?></td>
                                <td class='text-center p-3'>[<?php echo $r_lt_code; ?>] - <?php echo $r_lt_name; ?></td>
                                <td class='text-center p-3'><?php echo $date_display; ?></td>
                                <td class='text-center'><span class='badge <?php echo $status_color; ?>'><?php echo $r_lt_status; ?></span></td>
                                <!-- Add any additional columns as needed -->
                              </tr>
                              
                            <?php
                            }
                            ?>
                            <?php }else{
                                echo "<p><strong>No Application yet</strong></p>";
                            } ?>



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

                            $('nav ul li').click(function() {
                              $(this).addClass("active").siblings().removeClass("active");
                            });
                          </script>
  </body>

  </html>
