<?php
$title = 'Department';
$page = 'department_list';
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
          <p class="fw-bold fs-5 text-uppercase">Department</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
            $query = "select * from user_type";
            $result = mysqli_query($conn, $query);
          } {
            echo '<a href="Department_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Department +</button> </a>';
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
                  <th class="text-center p-2">Department Name</th>
                  <th class="text-center p-2">Actions</th>
                </tr>
              </thead>
              <?php
              $query = "SELECT * from department";

              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {

                $r_dep_id = $row['dep_id'];
                $r_dep_name = $row['dep_name'];

                echo
                "<tr> 
                  <td class='text-center p-3'> $r_dep_name </td>";
              ?>
                <td class='text-center p-1'>
                  <div class="col-auto d-flex justify-content-center m-2">
                  <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-dep-id="<?php echo $row['dep_id']; ?>" data-dep-name="<?php echo $row['dep_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                    <a href="Department/deleteDEPT.php?dep_id=<?php echo $row['dep_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Department?')"><i class="fas fa-trash"></i> Delete </a>
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
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Department</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="">
          <div class="mb-3">
            <input type="hidden" class="form-control" id="dep_id" name="dep_id">
          </div>
          <div class="mb-3">
            <label for="update_dep_name" class="form-label">&nbsp;Department Name</label>
            <input type="text" class="form-control" id="update_dep_name" name="dep_name">
          </div>
          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateDepartment">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var dep_id = button.getAttribute('data-dep-id'); // Extract info from data-* attributes
    var dep_name = button.getAttribute('data-dep-name'); // Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#dep_id').value = dep_id;
    modalBody.querySelector('#update_dep_name').value = dep_name;
  });
</script>

<!--Department Process Add and Update JS-->
<script src="Department/DepartmentJS.js"></script>
<script src="Department/updateDEPT.js"></script>
<link rel="stylesheet" href="css/employee.css">