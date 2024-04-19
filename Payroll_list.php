<!--Declaration of user session -logout- -->
<?php
$title = 'Payroll';
$page = 'payroll_list';
include_once('./main.php');
?>
<!--cont logout session-->

<script src="./script.js"></script>



<div class="col-md-12">
  <div class="panel panel-default">
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-money-check-dollar fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Payroll</span></strong>
      </strong>
    </div><br>


    <div class="col-md-7" style="width: 100%">
      <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
        <div class="panel-heading">
          <strong>
            &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-list-check fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Payroll List</span></strong>
          </strong>

          <body>

            &nbsp; &nbsp; &nbsp; &nbsp;
            <?php {
              echo '<a href="payroll_add.php"><i><button type="button" class="btn btn-success" style = "margin-left: 1155px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Payroll +</button> </a>';
            }
            ?>
            <?php {
              echo '<button type="button" class="btn btn-success" style = "margin-left: 1200px; background-color: #2468a0" data-bs-toggle="modal" data-bs-target="#exampleModal1">Add CSV File</button>';
            }
            ?>
            <hr>
            <table class="table" id="example">
              <colgroup>
                <col width="5%">
                <col width="15%">
                <col width="10%">
                <col width="15%">
                <col width="15%">
                <col width="15%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th>#</th>
                  <th>Employee Name</th>
                  <th>Start Date</th>
                  <th>End Date</th>
                  <th>Daily Income</th>
                  <th>Deduction</th>
                  <th>Total Working Days</th>
                  <th>Total Salary</th>
                </tr>
              </thead>
              <?php
              $i = 1;
              $rows = mysqli_query($conn, "SELECT p.*, e.first_name, e.last_name FROM payroll p INNER JOIN employee e ON p.em_name = e.em_id");
              foreach ($rows as $row) :
              ?>
                <tr>
                  <td> <?php echo $i++; ?> </td>
                  <td> <?php echo $row["last_name"] . ", " . $row["first_name"]; ?> </td>
                  <td> <?php echo $row["payroll_start_date"]; ?> </td>
                  <td> <?php echo $row["payroll_end_date"]; ?> </td>
                  <td> <?php echo $row["payroll_income"]; ?> </td>
                  <td> <?php echo $row["payroll_deduction"]; ?> </td>
                  <td> <?php echo $row["payroll_twd"]; ?> </td>
                  <td> <?php echo $row["payroll_total"]; ?> </td>
                </tr>
              <?php endforeach; ?>

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
                $payroll_date = explode('/', $row[1])[2] . '-' . explode('/', $row[1])[1] . '-' . explode('/', $row[1])[0];
                $payroll_income = $row[2];
                $payroll_deduction = $row[3];
                $payroll_twd = $row[4];
                $payroll_total = $row[5];
                mysqli_query($conn, "INSERT INTO payroll VALUES('', '$em_name', '$payroll_start_date', '$payroll_end_date' , '$payroll_income', '$payroll_deduction', '$payroll_twd', '$payroll_total')");
              }

              echo
              "
			<script>
			alert('Succesfully Imported');
			document.location.href = '';
			</script>
			";
            }

            ?>
            <div class="modal fade" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
              <div class="modal-dialog">
                <div class="modal-content">
                  <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Add Payroll</h1>
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