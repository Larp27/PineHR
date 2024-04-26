<?php
$title = 'Marital Status';
$page = 'marital_status';
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
          <p class="fw-bold fs-5 text-uppercase">Employment Status</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";
              $result = mysqli_query($conn, $query);
            } {
              echo '<a href="MaritalStatus_add.php"><i ><button type="button" class="btn btn-primary" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Marital Status Information +</button> </a>';
            }
          ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <table class="table" id="example">
              <colgroup>
                <col width="10%">
                <col width="55%">
                <col width="35%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Marital Status</th>
                  <th class="text-center p-2">Actions</th>
                </tr>
              </thead>
              <?php
              $i = 1; // Initialize a counter variable        
              $query = "SELECT * from marital_status";

              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {

                $ms_id = $row['ms_id'];
                $ms_name = $row['ms_name'];

                echo 
                "<tr> 
                  <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                  <td class='text-center p-3'> $ms_name </td>";
              ?>
                  <td class='text-center p-3'>
                    <div class="col-auto d-flex justify-content-center m-2">
                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-ms_id="<?php echo $row['ms_id']; ?>" data-ms_name="<?php echo $row['ms_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                      <a href="MaritalStatus/deleteMS.php?ms_id=<?php echo $row['ms_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Marital Status Data?')"><i class="fas fa-trash"></i> Delete </a>
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

<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Marital Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="mb-3">
            <input type="hidden" class="form-control" id="ms_id" name="ms_id">
          </div>
          <div class="mb-3">
            <label for="update_ms_name" class="form-label">&nbsp;Marital Status</label>
            <input type="text" class="form-control" id="update_ms_name" name="ms_name">
          </div>
          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateMaritalStatus">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var ms_id = button.getAttribute('data-ms_id'); // Extract info from data-* attributes
    var ms_name = button.getAttribute('data-ms_name'); // Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#ms_id').value = ms_id;
    modalBody.querySelector('#update_ms_name').value = ms_name;
  });
</script>


<!--Education Process Add and Update JS-->
<script src="MaritalStatus/MaritalStatusJS.js"></script>
<script src="MaritalStatus/updateMS.js"></script>
<link rel="stylesheet" href="css/employee.css">