<!--Declaration of user session -logout- -->
<?php
$title = 'Leave';
$page = 'leave_type_add';
include_once('./main.php');
?>

<!--Department Process Add and Update JS-->
<script src="Leave_type/LeavetypeJS.js"></script>

<div class="col-md-12">
  <div class="panel panel-default" >
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;
        <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-building-user  fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Type of Leave</strong></span>
      </strong>
    </div>
  </div>

  <div class="m-2 pt-2" style="height:85vh !important;">
    <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
      <div class="panel-heading">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Create New Leave Type</span></strong>
        </strong>
      </div>

      <div class="panel-body">
        <form method="post" action="Leave_type_add.php">
          <p id="message" class="text-danger"></p>

          <div class="form-group mb-3">
            <label for="lt_code" class="text-uppercase"><strong>Code</strong></label>
            <input type="text" class="form-control" placeholder="[Type here]" id="lt_code" name="lt_code" aria-describedby="addon-wrapping">
          </div>

          <div class="form-group mb-3">
            <label for="lt_name" class="text-uppercase"><strong>Name</strong></label>
            <input type="text" class="form-control" placeholder="Leave Type" id="lt_name" name="lt_name" aria-describedby="addon-wrapping">
          </div>

          <div class="form-group mb-3">
            <label for="lt_description" class="text-uppercase"><strong>Description</strong></label>
            <input type="text" class="form-control" placeholder="Leave Type Description" id="lt_description" name="lt_description" aria-describedby="addon-wrapping">
          </div>

          <div class="form-group mb-3">
            <label for="lt_credit" class="text-uppercase"><strong>Credits</strong></label>
            <input type="text" class="form-control" placeholder="Leave Available" id="lt_credit" name="lt_credit" aria-describedby="addon-wrapping">
          </div>

          <div class="form-group mb-3">
            <label for="lt_status" class="text-uppercase"><strong>Status</strong></label>
            <select class="form-select" aria-label="lt_status" name="lt_status" id="lt_status">
              <option selected disabled>Select Here</option>
              <option value="1">Active</option>
              <option value="0">Inactive</option>
            </select>
          </div>

          <div class="form-group mb-3" style="text-align: right;">
            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE">
              <i class="fa-solid fa-check" style="color: #ffffff;"></i> Save
            </button>
            <a href="Leave_type_list.php" class="btn btn-warning" id="btnClose" name="btnClose">
              <i class="fa-solid fa-delete-left" style="color: #000000;"></i> Cancel
            </a>
          </div>

          <!-- Verification Modal -->
          <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>
                </div>
                <div class="modal-body">
                  New Leave Type Added! Thank you.
                </div>
                <div class="modal-footer">
                  <a href="Leave_type_list.php"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                </div>
              </div>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var dep_id = button.getAttribute('data-dep-id');
    var dep_name = button.getAttribute('data-dep-name');

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#dep_id').value = dep_id;
    modalBody.querySelector('#dep_name').value = dep_name;

  })
</script>