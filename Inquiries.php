<?php
$title = 'Inquiries';
$page = 'inquiries';
include_once('./main.php');
?>

<script src="./script.js"></script>
<link rel="stylesheet" href="css/employee.css">
<script src="path/to/jquery.min.js"></script>
<script src="path/to/bootstrap.bundle.min.js"></script>

<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }

  div.dataTables_wrapper div.dataTables_length select {
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
                <col width="15%">
                <col width="15%">
                <col width="10%">
                <col width="10%">
                <col width="20%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Name</th>
                  <th class="text-center p-2">Contact Number</th>
                  <th class="text-center p-2">Inquiry</th>
                  <th class="text-center p-2">Status</th>
                  <th class="text-center p-2">Date</th>
                  <th class="text-center p-2">Action</th>

                </tr>
              </thead>
              <tbody>
                <?php
                  $i = 1;
                  $query = "SELECT * FROM `inquiries`";
                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                    $r_inq_id = $row['inq_id'];
                    $r_inq_name = $row['inq_name'];
                    $r_inq_number = $row['inq_number'];
                    $r_inq_message = $row['inq_message'];
                    $r_inq_status = $row['inq_status'];
                    $r_inq_date = date('F d, Y', strtotime($row['inq_date']));

                    // Define badge color based on status
                    $badge_color = ($r_inq_status == 'Answered') ? 'success' : 'warning';
                    echo "<tr> 
                            <td class='text-center p-3'>" . $i++ . "</td>
                            <td class='text-center p-3 text-capitalize'>$r_inq_name</td>
                            <td class='text-center p-3 text-capitalize'>$r_inq_number</td>
                            <td class='text-center'>
                              <div class='col-auto d-flex justify-content-center m-2 align-items-center'>
                                <button type='button' class='py-1 px-2 me-1 btn btn-primary btn-sm view-user-btn' data-id='$r_inq_id' data-message='$r_inq_message' data-bs-toggle='modal' data-bs-target='#viewModal'><i class='fas fa-eye'></i> View</button>
                              </div>
                            </td>
                            <td class='text-center p-3'><span class='badge bg-$badge_color'>$r_inq_status</span></td>
                            <td class='text-center p-3'>$r_inq_date</td>  
                            <td>"; 

                            // Check if status is 'Answered' and only display the reply button if not
                            if ($r_inq_status != 'Answered') {
                                echo "<div class='col-auto d-flex justify-content-center m-2 align-items-center'>
                                        <button type='button' class='py-1 px-2 me-1 btn btn-success btn-sm reply-user-btn' data-id='$r_inq_id' data-bs-toggle='modal' data-bs-target='#replyModal'><i class='fas fa-reply'></i> Reply</button>
                                        <a href='Inquiries/deleteInq.php?inq_id=$r_inq_id' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this Message?\")'><i class='fas fa-trash'></i> Delete</a>
                                      </div>";
                            } else {
                              echo "<div class='col-auto d-flex justify-content-center m-2 align-items-center'>
                                        <a href='Inquiries/deleteInq.php?inq_id=$r_inq_id' class='btn btn-danger btn-sm' onclick='return confirm(\"Are you sure you want to delete this Message?\")'><i class='fas fa-trash'></i> Delete</a>
                                      </div>";
                            }
                  }
                ?>
              </tbody>
            </table>
          </div>
        </div>
    </div>
</div>

<!-- Reply Modal -->
<div class="modal" id="replyModal" tabindex="-1" aria-labelledby="replyModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="replyModalLabel">Reply to Inquiry</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form id="replyForm" action="Inquiries/saveReply.php" method="post">
          <input type="hidden" id="replyInqId" name="inq_id">
          <div class="mb-3">
            <label for="inq_reply" class="form-label">Your Message</label>
            <textarea class="form-control" id="replyMessage" name="inq_reply" rows="3" required></textarea>
          </div>
          <button type="submit" class="btn btn-primary">Send Reply</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const replyButtons = document.querySelectorAll(".reply-user-btn");
    const replyInqIdInput = document.getElementById("replyInqId");

    replyButtons.forEach(function(button) {
      button.addEventListener("click", function() {
        const inqId = this.getAttribute("data-id");
        replyInqIdInput.value = inqId;
      });
    });
  });
</script>

<!-- View Modal -->
<div class="modal" id="viewModal" tabindex="-1" aria-labelledby="viewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="viewModalLabel"><i class="fas fa-message"></i>&nbsp;Inquiry</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="viewModalBody">
                <div class="mb-3">
                    <label for="inq_message" class="form-label">  Inquiry:</label>
                    <textarea class="form-control" id="inq_message" name="inq_message" readonly rows="7"></textarea>
                </div>
            </div>
           
                
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function() {
    $('.view-user-btn').on('click', function() {
        var inqId = $(this).data('id');
        var inqMessage = $(this).data('message');
        
        // Update the modal with the message
        $('#inq_message').val(inqMessage);
        
        // Send AJAX request to update the status
        $.ajax({
            url: 'update_inquire_status.php',
            type: 'POST',
            contentType: 'application/json',
            data: JSON.stringify({ inq_id: inqId }),
            success: function(response) {
                if (response.success) {
                    // Optionally update the status in the table
                    // Find the row with this inquiry id and update the status
                    $('button[data-id="' + inqId + '"]').closest('tr').find('td:nth-child(4)').text('Seen');
                } else {
                    console.error('Failed to update status.');
                }
            },
            error: function() {
                console.error('Error in AJAX request.');
            }
        });
    });
});
</script>

</body>
  <script src="Inquiries/InquiriesJS.js"></script>
  