<!--Declaration of user session -logout- -->
<?php
$title = 'Attendance';
$page = 'attendance_list';
include_once('./main.php');
?>
<!--cont logout session-->



<script src="./script.js"></script>



<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-calendar-days fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance</span></strong>
      </strong>
    </div><br>


    <div class="col-md-7" style="width: 100%">
      <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
        <div class="panel-heading">
          <strong>
            &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-list-check fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance List</span></strong>
          </strong>

          <body>

            <?php
            echo '<a href="attendance_add.php"><i><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Attendance +</button> </a>';
            ?>
            <?php
            echo '<button type="button" class="btn btn-success" style="margin-right: 10px; float: right;" data-bs-toggle="modal" data-bs-target="#exampleModal1">Upload CSV File</button>';
            ?>


            <hr>

            <table class="table" id="example">
              <colgroup>
                <col width="10%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Employee Name</th>
                  <th class="text-center p-2">Attendance Date</th>
                  <th class="text-center p-2">Sign In</th>
                  <th class="text-center p-2">Sign Out</th>
                  <th class="text-center p-2">Total Working Hours</th>

                </tr>
              </thead>
              <?php
              $i = 1;
              $query = "SELECT * FROM `attendance` a INNER JOIN `employee` e ON e.em_id = a.em_id";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                $r_first_name = $row['first_name'];
                $r_last_name = $row['last_name'];
                $r_att_date = $row['att_date'];
                $r_att_s_in = date("h:i A", strtotime($row['att_s_in'])); // Convert to 12-hour format
                $r_att_s_out = date("h:i A", strtotime($row['att_s_out'])); // Convert to 12-hour format
                $total_hours = floor($row['total_hr']); // Get the whole hours

                echo "<tr> 
                        <td class='text-center p-3'>" . $i++ . "</td>
                        <td class='text-center p-3'>$r_last_name, $r_first_name </td>
                        <td class='text-center p-3'> $r_att_date </td>
                        <td class='text-center p-3'> $r_att_s_in </td>
                        <td class='text-center p-3'> $r_att_s_out </td>
                        <td class='text-center p-3'> $total_hours hours </td>
                      </tr>";

              ?>
              <?php
              }
              ?>
            </table>





            <?php
            if (isset($_POST["import"])) {
              $fileName = $_FILES["excel"]["name"];
              $fileExtension = explode('.', $fileName);
              $fileExtension = strtolower(end($fileExtension));
              $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

              $targetDirectory = "csv_uploads/"    . $newFileName;
              move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory);

              error_reporting(0);
              ini_set('display_errors', 0);

              require 'excelReader/excel_reader2.php';
              require 'excelReader/SpreadsheetReader.php';

              $reader = new SpreadsheetReader($targetDirectory);
              foreach ($reader as $key => $row) {
                $em_name = $row[0];
                $att_date = explode('/', $row[1])[2] . '-' . explode('/', $row[1])[1] . '-' . explode('/', $row[1])[0];
                $att_s_in = $row[2];
                $att_s_out = $row[3];
                $total_hr = $row[4];
                mysqli_query($conn, "INSERT INTO attendance VALUES('', '$em_name', '$att_date', '$att_s_in', '$att_s_out', '$total_hr')");
              }

              echo
              "
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
            }

            ?><br><br><br><br><br><br><br>
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Attendance</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                  </div>
                  
                  <div class="modal-body">
                    <span><img src="bgimages/fingerprint.jpg" style="width: 100px; height: 110px"></img>&nbsp;&nbsp;&nbsp;Import Attendance (CSV File)&nbsp;&nbsp;&nbsp;<img src="bgimages/CSV.png" style="width: 45px; height: 55px"></span><br><br>

                    <form style="margin-left: 20px" class="" action="" method="post" enctype="multipart/form-data">

                      <input type="file" name="excel" required value="">



                      <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="import">Save</button>
                        <a href="Attendance_list.php?"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button></a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
              