<?php
$title = 'Leave';
$page = 'leave_type_list';
include_once('./main.php');
?>
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
          <p class="fw-bold fs-5 text-uppercase">Leave Type List</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";

              $result = mysqli_query($conn, $query);
            } {
              echo '<a href="Leave_type_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Leave Type +</button> </a>';
            }
            ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <table class="table" id="example">
              <colgroup>
                <col width="10%">
                <col width="20%">
                <col width="20%">
                <col width="10%">
                <col width="10%">
                <col width="15%">
                <col width="25%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-1">#</th>
                  <th class="text-center p-1">Leave Type</th>
                  <th class="text-center p-1">Description</th>
                  <th class="text-center p-1">Default Credit</th>
                  <th class="text-center p-1">Status</th>
                  <th class="text-center p-1">Date Created</th>
                  <th class="text-center p-1">Action</th>
                </tr>
              </thead>
              <?php
              $i = 1; // Initialize a counter variable        
              $query = "SELECT * from leave_type";

              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {

                $r_lt_id = $row['lt_id'];
                $r_lt_code = $row['lt_code'];
                $r_lt_name = $row['lt_name'];
                $r_lt_description = $row['lt_description'];
                $r_lt_credit = $row['lt_credit'];
                $r_lt_status = $row['lt_status'];
                $r_date_created = $row['date_created'];

                $final = 
                  "<tr> 
                      <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                      <td class='text-center p-3'> [$r_lt_code] -&nbsp;$r_lt_name</td>
                      <td class='text-center p-3'><span class='fst-italic'> $r_lt_description</span></td>
                      <td class='text-center p-3'> $r_lt_credit</td>";

                    if ($r_lt_status == 1) $final .= "<td class='text-center p-3'><span class ='badge bg-primary'> Active</span></td>";
                    else $final .= "<td class='text-center p-3'><span class ='badge bg-secondary'> Inactive</td>";
                    $final .= "<td class='text-center p-3'> $r_date_created</td>";
                    echo $final;
              ?>
                <td class='text-center p-1'>
                    <div class="col-auto d-flex justify-content-center m-2">&nbsp;
                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-lt-id="<?php echo $row['lt_id']; ?>" data-lt-code="<?php echo $row['lt_code']; ?>" data-lt-name="<?php echo $row['lt_name']; ?>" data-lt-description="<?php echo $row['lt_description']; ?>" data-lt-credit="<?php echo $row['lt_credit']; ?>" data-lt-status="<?php echo $row['lt_status']; ?>"><i class="fas fa-edit"></i> Edit</button>
                      <a href="Leave_type/deleteLT.php?lt_id=<?php echo $row['lt_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Leave Type?')"><i class="fas fa-trash"></i> Delete </a>
                    </div>
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
</div>

<div class="modal" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Edit Leave Type Details</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="mb-3">
            <input type="hidden" class="form-control" id="lt_id" name="lt_id">
          </div>
          <div class="mb-3">
            <label for="lt_code" class="form-label">&nbsp;Code</label>
            <input type="text" class="form-control" id="lt_code" name="lt_code" required>
          </div>
          <div class="mb-3">
            <label for="lt_name" class="form-label">&nbsp;Name</label>
            <input type="text" class="form-control" id="lt_name" name="lt_name" required>
          </div>
          <div class="mb-3">
            <label for="lt_description" class="form-label">&nbsp;Description</label>
            <input type="text" class="form-control" id="lt_description" name="lt_description" required>
          </div>
          <div class="mb-3">
            <label for="lt_credit" class="form-label">&nbsp;Default Credits</label>
            <input type="text" class="form-control" id="lt_credit" name="lt_credit" required>
          </div>
          <div class="mb-3">
            <label for="lt_status" class="form-label">&nbsp;Status</label>
            <select class="form-select" aria-label="lt_status" name="lt_status" id="lt_status">
              <option selected>Status</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>
          <div style="text-align: right;">
            <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateLeaveType">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var lt_id = button.getAttribute('data-lt-id'); // Extract info from data-* attributes
    var lt_code = button.getAttribute('data-lt-code'); // Extract info from data-* attributes
    var lt_name = button.getAttribute('data-lt-name'); // Extract info from data-* attributes
    var lt_description = button.getAttribute('data-lt-description'); // Extract info from data-* attributes
    var lt_credit = button.getAttribute('data-lt-credit'); // Extract info from data-* attributes
    var lt_status = button.getAttribute('data-lt-status'); // Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#lt_id').value = lt_id;
    modalBody.querySelector('#lt_code').value = lt_code;
    modalBody.querySelector('#lt_name').value = lt_name;
    modalBody.querySelector('#lt_description').value = lt_description;
    modalBody.querySelector('#lt_credit').value = lt_credit;
    modalBody.querySelector('#lt_status').value = lt_status;
  })
</script>

<script src="Leave_type/updateLT.js"></script>
<script src="Department/DepartmentJS.js"></script>
<script src="Department/updateDEPT.js"></script>
<link rel="stylesheet" href="css/employee.css">