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




              </form>
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

                    <form class="form form-control" action="Leave_app_list.php" method="post">
                      <p id="message" class=text-danger> </p>

                      <br><strong><span>Employee</span></strong><br>
                      <select class="form-select" id="imId" name="imId" required>
                        <option value="">Select Employee Here</option>
                        <?php
                        $query = "select * from employee";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<option value = ' . $row["em_id"] . '>' . $row["first_name"] . " " . $row["last_name"] . '</option>';
                        }
                        ?>
                      </select>

                      <br><strong><span>Type of Leave</span></strong><br>
                      <select class="form-select" id="leave" name="leave" required>
                        <option value="">Select a Leave</option>
                        <?php
                        $query = "select * from leave_type";
                        $result = mysqli_query($conn, $query);
                        while ($row = mysqli_fetch_assoc($result)) {
                          echo '<option value = ' . $row["lt_id"] . '>' . $row["lt_name"] . '</option>';
                        }
                        ?>
                      </select><br>

                      &nbsp;<strong><span>Reason</span></strong>
                      <br> <textarea id="reason" name="reason" cols="30" placeholder="State your Reason" rows="5" required></textarea>
                      <br>

                      &nbsp;<strong><span>Starting Day</span></strong><br>
                      <br><input type="date" class="form-control" placeholder=" " id="st_day" name="st_day" aria-describedby="addon-wrapping"><br>

                      &nbsp;<strong><span>Ending Day</span></strong><br>
                      <br><input type="date" class="form-control" placeholder="" id="end_day" name="end_day" aria-describedby="addon-wrapping"><br>

                      <br><strong><span>Day Type</span></strong><br>
                      <select class="form-select" id="la_day_type" name="la_day_type" required>
                        <option value="">Select Day type</option>
                        <option value="Whole Day">Whole Day</option>
                        <option value="Half Day">Half Day</option>
                      </select><br>
                      &nbsp; &nbsp; <button type="submit" class="btn btn-success" style="background-color: #2468a0; margin-left: -15px" href="./Leave_app_list.php">Submit</button>
                    </form>



                    </form>
                  </div>
                </div>
              </div>
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

            $('nav ul li').click(function() {
              $(this).addClass("active").siblings().removeClass("active");
            });
          </script>
  </body>

  </html>