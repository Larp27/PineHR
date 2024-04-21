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
    <title>Profile | PINE HR</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>

    <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

    <!--offline bootstrap-->
    <link rel="stylesheet" href="css/all.min.css">
    <link rel="stylesheet" href="css/fontawesome.min.css">
    <script src="js/all.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <!--Navbar CSS-->
    <link rel="stylesheet" href="css/navbar.css">

    <style>
      .nav-tabs.nav-sm>li.nav-item>a.nav-link {
        padding: 0.25rem 0.5rem;
        font-size: 0.9rem;
      }

      .nav-tabs.nav-sm>li.nav-item {
        margin-bottom: 0;
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
          <h10 style="font-family: 'Glacial Indifference';"><?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name']; ?></h10>
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
        <div class="col-md-12">
          <ul class="nav nav-tabs nav-sm">
            <li class="nav-item">
              <a class="nav-link fw-bold" href="employee.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link active fw-bold" aria-current="page" href="employee_profile.php">Profile</a>
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
          <div>
            <div class="row">
              <?php
              if (isset($_SESSION['s_em_email'])) {
                // Fetch the logged-in employee's data from the database
                $em_id = $_SESSION['s_em_id'];
                $query = "SELECT e.*, a.*, d.dep_name, des.des_name,
                          edu.education, ms.ms_name, bt.bt_name, r.r_name, es.es_name
                          FROM employee e
                          INNER JOIN address a ON e.address_id = a.address_id
                          INNER JOIN department d ON e.dep_id = d.dep_id
                          INNER JOIN designation des ON e.des_id = des.des_id
                          LEFT JOIN education edu ON e.edu_id = edu.edu_id
                          LEFT JOIN marital_status ms ON e.ms_id = ms.ms_id
                          LEFT JOIN employment_status es ON e.es_id = es.es_id
                          LEFT JOIN blood_group bt ON e.bt_id = bt.bt_id
                          LEFT JOIN religion r ON e.r_id = r.r_id
                          WHERE e.em_id = $em_id";

                $result = mysqli_query($conn, $query);

                if ($result && mysqli_num_rows($result) > 0) {
                  $employee_data = mysqli_fetch_assoc($result);
                  $first_name = $employee_data['first_name'];
                  $last_name = $employee_data['last_name'];
                  $em_gender = $employee_data['em_gender'];
                  $em_email = $employee_data['em_email'];
                  $em_phone = $employee_data['em_phone'];
                  $em_birthday = $employee_data['em_birthday'];
                  $barangay = $employee_data['barangay'];
                  $city = $employee_data['city'];
                  $dep_name = $employee_data['dep_name'];
                  $des_name = $employee_data['des_name'];
                  $ms_name = $employee_data['ms_name'];
                  $bt_name = $employee_data['bt_name'];
                  $r_name = $employee_data['r_name'];
                  $education = $employee_data['education'];
                  $employee_status = $employee_data['employee_status'];
                  $es_name = $employee_data['es_name'];
              ?>
                  <div class="col-md-12">
                    <div class="">
                      <div class="panel panel-default mt-4 mx-auto shadow-lg border-0" style="width: 95%;">
                        <div class="panel-heading border-0 d-flex p-0">
                          <div class="me-3 ms-3 mt-3">
                            <i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>
                          </div>
                          <p class="text-uppercase fw-bold fs-5 mt-3">Employee Profile</p>
                        </div>
                        <div class="row">
                          <div class="col-12 d-flex">
                            <div class="col-md-3 mt-4 ms-5">
                              <img src="../PineHR/bgimages/ormoc_seal.jpg" alt="Logo" style="max-width: 150px; max-height: 150px; margin-bottom:20px; margin-left: 80px;">
                              <div class="mt-2" style="display: inline-block; border: 2px solid #00008B; padding: 2px;">
                                <img src="../PINEHR/<?php echo substr($employee_data['em_profile_pic'], 3); ?>" style="max-width:300px; max-height:300px;">
                              </div>


                            </div>
                            <div class="col-md-4 mt-3">
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">First Name:</label>
                              <p class="" style="color: black;"><?php echo $first_name; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Last Name:</label>
                              <p class="" style="color: black;"><?php echo $last_name; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Gender:</label>
                              <p class="" style="color: black;"><?php echo $em_gender; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Marital Status:</label>
                              <p class="" style="color: black;"><?php echo $ms_name ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Phone:</label>
                              <p class="" style="color: black;"><?php echo $em_phone; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Email:</label>
                              <p class="" style="color: black;"><?php echo $em_email; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Birthday:</label>
                              <p class="" style="color: black;"><?php echo date("F j, Y", strtotime($em_birthday)); ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Address:</label>
                              <p class="" style="color: black;"><?php echo $barangay . ', ' . $city; ?></p>
                            </div>
                            <div class="col-md-4 mt-3">
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Educational Attainment:</label>
                              <p class="" style="color: black;"><?php echo $education; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Department:</label>
                              <p class="" style="color: black;"><?php echo $dep_name; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Designation:</label>
                              <p class="" style="color: black;"><?php echo $des_name; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Employment Status:</label>
                              <p class="" style="color: black;"><?php echo $es_name; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Employee Status:</label>
                              <p class="" style="color: black;"><?php echo $employee_status; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Religion:</label>
                              <p class="" style="color: black;"><?php echo $r_name; ?></p>
                              <label style="font-weight: bold; margin-bottom: 5px; text-transform: uppercase;">Blood Type:</label>
                              <p class="" style="color: black;"><?php echo $bt_name; ?></p>

                            </div>
                          </div>
                        </div>
                      </div>
                    </div>

                    <div class="">
                      <div class="panel panel-default mt-4 mx-auto shadow-lg border-0" style="width: 95%;">
                        <div class="panel-heading border-0 d-flex p-0">
                          <div class="me-3 ms-3 mt-3">
                            <img src="bgimages\leave.png" alt="" style="max-width: 45px;">
                          </div>
                          <p class="text-uppercase fw-bold fs-5 mt-3">Available Leaves and Remaining Credits</p>
                        </div>

                        <?php
                        $leave_types_query = $conn->query("SELECT lt.lt_id, lt.lt_name, IFNULL(elc.available_credits, lt.lt_credit) AS lt_credit FROM leave_type lt LEFT JOIN employee_leave_credits elc ON lt.lt_id = elc.lt_id AND elc.em_id = $em_id WHERE elc.em_id = $em_id");
                        $total_leave_types = $leave_types_query->num_rows;
                        $leave_types_per_column = ceil($total_leave_types / 2);

                        $counter = 0;
                        while ($leave_type = $leave_types_query->fetch_assoc()) {
                          if ($counter % $leave_types_per_column == 0) {
                            echo '<div class="col-md-6">';
                          }
                          echo '<div class="row">';
                          echo '<div class="col-6">';
                          echo '<div class="form-check my-1">';

                          echo '<li type="text" id="leave_type_' . $leave_type['lt_id'] . '" name="leave_type_ids[]" value="' . $leave_type['lt_id'] . '" class="leave-type-checkbox text-capitalize" read-only>' . $leave_type['lt_name'] . ' <span class="text-lowercase">(' . $leave_type['lt_credit'] . ' Remaining Credits)</span></li>';
                          echo '</div>';
                          echo '</div>';
                          echo '</div>';
                          $counter++;

                          if ($counter % $leave_types_per_column == 0 || $counter == $total_leave_types) {
                            echo '</div>'; // Close the col-md-6
                          }
                        }
                        ?>

                      </div>
                    </div>
                  </div>
              <?php
                } else {
                  echo "No data found for the logged-in employee.";
                }
              }
              ?>
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

    var updateUserModal = document.getElementById('updateUserModal');
    updateUserModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget; // Button that triggered the modal
      var em_id = button.getAttribute('data-em-id'); // Extract info from data-* attributes
      var gender = button.getAttribute('data-gender');
      var first_name = button.getAttribute('data-f-name');
      var last_name = button.getAttribute('data-l-name');
      var des_id = button.getAttribute('data-des-id');
      var dep_id = button.getAttribute('data-dep-id');
      var es_id = button.getAttribute('data-es-id');
      var bt_id = button.getAttribute('data-bt-id');
      var phone = button.getAttribute('data-em-phone');
      var address = button.getAttribute('data-em-address');
      var birthday = button.getAttribute('data-em-birthday');
      var role = button.getAttribute('data-role-id');
      var email = button.getAttribute('data-em-email');
      var join_date = button.getAttribute('data-em-join-date');
      var contract_end = button.getAttribute('data-em-contract-end');

      var modalBody = updateUserModal.querySelector('.modal-body');
      modalBody.querySelector('#em_id').value = em_id;
      modalBody.querySelector('#gender').value = gender;
      modalBody.querySelector('#f_name').value = first_name;
      modalBody.querySelector('#l_name').value = last_name;
      modalBody.querySelector('#des_id').value = des_id;
      modalBody.querySelector('#dep_id').value = dep_id;
      modalBody.querySelector('#es_id').value = es_id;
      modalBody.querySelector('#bt_id').value = bt_id;
      modalBody.querySelector('#em_phone').value = phone;
      modalBody.querySelector('#em_address').value = address;
      modalBody.querySelector('#em_birthday').value = birthday;
      modalBody.querySelector('#user_role').value = role;
      modalBody.querySelector('#em_email').value = email;
      modalBody.querySelector('#em_joining_date').value = join_date;
      modalBody.querySelector('#em_contract_end').value = contract_end;
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
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
  </script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>