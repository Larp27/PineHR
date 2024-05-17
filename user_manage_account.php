<!--Declaration of user session -logout- -->
<?php
session_start();
include "DBConnection.php";
if (isset($_SESSION['s_em_email'])) {
?>
<!--cont logout session-->
<?php
  if (isset($_SESSION['s_em_id'])) {
    $em_id = ($_SESSION['s_em_id']);

    $query = "SELECT * FROM employee WHERE em_id = $em_id";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      $em_id = $row['em_id'];
      $des_id = $row['des_id'];
      $dep_id = $row['dep_id'];
      $bt_id = $row['bt_id'];
      $user_id = $row['user_id'];
      $es_id = $row['es_id'];
      $address_id = $row['address_id'];
      $edu_id = $row['edu_id'];
      $r_id = $row['r_id'];
      $ms_id = $row['ms_id'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $em_email = $row['em_email'];
      $em_gender = $row['em_gender'];
      $em_phone = $row['em_phone'];
      $em_birthday = $row['em_birthday'];
      $em_joining_date = $row['em_joining_date'];
      $em_contract_end = $row['em_contract_end'];
      $em_profile_pic = $row['em_profile_pic'];
      $employee_status = $row['employee_status'];
      $em_income = $row['em_income'];
      
    } else {
      echo "Employee not found";
    }
  } else {
    echo "Employee ID not provided";
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Dashboard | PINE HR</title>
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

  .select-photo-btn,
  .remove-photo-btn {
    --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);
    --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
    color: rgb(55 65 81);
    text-transform: uppercase;
    font-weight: 600;
    font-size: .75rem;
    line-height: 1rem;
    letter-spacing: .1em;
    margin-right: 5px;
    padding: 0.5rem 1rem;
    border-color: rgb(209 213 219);
    border-width: 1px;
    border-radius: 0.375rem;
    text-align: center;
  }

  .select-photo-btn:hover,
  .remove-photo-btn:hover {
    background-color: rgb(249 250 251);
    transition-timing-function: cubic-bezier(.4, 0, .2, 1);
    transition-duration: .15s;
    border-color: rgb(209 213 219);
    border-width: 1px;
    border-radius: 0.375rem;
  }
</style>
<body>
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
                <li><a class="dropdown-item fw-bold <?php echo (basename($_SERVER['PHP_SELF']) == 'user_manage_account.php') ? 'active' : ''; ?>" href="user_manage_account.php">Manage Account</a></li>
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
        <ul class="nav nav-tabs nav-sm">
          <li class="nav-item">
            <a class="nav-link active fw-bold" aria-current="page" href="employee.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="employee_profile.php">Profile</a>
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
        
        <form method="post" id="updateEmployeeForm" enctype="multipart/form-data">
          <input type="hidden" id="em_id" name="em_id" value="<?php echo $_SESSION['s_em_id']; ?>">
          <div class="panel panel-default">
            <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
              <strong>
                &nbsp;
                <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Manage Account</strong></span>
              </strong>
            </div>
          </div>
          <div>
            <div class="card card-outline card-primary m-5 mb-4">
              <div class="card-header">
                <div class="panel-heading" style="padding: 2px !important;">
                  <strong>
                    &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Update Information Details</span></strong>
                  </strong>
                </div>
              </div>

              <div class="card-body">
                <div class="container-fluid">
                  <p id="message" class=text-danger></p>
                  <div class="row">
                    <div class="col-6">
                      <div class="form-group mb-3">
                        <label for="first_name" class="fw-bold text-uppercase">First Name</label>
                        <input type="text" class="form-control" placeholder="Employee's First Name" name="first_name" id="first_name" aria-describedby="addon-wrapping" required value="<?php echo isset($first_name) ? $first_name : ''; ?>">
                      </div>
                      <div class="form-group mb-3">
                        <label for="last_name" class="fw-bold text-uppercase">Last Name</label>
                        <input type="text" class="form-control" placeholder="Employee's Last Name" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" aria-describedby="addon-wrapping" required>
                      </div>
                      <div class="form-group mb-3">
                        <label for="em_birthday" class="fw-bold text-uppercase">Date of Birth</label>
                        <input type="date" name="em_birthday" id="em_birthday" class="form-control" aria-describedby="addon-wrapping" required value="<?php echo isset($em_birthday) ? $em_birthday : ''; ?>">
                      </div>
                      <div class="form-group mb-3">
                        <label for="em_phone" class="fw-bold text-uppercase">Contact Number</label>
                        <input type="text" name="em_phone" id="em_phone" class="form-control" aria-describedby="addon-wrapping" required value="<?php echo isset($em_phone) ? $em_phone : ''; ?>">
                      </div>
                      <div class="form-group mb-3">
                        <label for="address_id" class="fw-bold text-uppercase mb-1 text-uppercase">Address</label>
                        <select class="form-select" id="address_id" name="address_id" required>
                          <option disabled>Please Select Here</option>
                          <?php
                          $address_qry = $conn->query("SELECT * FROM `address` ORDER BY barangay ASC");
                          while ($address_row = $address_qry->fetch_assoc()) :
                            $selected = ($address_id == $address_row['address_id']) ? 'selected' : '';
                          ?>
                            <option value="<?php echo $address_row['address_id'] ?>" <?php echo $selected ?>>
                              <?php echo $address_row['barangay'] . ', ' . $address_row['city'] ?>
                            </option>
                          <?php endwhile; ?>
                        </select>
                      </div>
                    </div>
                    <div class="col-6">
                      <div class="form-group mb-3">
                        <label for="em_email" class="fw-bold text-uppercase">Email</label>
                        <div class="input-group">
                          <input type="email" name="em_email" id="em_email" class="form-control" aria-describedby="addon-wrapping" value="<?php echo isset($em_email) ? $em_email : ''; ?>">
                          <span class="input-group-text">@ormochr.com</span>
                        </div>
                      </div>
                      <div class="form-group mb-3 password-toggle">
                        <label for="current_password" class="form-label">Current Password</label>
                        <input type="password" class="form-control" id="current_password" name="current_password">
                        <i id="toggleCurrent_password" class="toggle-icon fas fa-eye-slash" style="display: none; float: right; margin-left: -30px; margin-top: -25px; margin-right: 10px; position: relative; z-index: 2;" onclick="togglePassword('current_password')"></i>
                      </div>
                      <div class="form-group mb-3 password-toggle">
                        <label for="new_password" class="form-label">New Password</label>
                        <input type="password" class="form-control" id="new_password" name="new_password">
                        <i id="toggleNew_password" class="toggle-icon fas fa-eye-slash" style="display: none; float: right; margin-left: -30px; margin-top: -25px; margin-right: 10px; position: relative; z-index: 2;" onclick="togglePassword('new_password')"></i>
                      </div>

                      <div class="form-group mb-3">
                        <label for="em_profile_pic" class="fw-bold text-uppercase">Profile Picture</label>
                        <div class="mb-2">
                          <img src="../PINEHR/<?php echo substr($em_profile_pic, 3); ?>" style="width: 250px;" alt="Profile Photo" class="profile-photo">
                        </div>
                        <div class="mb-3 mx-4">
                          <button type="button" class="btn select-photo-btn">Select a new photo</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="m-4 text-end">
              <button type="button" class="btn btn-success text-bold" name="manage_account_btn" id="manage_account_btn">UPDATE</button>
            </div>
          </div>
        </form>
      </div>
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
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const barangaySelect = document.getElementById('address_id');
    const citySelect = document.getElementById('city');
    barangaySelect.addEventListener('change', function() {
      const selectedBarangay = barangaySelect.value;
      if (selectedBarangay) {
        // Make AJAX request to fetch city based on selected barangay
        $.ajax({
          url: 'Employee/fetchCity.php',
          method: 'POST',
          data: {
            barangay: selectedBarangay
          },
          success: function(data) {
            citySelect.value = data;
          },
          error: function(xhr, status, error) {
            console.error('Error fetching city:', error);
          }
        });
      } else {
        citySelect.value = '';
      }
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });

  document.querySelector('.select-photo-btn').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.id = 'em_profile_pic';
    input.name = 'em_profile_pic';
    input.onchange = function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.querySelector('.profile-photo');
          img.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };
    input.click();
    const form = document.querySelector('form');
    form.appendChild(input);
  });

  function togglePassword(id) {
    let passwordField = document.getElementById(id);
    let toggleIcon = document.getElementById('toggle' + id.charAt(0).toUpperCase() + id.slice(1));

    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    } else {
      passwordField.type = 'password';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    }
  }

  // Add event listeners to the password fields to toggle the eye icon visibility dynamically
  document.getElementById('current_password').addEventListener('input', function() {
    let toggleIcon = document.getElementById('toggleCurrent_password');
    if (this.value !== '') {
      toggleIcon.style.display = 'inline-block';
    } else {
      toggleIcon.style.display = 'none';
    }

    // Add required attribute to password fields based on user input
    const newPasswordInput = document.getElementById('new_password');
    if (this.value !== '') {
      this.setAttribute('required', 'required');
      newPasswordInput.setAttribute('required', 'required');
    } else {
      this.removeAttribute('required');
      newPasswordInput.removeAttribute('required');
    }
  });

  document.getElementById('new_password').addEventListener('input', function() {
    let toggleIcon = document.getElementById('toggleNew_password');
    if (this.value !== '') {
      toggleIcon.style.display = 'inline-block';
    } else {
      toggleIcon.style.display = 'none';
    }

    const currentPasswordInput = document.getElementById('current_password');
    if (this.value !== '') {
      this.setAttribute('required', 'required');
      currentPasswordInput.setAttribute('required', 'required');
    } else {
      this.removeAttribute('required');
      currentPasswordInput.removeAttribute('required');
    }
  });
</script>
<script src="manage_account.js"></script>