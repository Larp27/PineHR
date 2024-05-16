<?php
$title = 'Certificate';
$page = 'certificate';
include_once('./main.php');
?>
<!--cont logout session-->
<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-5 shadow-lg ">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">Certificates</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
            $query = "select * from user_type";

            $result = mysqli_query($conn, $query);
          } {
            echo '<a href="Certificate_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Employee Certificate +</button> </a>';
          }
          ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <table class="table" id="example">
              <colgroup>
                <col width="3%">
                <col width="10%">
                <col width="15%">
                <col width="8%">
                <col width="20%">
                <col width="8%">
                <col width="8%">
                <col width="10%">
                <col width="8%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Employee</th>
                  <th class="text-center p-2">Department</th>
                  <th class="text-center p-2">Title</th>
                  <th class="text-center p-2">Description</th>
                  <th class="text-center p-2">Certificate</th>
                  <th class="text-center p-2">Acquired</th>
                  <th class="text-center p-2">Uploaded</th>
                  <th class="text-center p-2">Action</th>
                </tr>
              </thead>
              <?php
              $i = 1; // Initialize a counter variable         
              $query = "SELECT * from `certificate` c
              INNER JOIN `employee` e ON e.em_id = c.em_id 
              INNER JOIN `department` d ON d.dep_id = e.dep_id";

              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {

                $r_cert_id = $row['cert_id'];
                $r_cert_title = $row['cert_title'];
                $r_cert_description = $row['cert_description'];
                $r_cert_media = $row['cert_media'];
                $r_cert_date = date('Y-m-d', strtotime($row['cert_date']));
                $r_cert_uploaded = date('Y-m-d', strtotime($row['cert_uploaded']));
                $r_first_name = $row['first_name'];
                $r_last_name = $row['last_name'];
                $r_dep_name = $row['dep_name'];
                echo
                "<tr> 
                  <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                  <td class='text-left p-3'>$r_last_name, $r_first_name </td>
                  <td class='text-left p-3'> $r_dep_name </td>
                  <td class='text-center p-3'> $r_cert_title </td>
                  <td class='text-center p-3'> $r_cert_description </td>
                  <td class='text-center p-3'>";

                // Check if cert_media field is empty or null
                if (!empty($r_cert_media)) {
                  echo "<img src='../PINEHR/" . substr($r_cert_media, 3) . "' style='width:150px; height: 80px; border: 2px solid #2468a0;'>";
                } else {
                  // If cert_media is empty, display a placeholder image
                  echo "<img src='bgimages/blank.png' style='width:150px; height: 80px; border: 2px solid #2468a0;'>";
                }

                echo "</td>
                  <td class='text-center p-3'> $r_cert_date </td>
                  <td class='text-center p-3'> $r_cert_uploaded </td>
                  <td class='text-center p-1'>
                  <div class='col-auto d-flex justify-content-center m-2'>
                  <button type='button' class='py-1 px-2 me-1 btn btn-primary btn-sm view-user-btn' data-bs-toggle='modal' data-bs-target='#viewModal' data-media='$r_cert_media' data-cert-id='$r_cert_id' data-title='$r_cert_title' data-description='$r_cert_description'><i class='fas fa-eye'></i> View</button>


                    <a href='Certificate/deleteCert.php?cert_id=$r_cert_id' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this Certificate Data?\")'><i class='fas fa-trash'></i> Delete </a>
                  </div>
                </td>
                
                </tr>";
              }
              ?>
              <div class="modal fade" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-eye"></i>&nbsp;Certificate Details</h5>
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body" id="viewModalBody">
                      <!-- Content will be dynamically populated here -->
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    </div>
                  </div>
                </div>
              </div>

              <script>
                $(document).ready(function() {
                  $('.view-user-btn').click(function() {
                    var cert_id = $(this).data('cert-id');
                    $.ajax({
                      url: 'get_certificate_details.php',
                      type: 'GET',
                      data: {
                        cert_id : cert_id
                      },
                      success: function(response) {
                        $('#viewModalBody').html(response);
                      }
                    });
                  });
                });
              </script>



            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!--Certificate Process Add and Update JS-->
<script src="Certificate/CertificateJS.js"></script>
<link rel="stylesheet" href="css/employee.css">