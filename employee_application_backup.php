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
            <img src="bgimages/pine.png" alt="logo" style="width: 90px; margin-top: -20px; margin-left: -8px; margin-bottom: -20px;">
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



        <div class="col-md-12">
          <ul class="nav nav-tabs">
            <li class="nav-item">
              <a class="nav-link fw-bold" href="employee.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link fw-bold" href="employee_profile.php">Profile</a>
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
                &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Leave Application</span></strong>
              </strong>
            </div>

            <form class="form form-control" action="Leave_app_list.php" method="post">
              <label for="imId" class="form-label">Employee Id:</label>
              <input type="number" name="imId" class="form-control" placeholder="Enter Employee Id" required>
              <label for="leave" class="form-label">Type of Leave:</label>
              <select name="leave" class="form-select" aria-label="Default select example" required>
                <option value="">Select a Leave</option>
                <?php
                $query = "select * from leave_type";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  echo '<option value = ' . $row["lt_id"] . '>' . $row["lt_name"] . '</option>';
                }
                ?>
              </select>
              <br>
              <textarea name="reason" cols="30" placeholder="State your Reason" rows="5" class="form-control" required></textarea>
              <br>
              <label for="st_day" class="form-label">Starting Day:</label>
              <input type="date" class="form-control" name="st_day" required>
              <label for="end_day" class="form-label">Ending Day:</label>
              <input type="date" class="form-control" name="end_day" required>
              <label for="la_day_type" class="form-label">Day:</label>
              <select name="la_day_type" class="form-select" aria-label="Default select example" required>
                <option value="">Select Day type</option>
                <option value="Whole Day">Whole Day</option>
                <option value="Half Day">Half Day</option>
              </select>
              <br>
              <a href="./employee_app_list.php"><button type="button" class="btn btn-primary">Add</button></a>
              <!--<input href="./Leave_app_list.php" type="submit">-->
            </form>






            <!--
  <div class="col-md-5" style="width: 48%; height: 50%">
    <div class="panel panel-default">
    <div class="panel-heading">
       
      &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-list fa-xl" style="color: #2468a0; "></i>&nbsp;&nbsp;Attendance Per Department</span></strong>
     
    <div class ="dash_content">
    <div class ="dash_content_main">
 
      <table id="example" class="table">
<colgroup>
    <col width="15%">
    <col width="15%">
    <col width="15%">

  </colgroup>
  <thead class="" style ="background-color: rgb(255, 206, 46)">
    <tr>
      <th class="text-center p-0">Department</th>
      <th class="text-center p-0">Attendance File</th>
      <th class="text-center p-0">Date Added</th>
    </tr>
    </thead>
 
        <php
        $query = "SELECT * FROM `attendance` a INNER JOIN `department` d ON a.dep_id = d.dep_id";

       $result = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($result)){

            $r_at_id = $row['at_id'];
            $r_dep_name = $row['dep_name'];
            $r_at_media = $row['at_media'];
            $r_date_added = $row['date_added'];

            echo "<tr> 
                    <td class='text-center p-3'> $r_dep_name </td>
                    <td class='text-center p-3'> $r_at_media </td>
                    <td class='text-center p-3'> $r_date_added </td>";
                    ?>
   <php
       }
        ?>


</form>
      -->



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