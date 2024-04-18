<?php
    session_start();
    include('DBConnection.php');

  ?>

<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>Department | PINE HR</title>
    
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
        &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Department</span></strong>
       </strong>
      </div><br>

    <div class="row">
    <div class="col-md-5">
      <div class="panel panel-default">
        <div class="panel-heading">
          <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add Department</span></strong>
         </strong>
        </div>
        
        <div class="panel-body">
        
          <form method="post" action="Department.php">
            <p id = "message" class = text-danger> </p>

            &nbsp;<strong><span>Department Name</span></strong><br>
            <br><input type="text" class="form-control" placeholder="Type here" id = "dep_name"
            aria-describedby="addon-wrapping"><br>
            
    
            <!-- Button trigger for saving modal -->
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style = "background-color: #2468a0">
        Save 
        </button>&nbsp;
        <a href="Department.php"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose">
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
      &nbsp;&nbsp;New Department Added!. Thank you.
      </div>
      <div class="modal-footer">
        <a href = "Department.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
      </div>
    </div>
  </div>
</div>
           
            
        </form>
        </div>
      </div>
    </div>




    <div class="col-md-7">
    <div class="panel panel-default">
      <div class="panel-heading">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Department List</span></strong>
       </strong>
      </div>
      
      <form>

<div class ="dash_content">
<div class ="dash_content_main">



<table class="table">
  <thead class="" style ="background-color: rgb(255, 206, 46)">
    <tr>
      <th class="text-center p-0">Department Name</th>
      <th class="text-center p-0">Actions</th>
      <th class="text-center p-0"></th>
    </tr>
    </thead>
 
        <?php
       $query = "SELECT * from department";

       $result = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($result)){

            $r_dep_id = $row['dep_id'];
            $r_dep_name = $row['dep_name'];

            echo "<tr> 
                
                    <td class='text-center p-3'> $r_dep_name </td>";
                    ?>
                    <!-- EDIT AND DELETE -->
                    <td class='text-center p-3'>
                      <div class="col-auto d-flex justify-content-center m-2">
                        <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn"  data-bs-toggle="modal" data-bs-target="#updateUserModal" data-dep-id="<?php echo $row['dep_id']; ?>" data-department-name="<?php echo $row['dep_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                        <a href="Department/deleteDEPT.php?dep_id=<?php echo $row['dep_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Department?')"><i class="fas fa-trash"></i> Delete </a>
                      </div>
                    </td>
                    
                  
                    
            </tr>
        <?php
       }
        ?>

<!-- Modal sa Update Button -->
 <div>
 <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Department</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
        <div class="mb-3">
            <input type="hidden" class="form-control" id="dep_id" name="dep_id">
          </div>
          <div class="mb-3">
            <label for="update_dep_name" class="form-label">&nbsp;Department Name</label>
            <input type="text" class="form-control" id="update_dep_name" name="dep_name">
          </div>
          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateDepartment">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

 </div>       

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var dep_id = button.getAttribute('data-dep-id');// Extract info from data-* attributes
    var dep_name = button.getAttribute('data-dep-name');// Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#dep_id').value = dep_id;
    modalBody.querySelector('#dep_name').value = dep_name;
    
  })
</script>
        
</body> 
      

    </table>