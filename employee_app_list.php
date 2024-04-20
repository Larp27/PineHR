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
    <link rel="stylesheet" href="css/main.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

    <script src="script.js"></script>
    <script src="imoJS.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <!--offline bootstrap-->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <script src="js/all.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Navbar CSS-->
    <link rel="stylesheet" href="css/navbar.css">

    <!-- DATATABLES OFFLINE -->
    <link rel="stylesheet" href="DataTables/css/bootstrap.min.css">
    <link rel="stylesheet" href="DataTables/css/bootstrap5.min.css">
    <script src="DataTables/js/jquery-3.7.0.js"></script>
    <script src="DataTables/js/js_jquery.dataTables.min.js"></script>
    <script src="DataTables/js/js_dataTables.bootstrap5.min.js"></script>
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
    </style>
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
    <div id="dashmaincontainer">
      <div class="dash_sidebar_menus">
        <?php if ($_SESSION['s_user_id'] == 2) : ?>
        <?php endif; ?>
      </div>
      <div class="dash_content_container" id="dash_content_container">
        <div class="dash_topnav" id="dash_topnav">
          <a href="Dashboard.php">
            <img src="bgimages/pine.png" alt="logo" style="width: 100px;height: 60px;margin-top: -15px; margin-left: -8px">
          </a>
          <h10 style="font-family: 'Glacial Indifference';">&nbsp; Welcome <?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?>!</h10>
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
              <strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>Applications</strong>
            </div>
            <div class="col-md-12">
              <div class="panel panel-default">
                <div>
                  <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
                    <div class="panel-heading">
                        <strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>Leave Application List</strong>
                      <?php
                      $em_id = $_SESSION['s_em_id'];
                      if ($_SESSION['s_user_id'] == 2) {
                        $query = "SELECT * FROM employee WHERE em_id = $em_id";
                        $result = mysqli_query($conn, $query);
                        $employee = mysqli_fetch_assoc($result);
                        $first_name = $employee['first_name'];
                        $last_name = $employee['last_name'];
                      ?>
                      <?php } ?>
                    </div>

                    <?php
                      $query = "SELECT la.*, lt.*, e.first_name, e.last_name
                      FROM `leave_application` la 
                      INNER JOIN `leave_type` lt ON la.lt_id = lt.lt_id 
                      INNER JOIN `employee` e ON la.em_id = e.em_id
                      WHERE la.em_id = $em_id";
          
                      $result = mysqli_query($conn, $query);
                      if (mysqli_num_rows($result) > 0) {
                    ?>
                      <table class="table table-hover" id="example">
                        <thead style="background-color: rgb(255, 206, 46)">
                          <tr>
                            <th class="text-center p-1">Employee</th>
                            <th class="text-center p-1">Leave Type</th>
                            <th class="text-center p-1">Date</th>
                            <th class="text-center p-1">Status</th>
                          </tr>
                        </thead>
                        <tbody>
                          <?php
                          while ($row = mysqli_fetch_assoc($result)) {
                            $r_first_name = $row['first_name'];
                            $r_last_name = $row['last_name'];
                            $r_lt_code = $row['lt_code'];
                            $r_lt_name = $row['lt_name'];
                            $r_la_date_start = date("F j, Y", strtotime($row['la_date_start']));
                            $r_la_date_end = date("F j, Y", strtotime($row['la_date_end']));
                            $r_lt_status = $row['la_status'];
                            if (date("F Y", strtotime($r_la_date_start)) == date("F Y", strtotime($r_la_date_end))) {
                              $date_display = "$r_la_date_start";
                            } else {
                              $date_display = "$r_la_date_start - $r_la_date_end";
                            }
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
                            <tr>
                              <td class='text-center p-3'><?php echo "$r_last_name, $r_first_name"; ?></td>
                              <td class='text-center p-3'>[<?php echo $r_lt_code; ?>] - <?php echo $r_lt_name; ?></td>
                              <td class='text-center p-3'><?php echo $date_display; ?></td>
                              <td class='text-center'><span class='badge <?php echo $status_color; ?>'><?php echo $r_lt_status; ?></span></td>
                            </tr>
                          <?php
                            }
                          ?>
                          <?php }else{
                              echo "<p><strong>No Application yet</strong></p>";
                          } ?>
                          <?php
                            } else {
                              header("location: login.php");
                              exit();
                            }
                          ?> 
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
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
    </script>
  </body>
</html>