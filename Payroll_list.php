<?php
$title = 'Payroll';
$page = 'payroll_list';
include_once('./main.php');
?>
<script src="./script.js"></script>
<link rel="stylesheet" href="css/employee.css">
<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }
</style>

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-5 shadow-lg ">
        <div style="height:150vh;">
          <div class="d-flex justify-content-between align-items-center">
            <p class="fw-bold fs-5 text-uppercase">Payroll List</p>
            <div class="top-right-buttons">
              <div class="d-flex">
                <button type="button" class="btn btn-success me-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">Add CSV File</button>
                <a href="Payroll_add.php" class="btn btn-success" style="background-color: #2468a0;">Add New Payroll +</a>
              </div>
            </div>
          </div>
          <div class="mt-3">
            <table class="table" id="example">
              <colgroup>
                <col width="4%">
                <col width="10%">
                <col width="15%">
                <col width="7%">
                <col width="7%">
                <col width="8%">
                <col width="5%">
                <col width="12%">
                <col width="10%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class='text-center p-2' >#</th>
                  <th class='text-center p-2'>Employee Name</th>
                  <th class='text-center p-2'>Department</th>
                  <th class='text-center p-2'>Start Date</th>
                  <th class='text-center p-2'>End Date</th>
                  <th class='text-center p-2'>Daily Income</th>
                  <th class='text-center p-2'>Deduction</th>
                  <th class='text-center p-2'>Total Working Days</th>
                  <th class='text-center p-2'>Total Salary</th>
                </tr>
              </thead>
              <?php
              $i = 1;
              $rows = mysqli_query($conn, "SELECT * FROM `payroll` p 
              INNER JOIN `employee` e ON p.em_id = e.em_id
              INNER JOIN `department` d ON e.dep_id = d.dep_id");
              foreach ($rows as $row) :
              ?>
                <tr>
                  <td class='text-center p-3'> <?php echo $i++; ?> </td>
                  <td class='text-left p-3'> <?php echo $row["last_name"] . ", " . $row["first_name"]; ?> </td>
                  <td class='text-left p-3'> <?php echo $row["dep_name"]; ?> </td>
                  <td class='text-center p-3'> <?php echo $row["payroll_start_date"]; ?> </td>
                  <td class='text-center p-3'> <?php echo $row["payroll_end_date"]; ?> </td>
                  <td class='text-center p-3'> <?php echo $row["payroll_income"]; ?> </td>
                  <td class='text-center p-3'> <?php echo $row["payroll_deduction"]; ?> </td>
                  <td class='text-center p-3'> <?php echo $row["payroll_twd"]; ?> </td>
                  <td class='text-center p-3'> <?php echo $row["payroll_total"]; ?> </td>
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
    // Extracting file information
    $fileName = $_FILES["excel"]["name"];
    $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));

    // Creating a new file name based on current date and time
    $newFileName = date("Y.m.d") . " - " . date("h.i.sa") . "." . $fileExtension;

    // Setting target directory for file upload
    $targetDirectory = "csv_uploads/" . $newFileName;

    // Moving the uploaded file to the target directory
    if (move_uploaded_file($_FILES['excel']['tmp_name'], $targetDirectory)) {
        // Suppressing error messages and displaying no errors
        error_reporting(0);
        ini_set('display_errors', 0);

        // Including necessary Excel reader files
        require 'excelReader/excel_reader2.php';
        require 'excelReader/SpreadsheetReader.php';

        // Opening the Excel file for reading
        $reader = new SpreadsheetReader($targetDirectory);

        // Looping through each row in the Excel file
        foreach ($reader as $key => $row) {
            // Extracting data from each row
            $em_id = $row[0];
            $payroll_start_date = date("Y-m-d", strtotime(str_replace('/', '-', $row[1])));
            $payroll_income = $row[2];
            $payroll_deduction = $row[3];
            $payroll_twd = $row[4];
            $payroll_total = $row[5];
            $payroll_end_date = date("Y-m-d", strtotime(str_replace('/', '-', $row[6])));

            // Prepared statement to insert data into the database table 'payroll'
            $stmt = $conn->prepare("INSERT INTO payroll (em_id, payroll_start_date, payroll_income, payroll_deduction, payroll_twd, payroll_total, payroll_end_date) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->bind_param("ssiiiii", $em_id, $payroll_start_date, $payroll_income, $payroll_deduction, $payroll_twd, $payroll_total, $payroll_end_date);

            if (!$stmt->execute()) {
                echo "Error inserting row: " . $stmt->error;
            }
        }

        // Close the statement and the connection
        $stmt->close();
        $conn->close();

        // Displaying success message after import
        echo "<script>
                alert('Successfully Imported');
                document.location.href = '';
              </script>";
    } else {
        // Displaying error message if file upload fails
        echo "<script>
                alert('File upload failed');
              </script>";
    }
}
?>

<div class="modal" id="exampleModal1" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="exampleModalLabel">Add Payroll</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <span>
                    <img src="bgimages/fingerprint.jpg" style="width: 100px; height: 110px"></img>&nbsp;&nbsp;&nbsp;Import Payroll (CSV File)&nbsp;
                    <img src="bgimages/CSV.png" style="width: 40px; height: 40px">
                </span><br><br>
                <form style="margin-left: 20px" class="" action="" method="post" enctype="multipart/form-data">
                    <input type="file" name="excel" required value="">
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary" name="import">Save</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

</body>