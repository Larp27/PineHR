<!--Declaration of user session -logout- -->
<?php
$title = 'Leave';
$page = 'leave_type_add';
include_once('./main.php');
?>
<!--cont logout session-->



<!--Department Process Add and Update JS-->
<script src="Leave_type/LeavetypeJS.js"></script>
<!--<script src="Leave_type/updateJS.js"></script>-->


<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Type of Leave</span></strong>
        </strong>
      </div><br>


      <div class="col-md-7" style="width: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
          <div class="panel-heading">
            <strong>
              &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Create New Leave Type</span></strong>
            </strong>
          </div>

          <div class="panel-body">

            <form method="post" action="Leave_type_add.php">
              <p id="message" class=text-danger> </p>

              &nbsp;<strong><span>Code</span></strong><br>
              <br><input type="text" class="form-control" placeholder="[Type here]" id="lt_code" aria-describedby="addon-wrapping"><br>

              &nbsp;<strong><span>Name</span></strong><br>
              <br><input type="text" class="form-control" placeholder="Leave Type" id="lt_name" aria-describedby="addon-wrapping"><br>


              &nbsp;<strong><span>Description</span></strong><br>
              <br><input type="text" class="form-control" placeholder="Leave Type Description" id="lt_description" aria-describedby="addon-wrapping"><br>

              &nbsp;<strong><span>Credits</span></strong><br>
              <br><input type="text" class="form-control" placeholder="Leave Available" id="lt_credit" aria-describedby="addon-wrapping"><br>


              &nbsp;<strong><span>Status</span></strong><br><br>
              <select class="form-select" aria-label="lt_status" name="lt_status" id="lt_status">
                <option selected>Status</option>
                <option value="1">Active</option>
                <option value="0">Inactive</option>
              </select><br>

              <!-- Button trigger for saving modal -->
              <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style="background-color: #2468a0; margin-left: -15px"></i>
              Save
              </button>&nbsp;
              <a href="Leave_type_list.php"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style=" margin-left: 5px"><i class="fa-solid fa-delete-left" style="color: #000000"></i>
                  Cancel
                </button></a><br><br>



              <!-- Verification Modal -->
              <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>

                    </div>
                    <div class="modal-body">
                      &nbsp;&nbsp;New Leave Type Added!. Thank you.
                    </div>
                    <div class="modal-footer">
                      <a href="Leave_type_list.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                    </div>
                  </div>
                </div>
              </div>


            </form>
          </div>
        </div>
      </div>





      <script>
        var updateUserModal = document.getElementById('updateUserModal');
        updateUserModal.addEventListener('show.bs.modal', function(event) {
          var button = event.relatedTarget; // Button that triggered the modal
          var dep_id = button.getAttribute('data-dep-id'); // Extract info from data-* attributes
          var dep_name = button.getAttribute('data-dep-name'); // Extract info from data-* attributes

          var modalBody = updateUserModal.querySelector('.modal-body');
          modalBody.querySelector('#dep_id').value = dep_id;
          modalBody.querySelector('#dep_name').value = dep_name;

        })