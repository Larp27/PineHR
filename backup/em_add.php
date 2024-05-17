<?php
    session_start();
    include('DBConnection.php');

  ?>

<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Employee| PINE HR</title>
    
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

  <?php
 if($_SESSION['s_status'] == 'SUPER ADMIN') 
 ?>

    <div id = "dashmaincontainer">
      <div class = "dash_sidebar" id = "dash_sidebar">
        <div class = "dash_sidebar_menus">  
        <br>
        <center><a href = "Dashboard.php">
        <img src="bgimages/pine.png" alt="logo" style="width: 150px;height: 135px;margin-top: -25px; margin-left: -8px">
        </a>
        </center>
          
        <ul class = "dash_menu_lists" type = "none">
       
        
            <li class = "menuactive">

              <a href ="Dashboard.php">&nbsp;&nbsp;&nbsp;<i class="fa fa-solid fa-gauge-high" href="Dashboard.php"></i>&nbsp; Dashboard</a>
            </li>
                    <li>
                      <div class="">
                        <a class="nav-link btn btn-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">Organization</a>
                        <ul class="dropdown-menu" aria-labelledby="drowndownMenuButton1">
                        <li><a class="dropdown-item" href ="Department.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Department</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Designation</a>
                        </li>
                      </ul>
                      <div>
                    </li>
                    <li>
                      <div class="">
                        <a class="nav-link btn btn-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">Employees</a>
                        <ul class="dropdown-menu" aria-labelledby="drowndownMenuButton1">
                        <li><a class="dropdown-item" href ="Department.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Employees</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Disciplinary</a>
                        </li>
                      </ul>
                      <div>
                    </li>        
                    <li>
                      <div class="">
                        <a class="nav-link btn btn-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">Attendance</a>
                        <ul class="dropdown-menu" aria-labelledby="drowndownMenuButton1">
                        <li><a class="dropdown-item" href ="Department.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Attendance List</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Reports</a>
                        </li>
                      </ul>
                      <div>
                    </li>    
                    <li>
                      <div class="">
                        <a class="nav-link btn btn-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">Leave</a>
                        <ul class="dropdown-menu" aria-labelledby="drowndownMenuButton1">
                        <li><a class="dropdown-item" href ="Department.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Leave Type</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Leave Application</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Earned Leave</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Report</a>
                        </li>
                      </ul>
                      <div>
                    </li>
                    <li>
                      <div class="">
                        <a class="nav-link btn btn-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">Payroll</a>
                        <ul class="dropdown-menu" aria-labelledby="drowndownMenuButton1">
                        <li><a class="dropdown-item" href ="Department.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Payroll List</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Reports</a>
                        </li>
                      </ul>
                      <div>
                    </li>           
                    <li>
                      <div class="">
                        <a class="nav-link btn btn-secondary dropdown-toggle"
                        data-bs-toggle="dropdown" aria-expanded="false">Announcements</a>
                        <ul class="dropdown-menu" aria-labelledby="drowndownMenuButton1">
                        <li><a class="dropdown-item" href ="Department.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Notice</a>
                        </li>
                        <li><a class="dropdown-item" href ="Designation.php">&nbsp;&nbsp;&nbsp;<i class="fa-solid fa-cart-shopping"></i>&nbsp; Holidays</a>
                        </li>
                      </ul>
                      <div>
                    </li>      
                        
                    
        </ul>
        </div>
      </div>
      <div class ="dash_content_container" id = "dash_content_container">
        <div class = "dash_topnav" id = "dash_topnav">
          <a href="" id ="togglebtn"><i class ="fa-solid fa-bars"></i></a>   <h10>&nbsp; Welcome, <?php echo $_SESSION['s_last_name'];  ?>!</h10>
          
          <a href="logout.php" id = "lougoutbtn"><i class="fa fa-duotone fa-arrow-right-from-bracket"></i>&nbsp; Logout</a>
        </div>
      

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
      <div class="panel-heading">
        <strong>
        &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Employee</span></strong>
       </strong>
      </div><br><br>

    <div class="row">
    <div class="col-md-5" style="width: 100%">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
          &nbsp;&nbsp;&nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-user-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add New Employee</span></strong>
         </strong>
        </div>
        
        <div class="panel-body">
        
          <form method="post" action="em_add.php">
            <p id = "message" class = text-danger> </p>

            

            <?php

      $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id";

      $result = mysqli_query($conn, $query);
      while($row = mysqli_fetch_assoc($result)){
        
          $r_em_id = $row['em_id'];
          $r_first_name = $row['first_name'];
          $r_last_name = $row['last_name'];
          $r_dep_name = $row['dep_name'];
          $r_des_name = $row['des_name'];
          $r_em_nid = $row['em_nid'];
          $r_em_role = $row['em_role'];
          $r_em_gender = $row['em_gender'];
          $r_em_blood_group = $row['em_blood_group'];
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
            <input type="text" class="form-control" placeholder="Select Department" id = "dep_name" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Designation</span></strong>
            <input type="text" class="form-control" placeholder="Select Designation" id = "des_name" style="width: 370px">
            </th>
            
            </table>
          
            
            <!--Second Column-->
            <table class="table">
            <tr><th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Employee NID</span></strong>
            <input type="text" class="form-control" placeholder="(Max. 10)" id = "em_nid" style="width: 370px">
            </th><br>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Role</span></strong>
            <input type="text" class="form-control" placeholder="Select Role" id = "em_role" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Gender</span></strong>
            <input type="text" class="form-control" placeholder="Select Gender" id = "em_gender" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Blood Group</span></strong>
            <input type="text" class="form-control" placeholder="Select Blood Group" id = "em_blood_group" style="width: 370px">
            </th>
            </table>
          
            <!--Third Column-->
            <table class="table">
            <tr>  
                <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Contact Number</span></strong>
            <input type="text" class="form-control" placeholder="ex.09123456789" id = "em_phone" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Date of Birth</span></strong>
            <input type="text" class="form-control" placeholder="Type here" id = "emp_birthday" style="width: 370px">
            </th><br>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Date of Joining</span></strong>
            <input type="text" class="form-control" placeholder="Type here" id = "em_joining_date" style="width: 370px">
            </th>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Date of Leaving</span></strong>
            <input type="text" class="form-control" placeholder="Type here" id = "em_contract_end" style="width: 370px">
            </th>
            </table>
          
             <!--Fourth Column-->
             <table class="table">
           
             <tr>  
                <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Email</span></strong>
            <input type="text" class="form-control" placeholder="email@email.com" id = "em_email" style="width: 370px">
            </th> <br>
            <th>  &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Image</span></strong>
            <input type="text" class="form-control" placeholder="Type here" id = "em_image" style="width: 370px; margin-right: 770px">
            </th>
          
            </tr>
           
            <th> <br><br>
            <!-- Button trigger for saving modal -->
                <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style = "background-color: #2468a0">
                 Save 
                 </button>&nbsp;
            </th>
            <th> <br><br>
            <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style ="margin-left: -320px">
                 Cancel
                 </button>
            </th>
                  
                    </thead>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
    crossorigin="anonymous"></script>
  </form>