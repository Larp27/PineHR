<?php
$title = 'Inquiries';
$page = 'inquiries';
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
            <p class="fw-bold fs-5 text-uppercase">Inquiries</p>
            <div class="top-right-buttons">
              <div class="d-flex">
               
              </div>
            </div>
          </div>
          <div class="mt-4">
            <table class="table" id="example">
              <colgroup>
                <col width="5%">
                <col width="20%">
                <col width="20%">
                <col width="15%">
                <col width="15%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Name</th>
                  <th class="text-center p-2">Message</th>
                  <th class="text-center p-2">Status</th>
                  <th class="text-center p-2">Date</th>
                  <th class="text-center p-2">Action</th>
  
                </tr>
              </thead>
              <?php
              $i = 1;
              $query = "SELECT * FROM `inquiries`";
              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {
                $r_inq_name = $row['inq_name'];
                $r_inq_message = $row['inq_message'];
                $r_inq_status = $row['inq_status'];
                $r_inq_date = $row['inq_date'];
                echo 
                "<tr> 
                    <td class='text-center p-3'>" . $i++ . "</td>
                    <td class='text-left p-3'> $r_inq_name </td>
                    <td class='text-left p-3'> $r_inq_message </td>
                    <td class='text-center p-3'> $r_inq_status </td>
                    <td class='text-center p-3'> $r_inq_date </td>
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
  <script src="Inquiries/InquiriesJS.js"></script>