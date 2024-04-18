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
    <title>Leave Type List| PINE HR</title>
    
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
            <li>
              <a href="#" class="ann-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-user-group fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;Employees
                <span class="fas fa-caret-down third"></span>
              </a>
              <ul class="ann-show">
                <li><a href="em_list.php" style="font-family: 'Glacial Indifference';">Employee List</a></li>
                <li><a href="em_add.php" style="font-family: 'Glacial Indifference';">Add Employee</a></li>
              </ul>
            </li>
            <li class="active">
              <a href="#" class="rep-btn" style="font-family: 'Glacial Indifference';"><i class="fa-solid fa-user-large-slash fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;&nbsp;LEAVE
                <span class="fas fa-caret-down fourth"></span>
              </a>
              <ul class="rep-show">
                <li><a href="Leave_type_list.php" style="font-family: 'Glacial Indifference';">Leave Type</a></li>
                <li><a href="Department.php" style="font-family: 'Glacial Indifference';">Leave Application</a></li>
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
                    <a href="Leave_app_list.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
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
        &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Type of Leave</span></strong>
       </strong>
      </div><br>


    <div class="col-md-7" style="width: 100%">
    <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
      <div class="panel-heading">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Leave Application List</span></strong>
       </strong>

       <?php if($_SESSION['s_user_id'] == 1 ){
     $query = "select * from user_type";
     
     $result = mysqli_query($conn, $query);
    }
      { echo '<a href="Leave_type_add.php"><i ><button type="button" class="btn btn-success" style = "margin-left: 1130px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Leave Application +</button> </a>';}
    ?>
      </div>
      
      <form>

<div class ="dash_content">
<div class ="dash_content_main">



<table class="table" id="example">
<colgroup>
    <col width="30%">
    <col width="30%">
    <col width="10%">
    <col width="10%">
    <col width="25%">
    <col width="25%">


  </colgroup>
  <thead class="" style ="background-color: rgb(255, 206, 46)">
    <tr>
      <th class="text-center p-1">Employee</th>
      <th class="text-center p-1">Leave Type</th>
      <th class="text-center p-1">Days</th>
      <th class="text-center p-1">Status</th>
      <th class="text-center p-1">Action</th>
    


      
    </tr>
    </thead>
 
        <?php
       $query = "SELECT * from `leave_application` la INNER JOIN `employee` e ON la.em_id= e.em_id INNER JOIN `leave_type` lt ON lt.lt_id = la.lt_id";

       $result = mysqli_query($conn, $query);
       while($row = mysqli_fetch_assoc($result)){

            $r_first_name = $row['first_name'];
            $r_last_name = $row['last_name'];
            $r_lt_code = $row['lt_code'];
            $r_lt_name = $row['lt_name'];
            $r_la_leave_days = $row['la_leave_days'];

            /* counter sa in between days
            $r_la_date_start = $row['la_date_start'];
            $r_la_end_start = $row['la_end_start'];
            */
            $r_lt_status = $row['lt_status'];

            $final = "<tr> 
            <td class='text-center p-3'> $r_last_name, $r_first_name </td>
            <td class='text-center p-3'> [$r_lt_code] -&nbsp;$r_lt_name</td>
            <td class='text-center p-3'> [$r_la_leave_days] -&nbsp;$r_la_leave_days</td>";

            if($r_lt_status == 1) $final .= "<td class='text-center p-3'><span class ='badge bg-primary'> Active</span></td>";
            else $final .= "<td class='text-center p-3'><span class ='badge bg-secondary'> Inactive</td>";
    $final .= "";
    echo $final;
                    ?>
                    <!-- EDIT AND DELETE -->
                    <td class='text-center p-3'>
                      <div class="col-auto d-flex justify-content-center m-2">
                        <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn"  data-bs-toggle="modal" data-bs-target="#updateUserModal" data-dep-id="<?php echo $row['lt_id']; ?>" data-department-name="<?php echo $row['lt_name']; ?>"><i class="fas fa-edit"></i> Update</button>

                        <a href="Leave_type/deleteLT.php?lt_id=<?php echo $row['lt_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Leave Type?')"><i class="fas fa-trash"></i> Delete </a>
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
    var dep_id = button.getAttribute('data-dep-id');// Extract info from data-* attributes
    var dep_name = button.getAttribute('data-dep-name');// Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#dep_id').value = dep_id;  
    modalBody.querySelector('#dep_name').value = dep_name;
    
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

  