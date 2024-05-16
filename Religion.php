<?php
  $title = 'Religion';
  $page = 'religion';
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
              echo '<a href="Religion_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Religion Information +</button> </a>';
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
                  <th class="text-center p-2">Religion</th>
                  <th class="text-center p-2">Actions</th>
                </tr>
              </thead>
              <?php
              $i = 1; // Initialize a counter variable         
              $query = "SELECT * from religion";

              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {

                $r_r_id = $row['r_id'];
                $r_r_name = $row['r_name'];

                echo 
                "<tr> 
                  <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                  <td class='text-center p-3'> $r_r_name </td>";
              ?>
                  <td class='text-center p-1'>
                    <div class="col-auto d-flex justify-content-center m-2">
                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-r-id="<?php echo $row['r_id']; ?>" data-r_name="<?php echo $row['r_name']; ?>"><i class="fas fa-edit"></i> Edit</button>
                      <a href="Religion/deleteR.php?r_id=<?php echo $row['r_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Blood Type Data?')"><i class="fas fa-trash"></i> Delete </a>
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
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Religion</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="message" class=text-danger></p>
        <form method="post" action="">
          <div class="mb-3">
            <input type="hidden" class="form-control" id="r_id" name="r_id">
          </div>
          <div class="mb-3">
            <label for="update_r_name" class="form-label">&nbsp;Religion</label>
            <input type="text" class="form-control" id="update_r_name" name="r_name">
          </div>
          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateReligion">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLongTitle">Updated Successfully!</h5>
     
      </div>
      <div class="modal-body">
      &nbsp;&nbsp;Updated Religion Details Successfully! Thank you.
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href = "Religion.php">Done</a>
      </div>
    </div>
  </div>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var r_id = button.getAttribute('data-r-id');
    var r_name = button.getAttribute('data-r_name');

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#r_id').value = r_id;
    modalBody.querySelector('#update_r_name').value = r_name;
  });
</script>

<!--Education Process Add and Update JS-->
<script src="Religion/ReligionJS.js"></script>
<script src="Religion/updateR.js"></script>
<link rel="stylesheet" href="css/employee.css">