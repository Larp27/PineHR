<!--Declaration of user session -logout- -->
<?php
    session_start();
    include "DBConnection.php";
    if(isset($_SESSION['s_em_email'])){
      ?>
<!--cont logout session-->

<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Add Employee | PINE HR</title>
    
    <link rel = "stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
    <link rel = "stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">

    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    
    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="dashboard2.css" />
    <link rel="stylesheet" text="text/css" href="" />

   
    <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

    <!--Employee Process JS-->
    <script src="Employee/EmployeeJS.js"></script>


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
      if($_SESSION['s_user_id'] == 1){
     $query = "SELECT * from user_type";
     
     $result = mysqli_query($conn, $query);
    }
    ?>
 <!-- cont LOGOUT Session  -- -->

    <div id = "dashmaincontainer">
      <div class = "dash_sidebar" id = "dash_sidebar">
        <div class = "dash_sidebar_menus">  
        <br>
        <center><a href = "Dashboard.php">
        <img src="bgimages/pine.png" alt="logo" style="width: 150px;height: 135px;margin-top: -15px; margin-left: -8px">
        </a>
        </center>
        <br>
          
        <nav class="sidebar">
          <ul>
            <li><a href="Dashboard.php" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-gauge fa-spin fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Dashboard</a></li>
            <li>
              <a href="#" class="req-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-landmark fa-2xl" style="color: #2468a0; "></i>&nbsp;&nbsp;&nbsp;&nbsp;Organization
                <span class="fas fa-caret-down first"></span>
              </a>
              <ul class="req-show">
                <li><a href="Department_list.php" style="font-family: 'Glacial Indifference';">Department</a></li>
                <li><a href="Designation_list.php" style="font-family: 'Glacial Indifference';">Designation</a></li>
              </ul>
            </li>
            <li class="active">
              <a href="#" class="ann-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Employees
                <span class="fas fa-caret-down third"></span>
              </a>
              <ul class="ann-show">
                <li><a href="em_status.php" style="font-family: 'Glacial Indifference';">Employment Status</a></li>
                <li><a href="Salary.php" style="font-family: 'Glacial Indifference';">Salary Info</a></li>
                <li><a href="em_list.php" style="font-family: 'Glacial Indifference';">Employee List</a></li>
              </ul>
            </li>
            <li>
              <a href="#" class="rep-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-user-large-slash fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;LEAVE
                <span class="fas fa-caret-down fourth"></span>
              </a>
              <ul class="rep-show">
                <li><a href="Leave_type_list.php" style="font-family: 'Glacial Indifference';">Leave Type</a></li>
                <li><a href="Leave_app.php" style="font-family: 'Glacial Indifference';">Leave Application</a></li>
              </ul>
            </li>
            <li>
              <a href="" class="main-btn" style="font-family: 'Glacial Indifference';">&nbsp;<i class=" fa-solid fa-rectangle-list fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;REPORTS
              </a>
            </li>
           
           
          
            </form>
          </ul>
        </nav>
      
        </div>
      </div>
      <div class ="dash_content_container" id = "dash_content_container">
        <div class = "dash_topnav" id = "dash_topnav">
        <a href="" id ="togglebtn"><i class ="fa-solid fa-bars"></i></a>   <h10 style="font-family: 'Glacial Indifference';">&nbsp; Welcome <?php echo $_SESSION['s_first_name'];  ?> <?php echo $_SESSION['s_last_name'];?>!</h10>
          
        <a href="logout.php" id = "lougoutbtn" style="font-family: 'Glacial Indiffernce'; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-duotone fa-arrow-right-from-bracket"></i>&nbsp; Logout</a>
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
                    <a href="em_add.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
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

      if(sideBarIsOpen){
      dash_sidebar.style.width = '0%';
      dash_sidebar.style.transition ='0.3s all';
      dash_content_container.style.width ='100%';
      sideBarIsOpen = false;
    } else {
      
      dash_sidebar.style.width = '15%';
      dash_sidebar.style.height = 'auto';
      dash_content_container.style.width ='100%';
      sideBarIsOpen = true;
    }
    });
  </script>


<!--Gawas sa navbar-->
<form>
<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
        &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Employee</span></strong>
       </strong>
      </div><br><br>

    <div class="row">
    <div class="col-md-5" style="width: 100%">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
          &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-user-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add New Employee</span></strong>
         </strong>
        </div>
        
        <div class="panel-body">
        
          <form method="post" action="em_add.php">
            <p id = "message" class = text-danger> </p>

            

            <?php

      $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id INNER JOIN `user_type` ut ON ut.user_id = e.user_id";

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
          $r_em_image = $row['em_image'];
      
?>
      <?php
      } 
      ?>
           
            <!--First Column-->
            <table class="table">
            <tr>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">First Name</span></strong>
            <input type="text" class="form-control" placeholder="Employee's First Name" id = "first_name" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Last Name</span></strong>
            <input type="text" class="form-control" placeholder="Employee's Last Name" id = "last_name" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Department</span></strong>
            <select class="form-select" id="dep_name" name="dep_name" required>
              <option <?php echo (!isset($dep_name)) ? 'selected' : '' ?> disabled>Please Select Here

              <!--Space-->
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            
              </option>
              <?php
              $de_qry = $conn->query("SELECT * FROM department order by `dep_name` asc");
              while($row= $de_qry->fetch_assoc()):
              ?><option value="<?php echo $row['dep_name'] ?>" <?php echo (isset($dep_name) && $dep_name == $row['dep_name'] ) ? 'selected' : '' ?>><?php echo $row['dep_name'] ?></option>
              <?php endwhile; ?>
              </select>
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Designation</span></strong>
            <select class="form-select" id="des_name" name="des_name" required>
              <option <?php echo (!isset($des_name)) ? 'selected' : '' ?> disabled>Please Select Here
              
              <!--Space-->
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            
              </option>
              <?php
              $de_qry = $conn->query("SELECT * FROM designation order by `des_name` asc");
              while($row= $de_qry->fetch_assoc()):
              ?><option value="<?php echo $row['des_name'] ?>" <?php echo (isset($des_name) && $des_name == $row['des_name'] ) ? 'selected' : '' ?>><?php echo $row['des_name'] ?></option>
              <?php endwhile; ?>
              </select>
            </th>
            
            </table>
          
            
            <!--Second Column-->
            <table class="table">
            
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Role</span></strong>
            <select class="form-select" id="user_role" name="user_role" required>
              <option <?php echo (!isset($des_name)) ? 'selected' : '' ?> disabled>Please Select Here
              
              <!--Space-->
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            
              </option>
              <?php
              $de_qry = $conn->query("SELECT * FROM user_type order by `user_role` asc");
              while($row= $de_qry->fetch_assoc()):
              ?><option value="<?php echo $row['user_role'] ?>" <?php echo (isset($user_role) && $user_role == $row['user_role'] ) ? 'selected' : '' ?>><?php echo $row['user_role'] ?></option>
              <?php endwhile; ?>
              </select>
            </th>

            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Gender</span></strong>
            <select class="form-select" id="em_gender" name="em_gender" style="width: 450px" required>
              <option <?php echo (!isset($em_gender)) ? 'selected' : '' ?> disabled>Please Select Here
            
              <!--Space-->
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 

            </option>
              <?php
              $em_qry = $conn->query("SELECT * FROM employee order by `em_gender` asc");
              while($row= $em_qry->fetch_assoc()):
              ?><option value="<?php echo $row['em_gender'] ?>" <?php echo (isset($em_gender) && $em_gender == $row['em_gender'] ) ? 'selected' : '' ?>><?php echo $row['em_gender'] ?></option>
              <?php endwhile; ?>
            </select>
            </th>


            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Blood Group</span></strong>
            <select class="form-select" id="bt_name" name="bt_name" style="width: 500px" required>
              <option <?php echo (!isset($bt_name)) ? 'selected' : '' ?> disabled>Please Select Here

            <!--Space-->
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; 
            
            </option>
              <?php
              $em_qry = $conn->query("SELECT * FROM `blood_group` order by `bt_name` desc");
              while($row= $em_qry->fetch_assoc()):
              ?><option value="<?php echo $row['bt_name'] ?>" <?php echo (isset($bt_name) && $bt_name == $row['bt_name'] ) ? 'selected' : '' ?>><?php echo $row['bt_name'] ?></option>
              <?php endwhile; ?>
              </select>
            </th>
            </table>
          
            <!--Third Column-->
            <table class="table">
            <tr>  
                <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Contact Number</span></strong>
            <input type="text" class="form-control" placeholder="ex.09123456789" id = "em_phone" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Date of Birth</span></strong>
            <input type="text" class="form-control" placeholder="Type here" id = "emp_birthday" style="width: 370px">
            </th><br>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Date of Joining</span></strong>
            <input type="date" id="em_joining_date" class="form-control" name="em_joining_date" style="width: 370px" required >
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Date of Leaving</span></strong>
            <input type="date" id="em_contract_end" class="form-control" name="em_contract_end" style="width: 370px" required >
            </th>
            </table>
          
             <!--Fourth Column-->
             <table class="table">
           
             <tr>  
                <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Email</span></strong>
            <input type="text" class="form-control" placeholder="email@email.com" id = "em_email" style="width: 370px">
            </th> <br>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'">Image</span></strong>
            <input type="text" class="form-control" placeholder="Type here" id = "em_image" style="width: 370px; margin-right: 770px">
            </th>
          
            </tr>
           
            <th> <br><br><br><br><br>
            <!-- Button trigger for saving modal -->
            <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success btn-lg" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style = "background-color: #2468a0;margin-left: 15px"></i>
                 Save 
                 </button>&nbsp;
            </th>
            <th> <br><br><br><br><br>
            <a href="em_add.php"><button type="button" class="btn btn-warning btn-lg" data-toggle="modal" data-target="#exampleModalCenter" style ="margin-left: -235px"><i class="fa-solid fa-delete-left" style="color: #000000;"></i>
                 Clear
                 </button></a>
            </th>
                  
                    </thead>
              </table>
<!-- Verification Modal -->
<div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>
     
      </div>
      <div class="modal-body">
      &nbsp;&nbsp;New Employee Added!. Thank you.
      </div>
      <div class="modal-footer">
        <a href = "em_list.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
      </div>
    </div>
  </div>
</div>
            
      
        
        </div>
      </div>
    </div>








<!-- Modal sa Update Button -->
<div>
 <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Employee</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
        <div class="mb-3">
            <input type="hidden" class="form-control" id="em_id" name="em_id">
          </div>
          <div class="mb-3">
            <label for="first_name" class="form-label">&nbsp;Employee's First Name</label>
            <input type="text" class="form-control" id="first_name" name="first_name">
          </div>
          <div class="mb-3">
            <label for="last_name" class="form-label">&nbsp;Employee's Last Name</label>
            <input type="text" class="form-control" id="last_name" name="last_name">
          </div>
          <!--Gender Call-->
          <div class="mb-3">
            <label for="em_gender" class="form-label">&nbsp;Gender</label>
            <select class="form-select" id="em_gender" name="em_gender" required>
              <option <?php echo (!isset($em_gender)) ? 'selected' : '' ?> disabled>Please Select Here</option>
              <?php
              $em_qry = $conn->query("SELECT * FROM employee order by `em_gender` asc");
              while($row= $em_qry->fetch_assoc()):
              ?><option value="<?php echo $row['em_gender'] ?>" <?php echo (isset($em_gender) && $em_gender == $row['em_gender'] ) ? 'selected' : '' ?>><?php echo $row['em_gender'] ?></option>
              <?php endwhile; ?>
              </select>
          </div>
          
          <!--Designation Call-->
          <div class="mb-3">
            <label for="des_name" class="form-label">&nbsp;Designation</label>
            <select class="form-select" id="des_name" name="des_name" required>
              <option <?php echo (!isset($des_name)) ? 'selected' : '' ?> disabled>Please Select Here</option>
              <?php
              $de_qry = $conn->query("SELECT * FROM designation order by `des_name` asc");
              while($row= $de_qry->fetch_assoc()):
              ?><option value="<?php echo $row['des_name'] ?>" <?php echo (isset($des_name) && $des_name == $row['des_name'] ) ? 'selected' : '' ?>><?php echo $row['des_name'] ?></option>
              <?php endwhile; ?>
              </select>
          </div>
            
           <!--Bloodtype Call-->
           <div class="mb-3">
            <label for="dep_name" class="form-label">&nbsp;Department</label>
            <select class="form-select" id="dep_name" name="dep_name" required>
              <option <?php echo (!isset($dep_name)) ? 'selected' : '' ?> disabled>Please Select Here</option>
              <?php
              $de_qry = $conn->query("SELECT * FROM department order by `dep_name` asc");
              while($row= $de_qry->fetch_assoc()):
              ?><option value="<?php echo $row['dep_name'] ?>" <?php echo (isset($dep_name) && $dep_name == $row['dep_name'] ) ? 'selected' : '' ?>><?php echo $row['dep_name'] ?></option>
              <?php endwhile; ?>
              </select>
          </div>

         <!--Bloodtype Call-->
          <div class="mb-3">
            <label for="bt_name" class="form-label">&nbsp;Bloodtype</label>
            <select class="form-select" id="bt_name" name="bt_name" required>
              <option <?php echo (!isset($bt_name)) ? 'selected' : '' ?> disabled>Please Select Here</option>
              <?php
              $em_qry = $conn->query("SELECT * FROM `blood_group` order by `bt_name` asc");
              while($row= $em_qry->fetch_assoc()):
              ?><option value="<?php echo $row['bt_name'] ?>" <?php echo (isset($bt_name) && $bt_name == $row['bt_name'] ) ? 'selected' : '' ?>><?php echo $row['bt_name'] ?></option>
              <?php endwhile; ?>
              </select>
          </div>

          <div class="mb-3">
            <label for="em_email" class="form-label">&nbsp;Employee's Email</label>
            <input type="text" class="form-control" id="em_email" name="em_email">
          </div>
          <div class="mb-3">
            <label for="em_phone" class="form-label">&nbsp;Employee's Phone</label>
            <input type="text" class="form-control" id="em_phone" name="em_phone">
          </div>
          <div class="mb-3">
            <label for="em_birthday" class="form-label">&nbsp;Employee's Birthday</label>
            <input type="text" class="form-control" id="em_birthday" name="em_birthday">
          </div>
          <div class="mb-3">
            <label for="em_role" class="form-label">&nbsp;Role</label>
            <input type="text" class="form-control" id="em_role" name="em_role">
          </div>
          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateEmployee">Update</button>
          </form>
      </div>
    </div>
  </div>
</div>

 </div>       
        
</body> 
      
    </table>

    <script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var em_id = button.getAttribute('data-em_id'); // Extract info from data-* attributes
    var first_name = button.getAttribute('data-first_name');
    var last_name = button.getAttribute('data-last_name');
    var em_gender = button.getAttribute('data-em_gender');
    var des_name = button.getAttribute('data-des_name');
    var dep_name = button.getAttribute('data-dep_name');
    var bt_name = button.getAttribute('data-bt_name');
    var em_email = button.getAttribute('data-em_email');
    var em_phone = button.getAttribute('data-em_phone');
    var em_birthday = button.getAttribute('em_birthday');
    var em_role = button.getAttribute('user_role');



    // Update the modal's content
    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#em_id').value = em_id;
    modalBody.querySelector('#first_name').value = first_name;
    modalBody.querySelector('#last_name').value = last_name;
    modalBody.querySelector('#em_gender').value = em_gender;
    modalBody.querySelector('#des_name').value = des_name;
    modalBody.querySelector('#dep_name').value = dep_name;
    modalBody.querySelector('#bt_name').value = bt_name;
    modalBody.querySelector('#em_email').value = em_email;
    modalBody.querySelector('#em_phone').value = em_phone;
    modalBody.querySelector('#em_birthday').value = em_birthday;
    modalBody.querySelector('#user_role').value = user_role;
   
  })
</script>


































    <!--cont LOGOUT Session -- -->
<?php
    }else{
        header("location: login.php");
        exit();
    }
?>
<!-- end of LOGOUT Session -->







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
  
  
    $('.req-btn').click(function(){
      $('nav ul .req-show').toggleClass("show1");
      $('nav ul .first').toggleClass("rotate");
    });
  
    $('.main-btn').click(function(){
      $('nav ul .main-show').toggleClass("show2");
      $('nav ul .second').toggleClass("rotate");
    });
  
    $('.ann-btn').click(function(){
      $('nav ul .ann-show').toggleClass("show3");
      $('nav ul .third').toggleClass("rotate");
    });
  
    $('.rep-btn').click(function(){
      $('nav ul .rep-show').toggleClass("show4");
      $('nav ul .fourth').toggleClass("rotate");
    });

    $('.not-btn').click(function(){
      $('nav ul .not-show').toggleClass("show5");
      $('nav ul .fifth').toggleClass("rotate");
    });
  
    $('nav ul li').click(function(){
      $(this).addClass("active").siblings().removeClass("active");
    });
    </script>
</body>
</html>

  