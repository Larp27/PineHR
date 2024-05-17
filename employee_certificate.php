<!--Declaration of user session -logout- -->
<?php
  session_start();
  include "DBConnection.php";
  if (isset($_SESSION['s_em_email'])) {
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Certificate | PINE HR</title>
  <link rel="icon" type="image/png" href="./bgimages/img_tab.png">


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="css/main.css">
  <link rel="stylesheet" href="css/employee.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
  <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

  <!-- Modal Jquery for logging in -->
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

  <!--Navbar CSS-->
  <link rel="stylesheet" href="css/navbar.css">

  <!-- DATATABLES OFFLINE -->
  <link rel="stylesheet" href="DataTables/css/bootstrap.min.css">
  <link rel="stylesheet" href="DataTables/css/bootstrap5.min.css">
  <script src="DataTables/js/jquery-3.7.0.js"></script>
  <script src="DataTables/js/js_jquery.dataTables.min.js"></script>
  <script src="DataTables/js/js_dataTables.bootstrap5.min.js"></script>
</head>
<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }
</style>
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
            <a class="nav-link fw-bold" href="employee.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold" href="employee_profile.php">Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link fw-bold active" aria-current="page" href="employee_certificate.php">Certificates</a>
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
        <div class="panel panel-default">
          <div class="panel-heading text-uppercase">
            <strong style="font-family: 'Glacial Indifference'; letter-spacing: 1px;"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;CERTIFICATES</strong>
          </div>
        </div>
        <div class="col-md-12 mt-3">
          <div>
            <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
              <div class="panel-heading text-uppercase">
                <div class="row" style="margin: 20px !important;">
                  <table class="table table-hover" id="certificateTable">
                    <thead class="" style="background-color: rgb(255, 206, 46)">
                      <tr>
                        <th class="text-center p-1">#</th>
                        <th class="text-center p-1">Title</th>
                        <th class="text-center p-1">Description</th>
                        <th class="text-center p-1">Certificate</th>
                        <th class="text-center p-1">Acquired</th>
                        <th class="text-center p-1">Uploaded</th>
                        <th class="text-center p-1">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <?php
                        $i = 1; // Initialize a counter variable         
                        $query = "SELECT * from `certificate` c
                        INNER JOIN `employee` e ON e.em_id = c.em_id 
                        INNER JOIN `department` d ON d.dep_id = e.dep_id where c.em_id = $em_id";

                        $result = mysqli_query($conn, $query);
                        if (mysqli_num_rows($result) > 0) {
                          while ($row = mysqli_fetch_assoc($result)) {
                            $r_cert_id = $row['cert_id'];
                            $r_cert_title = $row['cert_title'];
                            $r_cert_description = $row['cert_description'];
                            $r_cert_media = $row['cert_media'];
                            $r_cert_date = date('M d, Y', strtotime($row['cert_date']));
                            $r_cert_uploaded = date('M d, Y', strtotime($row['cert_uploaded']));
                            $r_first_name = $row['first_name'];
                            $r_last_name = $row['last_name'];
                            $r_dep_name = $row['dep_name'];
                            echo
                            "<tr> 
                              <td class='text-center p-3'>" . $i++ . "</td>
                              <td class='text-center p-3 text-capitalize'> $r_cert_title </td>
                              <td class='text-center p-3 text-capitalize'> $r_cert_description </td>
                              <td class='text-center p-3'>";

                            // Check if cert_media field is empty or null
                            if (!empty($r_cert_media)) {
                              $imageSource = '';
                              if (strpos($_SERVER['HTTP_HOST'], 'localhost') !== false) {
                                $imageSource = '../PINEHR/' . substr($r_cert_media, 3);
                              } else {
                                $imageSource = '../pinesolutions.com/' . substr($r_cert_media, 3);
                              }
                              echo "<img src='" . $imageSource . "' style='width:150px; height: 80px; border: 2px solid #2468a0;'>";
                            } else {
                              // If cert_media is empty, display a placeholder image
                              echo "<img src='bgimages/blank.png' style='width:150px; height: 80px; border: 2px solid #2468a0;'>";
                            }
                          
                            echo "</td>
                                    <td class='text-center p-3 text-capitalize'> $r_cert_date </td>
                                    <td class='text-center p-3 text-capitalize'> $r_cert_uploaded </td>
                                    <td class='text-center p-1'>
                                    <div class='col-auto d-flex justify-content-center m-2'>
                                    <button type='button' class='py-1 px-2 me-1 btn btn-primary btn-sm view-certificate-btn' data-bs-toggle='modal' data-bs-target='#viewModal' data-media='$r_cert_media' data-cert-id='$r_cert_id' data-title='$r_cert_title' data-description='$r_cert_description'><i class='fas fa-eye'></i> View</button>
                                    </div>
                                  </td>
                            </tr>";
                          }
                      ?>
                    </tbody>
                  </table>
                </div>
                <?php } else { ?>
                  <div class="row" style="margin: 20px !important;">
                    <table class="table table-hover">
                      <thead>
                        <tr>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">#</th>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">Title</th>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">Description</th>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">Certificate</th>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">Acquired</th>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">Uploaded</th>
                          <th class="text-center p-1" style="background-color: rgb(255, 206, 46) !important;">Action</th>
                        </tr>
                      </thead>
                      <tbody>
                        <tr>
                          <td colspan="4" class="text-center font-weight-bold">No records found.</td>
                        </tr>
                      </tbody>
                    </table>
                  </div>
                <?php } ?>
              </div>
            </div>

            <!-- VIEW MODAL  -->
            <div class="modal" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
              <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                  <div class="modal-header">
                    <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-eye"></i>&nbsp;Certificate Details</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  <div class="modal-body" id="viewModalBody">
                    <!-- Content will be dynamically populated here -->
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  </div>
                </div>
              </div>
            </div>

            <script>
              $(document).ready(function() {
                $('.view-certificate-btn').click(function() {
                  var cert_id = $(this).data('cert-id');
                  console.log(cert_id);
                  $.ajax({
                    url: 'get_certificate_details.php',
                    type: 'POST',
                    data: {
                      cert_id: cert_id
                    },
                    success: function(response) {
                      $('#viewModalBody').html(response);
                    }
                  });
                });
              });
            </script>
          </div>
        </div>
      </div>
    </div>
  </div>
</body>
</html>
<script>
  $(document).ready(function () {
    $('#certificateTable').DataTable();
  })
</script>
<?php
  } else {
    header("Location: login.php");
    exit(); 
  }
?>