<?php
$title = 'Employment Status';
$page = 'employment_status';
include_once('./main.php');
?>
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

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-5 shadow-lg">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">Employment Status</p>
          <?php if ($_SESSION['s_user_id'] == 1) : ?>
            <a href="EmploymentStatus_add.php" class="text-decoration-none">
              <button type="button" class="btn btn-primary" style="background-color: #2468a0;">Add New Employment Status +</button>
            </a>
          <?php endif; ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <table class="table" id="example">
              <colgroup>
                <col width="10%">
                <col width="40%">
                <col width="25%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Employment Status</th>
                  <th class="text-center p-2">Default Income</th>
                  <th class="text-center p-2">Actions</th>
                </tr>
              </thead>
              <tbody>
                <?php
                $query = "SELECT * FROM employment_status";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) :
                ?>
                  <tr>
                    <td class='text-center p-3'><?= $row['es_id'] ?></td>
                    <td class='text-center p-3'><?= $row['es_name'] ?></td>
                    <td class='text-center p-3'><?= $row['es_income'] ?></td>
                    <td class='text-center p-3'>
                      <div class="col-auto d-flex justify-content-center m-2">
                        <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-es-id="<?= $row['es_id'] ?>" data-es-name="<?= $row['es_name'] ?>" data-es-income="<?= $row['es_income'] ?>"><i class="fas fa-edit"></i> Edit</button>

                        <a href="EmploymentStatus/deleteES.php?es_id=<?= $row['es_id'] ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Employment Status Data?')"><i class="fas fa-trash"></i> Delete</a>
                      </div>
                    </td>
                  </tr>
                <?php endwhile; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal for Update Employment Status -->
<div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Employment Status</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form method="post" action="EmploymentStatus/updateES.php">
          <div class="mb-3">
            <input type="hidden" class="form-control" id="es_id" name="es_id">
          </div>
          <div class="mb-3">
            <label for="update_es_name" class="form-label">&nbsp;Employment Status</label>
            <input type="text" class="form-control" id="update_es_name" name="es_name">
          </div>
          <div class="mb-3">
            <label for="update_es_income" class="form-label">&nbsp;Default Income</label>
            <input type="text" class="form-control" id="update_es_income" name="es_income">
          </div>
          <button type="submit" class="btn btn-success" name="btnUpdate" id="btnUpdateEmploymentStatus">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Script for fetching data into modal -->
<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var es_id = button.getAttribute('data-es-id');
    var es_name = button.getAttribute('data-es-name');
    var es_income = button.getAttribute('data-es-income');

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#es_id').value = es_id;
    modalBody.querySelector('#update_es_name').value = es_name;
    modalBody.querySelector('#update_es_income').value = es_income;

  });
</script>