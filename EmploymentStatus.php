<!--Declaration of user session -logout- -->
<?php
$title = 'Employment Status';
$page = 'employment_status';
include_once('./main.php');
?>
<!--cont logout session-->

<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-briefcase fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Employment Status</span></strong>
        </strong>

      </div><br>

      <div class="col-md-7" style="width: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
          <div class="panel-heading">
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-table-list fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Employment Status</span></strong>

            <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";

              $result = mysqli_query($conn, $query);
            } {
              echo '<a href="EmploymentStatus_add.php"><i ><button type="button" class="btn btn-success" style = "margin-left: 1120px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Employment Status +</button> </a>';
            }
            ?>


          </div>

          <div class="dash_content">
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
                    <th class="text-center p-2">Employment Status</th>
                    <th class="text-center p-2">Actions</th>
                  </tr>
                </thead>

                <?php
                $i = 1; // Initialize a counter variable        
                $query = "SELECT * from employment_status";

                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                  $r_es_id = $row['es_id'];
                  $r_es_name = $row['es_name'];

                  echo "<tr> 
                    <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                    <td class='text-center p-3'> $r_es_name </td>";
                ?>
                  <!-- EDIT AND DELETE -->
                  <td class='text-center p-3'>
                    <div class="col-auto d-flex justify-content-center m-2">
                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-es-id="<?php echo $row['es_id']; ?>" data-es_name="<?php echo $row['es_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                      <a href="EmploymentStatus/deleteES.php?es_id=<?php echo $row['es_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Employment Status Data?')"><i class="fas fa-trash"></i> Delete </a>
                    </div>
                  </td>



                  </tr>
                <?php
                }
                ?>

                <!-- Modal sa Update Button -->
                <div>
                  <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                      <div class="modal-content">
                        <div class="modal-header">
                          <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Employment Status</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form method="post" action="">
                            <div class="mb-3">
                              <input type="hidden" class="form-control" id="es_id" name="es_id">
                            </div>
                            <div class="mb-3">
                              <label for="update_es_name" class="form-label">&nbsp;Employment Status</label>
                              <input type="text" class="form-control" id="update_es_names" name="es_name">
                            </div>
                            <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateEmploymentStatus">Update</button>
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
                    var es_id = button.getAttribute('data-es_id'); // Extract info from data-* attributes
                    var es_name = button.getAttribute('data-es_name'); // Extract info from data-* attributes

                    var modalBody = updateUserModal.querySelector('.modal-body');
                    modalBody.querySelector('#es_id').value = edu_id;
                    modalBody.querySelector('#es_name').value = education;

                  })
                </script>

                <!--Education Process Add and Update JS-->
                <script src="EmploymentStatus/EmploymentStatusJS.js"></script>
                <script src="EmploymentStatus/updateES.js"></script>