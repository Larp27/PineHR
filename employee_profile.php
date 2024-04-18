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
              <a class="nav-link active" aria-current="page" href="employee_profile.php">Profile</a>
            </li>
            <li class="nav-item dropdown">
              <a class="nav-link dropdown-toggle" data-bs-toggle="dropdown" href="#" role="button" aria-expanded="false">Leave</a>
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

                // Disable the "Application" dropdown item if necessary
                $application_disabled = ($leave_credit_count == 0 || $all_credits_zero) ? 'disabled' : '';

                // Determine the tooltip message
                $tooltip_message = "";
                if ($leave_credit_count == 0) {
                  $tooltip_message = "You have no employee leave credits.";
                } elseif ($all_credits_zero) {
                  $tooltip_message = "All your leave types have zero available credits.";
                }

                // Output the dropdown items with tooltip
                echo '<li data-bs-toggle="tooltip" data-bs-placement="top" title="' . $tooltip_message . '"><a class="dropdown-item ' . $application_disabled . '" href="employee_application.php" >Application</a></li>';
                ?>
                <li><a class="dropdown-item" href="./employee_app_list.php">List</a></li>
              </ul>
            </li>
          </ul>

          <div class="panel panel-default">
            <div class="panel-heading">
              <strong>
                &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-house fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Profile</span></strong>
              </strong>
            </div>
              

              

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

      <form>
  <div class="col-md-12">
    <div class="panel panel-default" >
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;" >
       
      &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</span></strong>
      
      </div><br>

    <div class="col-md-7" style="width: 100%">
    <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
      <div class="panel-heading">
        
      

      &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Profile</span></strong>
      
      <!-- PHP for triggering modal -->

      <?php
    $em_id = $_SESSION['s_em_id'];
    if ($_SESSION['s_user_id'] == 1) {
        $query = "Select * from employee where em_id = $em_id";

      $result = mysqli_query($conn, $query);
    }
    ?>
      <?php if($_SESSION['s_user_id'] == 1 ){
     $query = "select * from user_type";
     
     $result = mysqli_query($conn, $query);
    }
    { echo '<a href="em_add.php"><i><button type="button" class="btn btn-success" style = "margin-left: 1155px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Employee +</button> </a>';}
    ?>


      </div>

      <?php
        $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id INNER JOIN `user_type` ut ON ut.user_id = e.user_id INNER JOIN `employment_status` es ON es.es_id = e.es_id";
       $result = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($result)){

            $r_em_id = $row['em_id'];
            $r_em_gender = $row['em_gender'];
            $r_first_name = $row['first_name'];
            $r_last_name = $row['last_name'];
            $r_des_name = $row['des_name'];
            $r_dep_name = $row['dep_name'];
            $r_es_name = $row['es_name'];
            $r_bt_name = $row['bt_name'];
            $r_em_phone = $row['em_phone'];
            $r_em_birthday = $row['em_birthday'];
            $r_user_role = $row['user_role'];
            $r_em_address = $row['em_address'];

            
                    ?> <?php }?>

      


<table class="table info-table">
            <tr class='boder-0'>
                <td width="10%">
                    
                </td>
                <td width="90%" class='boder-0 align-bottom'>
                    <div class="row">
                        <div class="col-12">
                            <div class="d-flex w-max-100">
                                <label class="float-left w-auto whitespace-nowrap">Employee ID:</label>
                                <p class="col-md-auto border-bottom border-dark w-100"><b><?php echo  $r_em_id ?></b></p>
                            </div>
                            <div class="d-flex w-max-100">
                                <label class="float-left w-auto whitespace-nowrap">Name:</label>
                                <p class="col-md-auto border-bottom border-dark w-100"><b><?php echo $r_first_name,  $r_last_name?></b></p>
                            </div>
                            <div class="row justify-content-between  w-max-100 mr-0">
                                <div class="col-6 d-flex w-max-100">
                                    <label class="float-left w-auto whitespace-nowrap">Birthdate: </label>
                                    <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo date("M d, Y",strtotime($r_em_birthday)) ?></b></p>
                                </div>
                                <div class="col-6 d-flex w-max-100">
                                    <label class="float-left w-auto whitespace-nowrap">Contact No.: </label>
                                    <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo  $r_em_phone ?></b></p>
                                </div>
                            </div>
                            <div class="d-flex w-max-100">
                                <label class="float-left w-auto whitespace-nowrap">Address:</label>
                                <p class="col-md-auto border-bottom border-dark w-100"><b><?php echo $r_em_address ?></b></p>
                            </div>
                            <div class="row justify-content-between  w-max-100  mr-0">
                                <div class="col-6 d-flex w-max-100">
                                    <label class="float-left w-auto whitespace-nowrap">Department: </label>
                                    <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo $r_dep_name ?></b></p>
                                </div>
                                <div class="col-6 d-flex w-max-100">
                                    <label class="float-left w-auto whitespace-nowrap">Designation: </label>
                                    <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo $r_des_name ?></b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </td>
            </tr>
        </table>
        
        
<!--cont LOGOUT Session -- -->
<?php
    }else{
        header("location: login.php");
        exit();
    }
?>
<!-- end of LOGOUT Session -->
<?php

$query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id INNER JOIN `user_type` ut ON ut.user_id = e.user_id INNER JOIN `employment_status` es ON es.es_id = e.es_id";

$result = mysqli_query($conn, $query);
while($row = mysqli_fetch_assoc($result)){
  
    $r_em_id = $row['em_id'];
    $r_first_name = $row['first_name'];
    $r_last_name = $row['last_name'];
    $r_dep_name = $row['dep_name'];
    $r_des_name = $row['des_name'];
    $r_user_role = $row['user_role'];
    $r_em_gender = $row['em_gender'];
    $r_bt_name = $row['bt_name'];
    $r_em_phone = $row['em_phone'];
    $r_em_birthday = $row['em_birthday'];
    $r_em_joining_date = $row['em_joining_date'];
    $r_em_contract_end = $row['em_contract_end'];
    $r_em_email = $row['em_email'];
    $r_em_password = $row['em_password'];

?>
<?php
} 
?>
    </div>
     
    
        
    
<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var em_id = button.getAttribute('data-em-id');// Extract info from data-* attributes
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
  })
</script>




<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
    crossorigin="anonymous"></script>


    <!--Javascript Dashboard-->

    <script>    
      $('.sidebar-btn').click(function () {
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
  
  
    $('.org-btn').click(function(){
      $('nav ul .org-show').toggleClass("show1");
      $('nav ul .first').toggleClass("rotate");
    });
  
    $('.rep-btn').click(function(){
      $('nav ul .rep-show').toggleClass("show2");
      $('nav ul .second').toggleClass("rotate");
    });
  
    $('.emp-btn').click(function(){
      $('nav ul .emp-show').toggleClass("show3");
      $('nav ul .third').toggleClass("rotate");
    });
  
    $('.lev-btn').click(function(){
      $('nav ul .lev-show').toggleClass("show4");
      $('nav ul .fourth').toggleClass("rotate");
    });

    $('.not-btn').click(function(){
      $('nav ul .not-show').toggleClass("show5");
      $('nav ul .fifth').toggleClass("rotate");
    });
  
    $('nav ul li').click(function(){
      $(this).addClass("active").siblings().removeClass("active");
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })
    </script>

	<script src="Employee/updateEM.js"></script>
</body>
</html>