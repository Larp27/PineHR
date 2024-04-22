<?php
$title = 'Attendance';
$page = 'attendance_list';
include_once('./main.php');
?>

<style>
    .top-right-buttons {
    margin-left: auto;
  }

  .top-right-buttons .btn {
    margin-left: 10px;
  }

  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }
</style>

<script src="./script.js"></script>
<link rel="stylesheet" href="css/employee.css">

<body>
  <div class="container-fluid">
    <div class="row">
      <div class="col-md-12 p-5 shadow-lg ">
        <div style="height:100vh;">
          <div class="d-flex justify-content-between align-items-center">
            <p class="fw-bold fs-5 text-uppercase">Attendance List</p>
            <div class="top-right-buttons">
              <div class="d-flex">
                <button type="button" class="btn btn-success mr-2" data-bs-toggle="modal" data-bs-target="#exampleModal1">Upload CSV File</button>
                <a href="attendance_add.php" class="btn btn-success" style="background-color: #2468a0;">Add New Attendance +</a>
              </div>
            </div>
          </div>
          <div class="mt-4">
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
                $r_att_s_in = date("h:i A", strtotime($row['att_s_in']));
                $r_att_s_out = date("h:i A", strtotime($row['att_s_out'])); 
                $total_hours = floor($row['total_hr']); 

                echo 
                "<tr> 
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
        $att_date = explode('/', $row[1])[2] . '-' . explode('/', $row[1])[1] . '-' . explode('/', $row[1])[0];
        $att_s_in = $row[2];
        $att_s_out = $row[3];
        $total_hr = $row[4];
        mysqli_query($conn, "INSERT INTO attendance VALUES('', '$em_name', '$att_date', '$att_s_in', '$att_s_out', '$total_hr')");
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
          <h1 class="modal-title fs-5" id="exampleModalLabel">Add Attendance</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <span><img src="bgimages/fingerprint.jpg" style="width: 100px; height: 110px"></img>&nbsp;&nbsp;&nbsp;Import Attendance (CSV File)<img src="bgimages/CSV.png" style="width: 45px; height: 55px"></span><br><br>
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