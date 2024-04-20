<!--Declaration of user session -logout- -->
<?php
$title = 'Designation';
$page = 'designation_add';
include_once('./main.php');
?>
<!--cont logout session-->


<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-user-tie fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Designation</span></strong>
        </strong>
      </div><br>

      <div class="col-md-7" style="width: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;">
          <div class="panel-heading">
            <strong>
              &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add Designation</span></strong>
            </strong>
          </div>

          <div class="panel-body">

            <form method="post" action="Designation_list.php">
              <p id="message" class=text-danger> </p>

              &nbsp;<strong><span>Designation Name</span></strong><br>
              <br><input type="text" class="form-control" placeholder="Type here" id="des_name" aria-describedby="addon-wrapping"><br>


              <!-- Button trigger for saving modal -->
              <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style="background-color: #2468a0; margin-left: -15px"></i>
              Save
              <th>
                </button>&nbsp;
                <a href="Designation_list.php"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style=" margin-left: 5px"><i class="fa-solid fa-delete-left" style="color: #000000"></i>
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
                        &nbsp;&nbsp;New Designation Added!. Thank you.
                      </div>
                      <div class="modal-footer">
                        <a href="Designation_list.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                      </div>
                    </div>
                  </div>
                </div>


            </form>
          </div>
        </div>
      </div>
      </table>
</form>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var des_id = button.getAttribute('data-des-id'); // Extract info from data-* attributes
    var des_name = button.getAttribute('data-des-name'); // Extract info from data-* attributes

    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#des_id').value = des_id;
    modalBody.querySelector('#des_name').value = des_name;

  })
</script>


<!--Designation Process Add and Update JS-->
<script src="Designation/updateDES.js"></script>
<script src="Designation/DesignationJS.js"></script>