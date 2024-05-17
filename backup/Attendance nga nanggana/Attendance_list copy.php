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
        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance</span></strong>
       </strong>
      </div><br>


    <div class="col-md-7" style="width: 100%">
    <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
      <div class="panel-heading" >
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-table-list fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance List</span></strong>
       </strong>
     


       <?php
    { echo '<button type="button" class="btn btn-success" style = "margin-left: 1200px; background-color: #2468a0" data-bs-toggle="modal" data-bs-target="#exampleModal1">Add CSV File</button>';}
    ?>

    
     
<br><br>		
<table class="table" id="example">
<colgroup>
    <col width="5%">
    <col width="20%">
    <col width="10%">
    <col width="15%">
    <col width="15%">
    <col width="15%">


  </colgroup>
  <thead class="" style ="background-color: rgb(255, 206, 46)">
    <tr>
      <th class="text-center p-1">#</th>
      <th class="text-center p-1">Employee Name</th>
      <th class="text-center p-1">Attendance Date</th>
      <th class="text-center p-1">Sign In</th>
      <th class="text-center p-1">Sign Out</th>
      <th class="text-center p-1">Working Hour</th>
	</tr>
    </thead>
            <?php
			$i = 1;
			$rows = mysqli_query($conn, "SELECT * FROM attendance");
			foreach($rows as $row) :
			?>
			<tr>
				<td> <?php echo $i++; ?> </td>
				<td> <?php echo $row["em_name"]; ?> </td>
				<td> <?php echo $row["att_date"]; ?> </td>
				<td> <?php echo $row["att_s_in"]; ?> </td>
                <td> <?php echo $row["att_s_out"]; ?> </td>
                <td> <?php echo $row["att_total_hr"]; ?> </td>
			</tr>
			<?php endforeach; ?>
		</table>
		<?php
		
		if(isset($_POST["import"])){
			$fileName = $_FILES["excel"]["name"];
			$fileExtension = explode('.', $fileName);
      $fileExtension = strtolower(end($fileExtension));
			$newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

			$targetDirectory = "csv_uploads/" . $newFileName;
			move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

			error_reporting(0);
			ini_set('display_errors', 0);

			require 'excelReader/excel_reader2.php';
			require 'excelReader/SpreadsheetReader.php';

			$reader = new SpreadsheetReader($targetDirectory);
			foreach($reader as $key => $row){
				$em_name = $row[0];
				$att_date = $row[1];
				$att_s_in = $row[2];
                $att_s_out = $row[3];
                $att_total_hr = $row[4];

				mysqli_query($conn, "INSERT INTO attendance VALUES('', '$em_name', '$att_date', '$att_s_in', '$att_s_out', '$att_total_hr')");
			

			echo
			"
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
            }
            
            
		?>
     
     <?php
       }
        ?>
        
<!-- Modal -->
<div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Attendance</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
    
      <div class="modal-body">
      <span><img src="bgimages/fingerprint.jpg" style= "width: 100px; height: 110px"></img>&nbsp;&nbsp;&nbsp;Import Attendance (CSV, Excel File)</span><br><br>
      <form style="margin-left: 20px"class="" action="" method="post" enctype="multipart/form-data">
			<input type="file" name="excel" required value="">
			
		</form>
    </div>
     
        <div class="modal-footer">
        <button type="submit" class="btn btn-primary" name = "import">Save</button>
        <a href="Attendance_list.php?"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
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

  