<?php
$title = 'Inquiries';
$page = 'inquiries';
include_once('./main.php');
?>

<script src="./script.js"></script>
<link rel="stylesheet" href="css/employee.css">

<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }

  div.dataTables_wrapper div.dataTables_length select{
    width: auto;
    display: inline-block;
    border-radius: 5px;
    padding-top: .30rem;
    padding-bottom: .30rem;
    padding-left: .5rem;
    padding-right: 2.5rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
  }

  div.dataTables_wrapper div.dataTables_length select {
    width: auto;
    display: inline-block;
    border-radius: 15px;
    padding-top: .30rem;
    padding-bottom: .30rem;
    padding-left: .5rem;
    padding-right: 2.5rem;
    font-size: .875rem;
    font-weight: 400;
    line-height: 1.5;
  }

  th {
    text-transform: uppercase !important;
  }

  td {
    font-size: 15px !important;
  }
</style>


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
                <col width="10%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="20%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Name</th>
                  <th class="text-center p-2">Message</th>
                  <th class="text-center p-2">Message Status</th>
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
              ?>
                <tr> 
                  <td class='text-center p-3'><?php echo $i++; ?></td>
                  <td class='text-center p-3 text-capitalize'><?php echo $r_inq_name; ?></td>
                  <td class="text-start text-truncate" style="max-width: 150px;">
                    <?= !empty($r_inq_message) ? $r_inq_message : '----------------'; ?>
                  </td>
                  <td class='text-center p-3'>
                    <span class='badge bg-primary'><?php echo $r_inq_status; ?></span>
                  </td>
                  <td class='text-center p-3'><?php echo date('F j, Y', strtotime($r_inq_date)); ?></td>
                  <td class='text-center p-3'>
                    
                  </td>
                </tr>
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