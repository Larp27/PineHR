<?php
$title = 'Blood Type';
$page = 'bloodtype';
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
          <p class="fs-5 fw-bold text-uppercase">Blood Type</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
            $query = "select * from user_type";
            $result = mysqli_query($conn, $query);
          } {
            echo '<a href="BloodType_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>Add New Blood Type +</button> </a>';
          }
          ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <div class="table-responsive">
              <table class="" id="example">
                <colgroup>
                  <col width="10%">
                  <col width="55%">
                  <col width="35%">
                </colgroup>
                <thead class="" style="background-color: rgb(255, 206, 46)">
                  <tr>
                    <th class="text-center p-2">#</th>
                    <th class="text-center p-2">Blood Type</th>
                    <th class="text-center p-2">Actions</th>
                  </tr>
                </thead>
                <?php
                $i = 1;
                $query = "SELECT * from blood_group";

                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                  $r_bt_id = $row['bt_id'];
                  $r_bt_name = $row['bt_name'];

                  echo "<tr> 
                    <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                    <td class='text-center p-3'> $r_bt_name </td>";
                ?>
                  <td class='text-center p-3'>
                    <div class="col-auto d-flex justify-content-center m-2">
                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-bt-id="<?php echo $row['bt_id']; ?>" data-bt_name="<?php echo $row['bt_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                      <a href="BloodType/deleteBT.php?bt_id=<?php echo $row['bt_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Blood Type Data?')"><i class="fas fa-trash"></i> Delete </a>
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
</div>

<div>
  <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Blood Type</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form method="post" action="">
            <div class="mb-3">
              <input type="hidden" class="form-control" id="bt_id" name="bt_id">
            </div>
            <div class="mb-3">
              <label for="update_bt_name" class="form-label">&nbsp;Blood Type</label>
              <input type="text" class="form-control" id="update_bt_name" name="bt_name">
            </div>
            <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateBloodType">Update</button>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var bt_id = button.getAttribute('data-bt_id'); // Extract info from data-* attributes
    var bt_name = button.getAttribute('data-bt_name'); // Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#bt_id').value = bt_id;
    modalBody.querySelector('#bt_name').value = bt_name;
  })
</script>

<!--Education Process Add and Update JS-->
<script src="BloodType/BloodTypeJS.js"></script>
<script src="BloodType/updateBT.js"></script>
<link rel="stylesheet" href="css/employee.css">