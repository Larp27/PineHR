<?php
    session_start();
    include('DBConnection.php');

  ?>

<!DOCTYPE html>
  <html lang="en">
    <head>
    <meta charset="UTF-8">
    <title>DASHBOARD | PINE HR</title>
    
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

    <!--Employee Process Update JS-->
    <script src="Employee/updateEM.js"></script>

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
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading">
       
          <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></strong></i>&nbsp;&nbsp;Employee</span>
      
      </div><br>

    <div class="col-md-7" style="width: 100%">
    <div class="panel panel-default">
      <div class="panel-heading">
        
          <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-xl" style="color: #2468a0;"></strong></i>&nbsp;&nbsp;Employee List</span>
      
      </div>
      
      <form>

<div class ="dash_content">
<div class ="dash_content_main">


<table id="example" class="table">
<colgroup>
    <col width="15%">
    <col width="15%">
    <col width="15%">
    <col width="10%">
    <col width="10%">
    <col width="10%">
    <col width="10%">
    <col width="10%">
    <col width="10%">
  </colgroup>
  <thead class="" style ="background-color: rgb(255, 206, 46)">
    <tr>
      <th class="text-center p-0">Employee Name</th>
      <th class="text-center p-0">Gender</th>
      <th class="text-center p-0">Designation</th>
      <th class="text-center p-0">Department</th>
      <th class="text-center p-0">Blood Type</th>
      <th class="text-center p-0">Email</th>
      <th class="text-center p-0">Contact No.</th>
      <th class="text-center p-0">User Type</th>
      <th class="text-center p-0">Actions</th>
      <th class="text-center p-0"></th>
    </tr>
    </thead>
 
        <?php
        $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id";

       $result = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($result)){

            $r_em_id = $row['em_id'];
            $r_em_gender = $row['em_gender'];
            $r_first_name = $row['first_name'];
            $r_last_name = $row['last_name'];
            $r_des_name = $row['des_name'];
            $r_dep_name = $row['dep_name'];
            $r_em_blood_group = $row['em_blood_group'];
            $r_em_email = $row['em_email'];
            $r_em_phone = $row['em_phone'];
            $r_em_birthday = $row['em_birthday'];
            $r_em_role = $row['em_role'];

            echo "<tr> 
                    <td class='text-center p-3'> $r_last_name, $r_first_name </td>
                    <td class='text-center p-3'> $r_em_gender </td>
                    <td class='text-center p-3'> $r_des_name </td>
                    <td class='text-center p-3'> $r_dep_name </td>
                    <td class='text-center p-3'> $r_em_blood_group </td>
                    <td class='text-center p-3'> $r_em_email </td>
                    <td class='text-center p-3'> $r_em_phone </td>
                    <td class='text-center p-3'> $r_em_birthday </td>
                    <td class='text-center p-3'> $r_em_role </td>";
                    ?>

                    <!-- EDIT AND DELETE -->
                    <td class='text-center p-3'>
                      <div class="col-auto d-flex justify-content-center m-2">
                        <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn"  data-bs-toggle="modal" data-bs-target="#updateUserModal" data-dep-id="<?php echo $row['dep_id']; ?>" data-department-name="<?php echo $row['dep_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                        <a href="Employee/deleteEM.php?em_id=<?php echo $row['em_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this Employee?')"><i class="fas fa-trash"></i> Remove </a>
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
            <label for="em_blood_group" class="form-label">&nbsp;Bloodtype</label>
            <select class="form-select" id="em_blood_group" name="em_blood_group" required>
              <option <?php echo (!isset($em_blood_group)) ? 'selected' : '' ?> disabled>Please Select Here</option>
              <?php
              $em_qry = $conn->query("SELECT * FROM employee order by `em_blood_group` asc");
              while($row= $em_qry->fetch_assoc()):
              ?><option value="<?php echo $row['em_blood_group'] ?>" <?php echo (isset($em_blood_group) && $em_blood_group == $row['em_blood_group'] ) ? 'selected' : '' ?>><?php echo $row['em_blood_group'] ?></option>
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
    var blood_group = button.getAttribute('data-em_blood_group');
    var em_email = button.getAttribute('data-em_email');
    var em_phone = button.getAttribute('data-em_phone');
    var em_birthday = button.getAttribute('em_birthday');
    var em_role = button.getAttribute('em_role');



    // Update the modal's content
    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#em_id').value = em_id;
    modalBody.querySelector('#first_name').value = first_name;
    modalBody.querySelector('#last_name').value = last_name;
    modalBody.querySelector('#em_gender').value = em_gender;
    modalBody.querySelector('#des_name').value = des_name;
    modalBody.querySelector('#dep_name').value = dep_name;
    modalBody.querySelector('#blood_group').value = blood_group;
    modalBody.querySelector('#em_email').value = em_email;
    modalBody.querySelector('#em_phone').value = em_phone;
    modalBody.querySelector('#em_birthday').value = em_birthday;
    modalBody.querySelector('#em_role').value = em_role;
   
  })
</script>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" 
    integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" 
    crossorigin="anonymous"></script>
    
      

    
