<?php
$title = 'Payroll';
$page = 'payroll_list';
include_once('./main.php');
?>
<script src="./script.js"></script>
<link rel="stylesheet" href="css/employee.css">


<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-5 shadow-lg ">
        <div style="height:100vh;">
          <div class="d-flex justify-content-between align-items-center">
            <p class="fw-bold fs-5 text-uppercase">Payroll List</p>
            <div class="top-right-buttons">
              <div class="d-flex">
                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">Add CSV File</button>
                <a href="payroll_add.php" class="btn btn-success" style="background-color: #2468a0;">Add New Payroll +</a>
              </div>
            </div>
          </div>
          <div class="mt-3">
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
          </div>
        </div>
      </div>
    </div>
  </div>


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
    "<script>
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
          <span><img src="bgimages/fingerprint.jpg" style="width: 100px; height: 110px"></img>&nbsp;&nbsp;&nbsp;Import Attendance (CSV File)<img src="bgimages/CSV.png" style="width: 45px; height: 55px"></span>
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
  </div>
</body>