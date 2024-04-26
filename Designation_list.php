<!--Declaration of user session -logout- -->
<?php
$title = 'Designation';
$page = 'designation_list';
include_once('./main.php');
?>
<!--cont logout session-->
<link rel="stylesheet" href="css/employee.css">
<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-5 hsadow-lg">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="d-flex fw-bold fs-5 text-uppercase">Designation List</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";

              $result = mysqli_query($conn, $query);
            } {
              echo '<a href="Designation_add.php" class="ml-auto"><button type="button" class="btn btn-primary">Add New Designation +</button></a>';
            }

          ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <table class="table" id="example">
              <colgroup>
                <col width="55%">
                <col width="35%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">Designation Name</th>
                  <th class="text-center p-2">Actions</th>
                </tr>
              </thead>
              <?php
                $query = "SELECT * from designation";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $r_des_id = $row['des_id'];
                  $r_des_name = $row['des_name'];
                echo 
                "<tr> 
                  <td class='text-center p-3'> $r_des_name </td>";
              ?>
                  <td class='text-center p-3'>
                    <div class="col-auto d-flex justify-content-center m-2">
                    <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-designation-id="<?php echo $row['des_id']; ?>" data-designation-name="<?php echo $row['des_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                      <a href="Designation/deleteDES.php?des_id=<?php echo $row['des_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Designation?')"><i class="fas fa-trash"></i> Delete </a>

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
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Designation</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="mb-3">
            <input type="hidden" class="form-control" id="des_id" name="des_id">
          </div>
          <div class="mb-3">
            <label for="update_des_name" class="form-label">&nbsp;Designation Name</label>
            <input type="text" class="form-control" id="update_des_name" name="des_name">
          </div>
          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateDesignation">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
 updateUserModal.addEventListener('show.bs.modal', function(event) {
  var button = event.relatedTarget; // Button that triggered the modal
  var des_id = button.getAttribute('data-designation-id'); // Extract info from data-* attributes
  var des_name = button.getAttribute('data-designation-name'); // Extract info from data-* attributes

  var modalBody = updateUserModal.querySelector('.modal-body');
  modalBody.querySelector('#des_id').value = des_id;
  modalBody.querySelector('#update_des_name').value = des_name;
});

</script>


<!--Designation Process Add and Update JS-->
<script src="Designation/updateDES.js"></script>
<script src="Designation/DesignationJS.js"></script>
<link rel="stylesheet" href="css/employee.css">