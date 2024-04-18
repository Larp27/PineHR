<!--Declaration of user session -logout- -->
<?php
$title = 'Religion';
$page = 'religion';
include_once('./main.php');
?>
<!--cont logout session-->

<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-hands-praying fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Religion</span></strong>
        </strong>

      </div><br>

      <div class="col-md-7" style="width: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
          <div class="panel-heading">
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-table-list fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Religion</span></strong>

            <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";

              $result = mysqli_query($conn, $query);
            } {
              echo '<a href="Religion_add.php"><i ><button type="button" class="btn btn-success" style = "margin-left: 1120px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Religion Information +</button> </a>';
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

                  echo "<tr> 
                    <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                    <td class='text-center p-3'> $r_r_name </td>";
                ?>
                  <!-- EDIT AND DELETE -->
                  <td class='text-center p-3'>
                    <div class="col-auto d-flex justify-content-center m-2">
                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-r-id="<?php echo $row['r_id']; ?>" data-r_name="<?php echo $row['r_name']; ?>"><i class="fas fa-edit"></i> Edit</button>

                      <a href="Religion/deleteR.php?r_id=<?php echo $row['r_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Blood Type Data?')"><i class="fas fa-trash"></i> Delete </a>
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
                          <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Religion</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
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

                </div>


                <script>
                  var updateUserModal = document.getElementById('updateUserModal');
                  updateUserModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget; // Button that triggered the modal
                    var r_id = button.getAttribute('data-r_id'); // Extract info from data-* attributes
                    var r_name = button.getAttribute('data-r_name'); // Extract info from data-* attributes

                    var modalBody = updateUserModal.querySelector('.modal-body');
                    modalBody.querySelector('#r_id').value = bt_id;
                    modalBody.querySelector('#r_name').value = bt_name;

                  })
                </script>

                <!--Education Process Add and Update JS-->
                <script src="Religion/ReligionJS.js"></script>
                <script src="Religion/updateR.js"></script>