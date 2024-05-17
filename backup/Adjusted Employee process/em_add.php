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
    <script src="imoJS.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
    crossorigin="anonymous"></script>

    <link rel="stylesheet" href="dashboard2.css" />
    <link rel="stylesheet" text="text/css" href="" />

   
    <script src="https://kit.fontawesome.com/bac4e43ce9.js" crossorigin="anonymous"></script>

    <!--Designation Process Add and Update JS-->
   
    <script src="Employee/EmployeeJS.js"></script>

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
      if($_SESSION['s_user_id'] == 1 ){
        $query = "select * from user_type";
     
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
                <li><a href="em_list.php" style="font-family: 'Glacial Indifference';">Employee List</a></li>
                <li><a href="em_add.php" style="font-family: 'Glacial Indifference';">Add Employee</a></li>
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
          
        <a href="logout.php" id = "lougoutbtn" style="font-family: 'Glacial Indifference'; color: white;" data-bs-toggle="modal" data-bs-target="#exampleModal"><i class="fa fa-duotone fa-arrow-right-from-bracket"></i>&nbsp; Logout</a>
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
                    <a href="Designation.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
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


<form>
<div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;" >
        <strong>
        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</span></strong>
       </strong>
      </div><br>

    <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default" style="margin-left: 20px; width: 95%; box-shadow: 3px 5px 8px #2468a0;">
        <div class="panel-heading">
          <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add Employee</span></strong>
         </strong>
        </div>
        
        <div class="panel-body">
        
          <form method="post" action="em_add.php">
            <p id = "message" class = text-danger> </p>

            &nbsp;<strong><span>First Name</span></strong><br>
            <br><input type="text" class="form-control" placeholder="Employee's First Name" id = "first_name"
            aria-describedby="addon-wrapping"><br>

            &nbsp;<strong><span>Last Name</span></strong><br>
            <br><input type="text" class="form-control" placeholder="Employee's  Name" id = "last_name"
            aria-describedby="addon-wrapping"><br>

              <br><strong><span>Department</span></strong><br>
              <select class="form-select" id="dep_id" name="dep_id" required>
                <option <?php echo (!isset($dep_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $dep_qry = $conn->query("SELECT * FROM department order by dep_name asc");
                while($row= $dep_qry->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['dep_id'] ?>" <?php echo (isset($dep_id) && $dep_id == $row['dep_id'] ) ? 'selected' : '' ?>><?php echo $row['dep_name'] ?></option>
                <?php endwhile; ?>
              </select>
              
              <br><strong><span>Designation</span></strong><br>
              <select class="form-select" id="des_id" name="des_id" required>
                <option <?php echo (!isset($des_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $des_qry = $conn->query("SELECT * FROM designation order by des_name asc");
                while($row= $des_qry->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['des_id'] ?>" <?php echo (isset($des_id) && $des_id == $row['des_id'] ) ? 'selected' : '' ?>><?php echo $row['des_name'] ?></option>
                <?php endwhile; ?>
              </select>

              <br><strong><span>Role</span></strong><br>
              <select class="form-select" id="user_id" name="user_id" required>
                <option <?php echo (!isset($user_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $user_qry = $conn->query("SELECT * FROM user_type order by user_role asc");
                while($row= $user_qry->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['user_id'] ?>" <?php echo (isset($user_id) && $user_id == $row['user_id'] ) ? 'selected' : '' ?>><?php echo $row['user_role'] ?></option>
                <?php endwhile; ?>
              </select>

              &nbsp;<strong><span>Gender</span></strong><br>
            <br> <select class="form-select" id="em_gender" name="em_gender" style="width: 450px" required>
              <option <?php echo (!isset($em_gender)) ? 'selected' : '' ?> disabled>Please Select Here

            </option>
              <?php
              $em_qry = $conn->query("SELECT * FROM employee order by `em_gender` asc");
              while($row= $em_qry->fetch_assoc()):
              ?><option value="<?php echo $row['em_gender'] ?>" <?php echo (isset($em_gender) && $em_gender == $row['em_gender'] ) ? 'selected' : '' ?>><?php echo $row['em_gender'] ?></option>
              <?php endwhile; ?>
            </select>


            <br><strong><span>Bloodtype</span></strong><br>
              <select class="form-select" id="bt_id" name="bt_id" required>
                <option <?php echo (!isset($bt_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $bt_qry = $conn->query("SELECT * FROM blood_group order by bt_name asc");
                while($row= $bt_qry->fetch_assoc()):
                ?>
                  <option value="<?php echo $row['bt_id'] ?>" <?php echo (isset($bt_id) && $bt_id == $row['bt_id'] ) ? 'selected' : '' ?>><?php echo $row['bt_name'] ?></option>
                <?php endwhile; ?>
              </select>

              &nbsp;<strong><span>Contact Nmumber</span></strong><br>
            <br><input type="text" class="form-control" placeholder=" " id = "em_phone"
            aria-describedby="addon-wrapping"><br>

            &nbsp;<strong><span>Date of Birth</span></strong><br>
            <br><input type="date" class="form-control" placeholder=" " id = "em_birthday"
            aria-describedby="addon-wrapping"><br>

            &nbsp;<strong><span>Date of Joining</span></strong><br>
            <br><input type="date" class="form-control" placeholder=" " id = "em_joining_date"
            aria-describedby="addon-wrapping"><br>

            &nbsp;<strong><span>Date of Leaving</span></strong><br>
            <br><input type="date" class="form-control" placeholder="" id = "em_contract_end"
            aria-describedby="addon-wrapping"><br>

            &nbsp;<strong><span>Email</span></strong><br>
            <br><input type="text" class="form-control" placeholder="" id = "em_email"
            aria-describedby="addon-wrapping"><br>

            &nbsp;<strong><span>Image</span></strong><br>
            <br><input type="text" class="form-control" placeholder="" id = "em_image"
            aria-describedby="addon-wrapping"><br>



            
    
            <!-- Button trigger for saving modal -->
            <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style = "background-color: #2468a0; margin-left: -15px">
        Save 
        
        </button>&nbsp;</i>
        <a href="em_add2.php" ><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style =" margin-left: 5px"><i class="fa-solid fa-delete-left" style="color: #000000"></i>
        Cancel
        </button></a><br><br>
              
           

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
        <a href = "em_list.php"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
      </div>
    </div>
  </div>
</div>
           
            
        </form>
        </div>
      </div>
    </div>




    
 
 
 <!--cont LOGOUT Session -- -->
<?php
    }else{
        header("location: login.php");
        exit();
    }
?>
<!-- end of LOGOUT Session -->

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var first_name = button.getAttribute('data-first-name');// Extract info from data-* attributes
    var last_name = button.getAttribute('data-last-name');// Extract info from data-* attributes
    var dep_id = button.getAttribute('data-dep-id');
    var des_id = button.getAttribute('data-des-id');
    var user_id = button.getAttribute('data-user-id');
    var em_gender = button.getAttribute('data-em-gender');
    var bt_id = button.getAttribute('data-bt-id');
    var em_phone =  button.getAttribute('data-em-phone');
    var em_birthday =  button.getAttribute('data-em-birthday');
    var em_joining_date =  button.getAttribute('data-em-joining-date');
    var em_contract_end =  button.getAttribute('data-em-contract-end');
    var em_image =  button.getAttribute('data-em-image');
    



    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#first_name').value = first_name;
    modalBody.querySelector('#last_name').value = last_name;
    modalBody.querySelector('#dep_id').value = dep_id;
    modalBody.querySelector('#des_id').value = des_id;
    modalBody.querySelector('#user_id').value = user_id;
    modalBody.querySelector('#em_gender').value = em_gender;
    modalBody.querySelector('#bt_id').value = bt_id;
    modalBody.querySelector('#em_phone').value = em_phone;
    modalBody.querySelector('#em_birthday').value = em_birthday;
    modalBody.querySelector('#em_joining_date').value = em_joining_date;
    modalBody.querySelector('#em_contract_end').value = em_contract_end;
    modalBody.querySelector('#em_image').value = em_image;


  })
</script>
</table>
</form>







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

  