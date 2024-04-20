<?php
$title = 'Education';
$page = 'education';
include_once('./main.php');
?>
  <div class="col-md-12">
    <div class="row">
      <div class="shadow-lg">
        <div class="panel-heading">
            <i class="fa-solid fa-table-list fa-lg" style="color: #2468a0;"></i>
            <p class="fw-bold fw-5">Educational Attainment</p>
          <?php if ($_SESSION['s_user_id'] == 1) {
            $query = "select * from user_type";

            $result = mysqli_query($conn, $query);
          } {
            echo '<a href="Education_add.php"><i ><button type="button" class="btn btn-success" style="float: right; background-color: #2468a0;"></i>&nbsp;&nbsp;Add New Educational Attainment +</button> </a>';
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
              <thead style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2">#</th>
                  <th class="text-center p-2">Educational Attainment</th>
                  <th class="text-center p-2">Actions</th>
                </tr>
              </thead>
              <?php
              $i = 1; // Initialize a counter variable
              $query = "SELECT * from education";

              $result = mysqli_query($conn, $query);
              while ($row = mysqli_fetch_assoc($result)) {

                $r_edu_id = $row['edu_id'];
                $r_education = $row['education'];

                echo "<tr> 
                  <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                  <td class='text-center p-3'> $r_education </td>";
              ?>
                <td class='text-center p-3'>
                  <div class="col-auto d-flex justify-content-center m-2">
                    <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-edu-id="<?php echo $row['edu_id']; ?>" data-education="<?php echo $row['education']; ?>"><i class="fas fa-edit"></i> Edit</button>

                    <a href="Education/deleteEDU.php?edu_id=<?php echo $row['edu_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Education Data?')"><i class="fas fa-trash"></i> Delete </a>
                  </div>
                </td>
                </tr>
              <?php
              }
              ?>
              <div>
                <div class="modal fade" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
                  <div class="modal-dialog">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Education</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="">
                          <div class="mb-3">
                            <input type="hidden" class="form-control" id="edu_id" name="edu_id">
                          </div>
                          <div class="mb-3">
                            <label for="update_education" class="form-label">&nbsp;Education</label>
                            <input type="text" class="form-control" id="update_education" name="education">
                          </div>
                          <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateEducation">Update</button>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <script>
    var updateUserModal = document.getElementById('updateUserModal');
    updateUserModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget;
      var edu_id = button.getAttribute('data-edu_id');
      var education = button.getAttribute('data-education');

      var modalBody = updateUserModal.querySelector('.modal-body');
      modalBody.querySelector('#edu_id').value = edu_id;
      modalBody.querySelector('#education').value = education;
    })
  </script>

  <!--Education Process Add and Update JS-->
  <script src="Education/EducationJS.js"></script>
  <script src="Education/updateEDU.js"></script>
  <link rel="stylesheet" href="css/employee.css">