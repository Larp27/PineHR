<!--Declaration of user session -logout- -->
<?php
$title = 'Employee';
$page = 'employee_list';
include_once('./main.php');
?>
<!--cont logout session-->




<!--Gawas sa navbar-->
<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">

        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</span></strong>

      </div><br>

      <div class="col-md-7" style="width: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
          <div class="panel-heading">



            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee List</span></strong>

            <!-- PHP for triggering modal -->
            <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";

              $result = mysqli_query($conn, $query);
            } {
              echo '<a href="em_add.php"><i><button type="button" class="btn btn-success" style = "margin-left: 1155px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Employee +</button> </a>';
            }
            ?>


          </div>

          <div class="dash_content">
            <div class="dash_content_main">


              <table id="example" class="table">
                <colgroup>
                  <col width="12%">
                  <col width="8%">
                  <col width="40%">
                  <col width="10%">
                </colgroup>
                <thead class="" style="background-color: rgb(255, 206, 46)">
                  <tr>
                    <th class="text-center p-2">Employee ID</th>
                    <th class="text-center p-2">Name</th>
                    <th class="text-center p-2">Details</th>
                    <th class="text-center p-2">Actions</th>

                  </tr>
                </thead>


                <?php
                $query = "SELECT * FROM `employee` e 
                INNER JOIN `department` d ON e.dep_id = d.dep_id 
                INNER JOIN `designation` de ON de.des_id = e.des_id 
                INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id 
                INNER JOIN `user_type` ut ON ut.user_id = e.user_id 
                INNER JOIN `employment_status` es ON es.es_id = e.es_id";
                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {
                  $r_em_id = $row['em_id'];
                  $r_em_gender = $row['em_gender'];
                  $r_first_name = $row['first_name'];
                  $r_last_name = $row['last_name'];
                  $r_des_name = $row['des_name'];
                  $r_dep_name = $row['dep_name'];
                  $r_es_name = $row['es_name'];
                  $r_bt_name = $row['bt_name'];
                  $r_em_phone = $row['em_phone'];
                  $r_em_birthday = $row['em_birthday'];
                  $r_user_role = $row['user_role'];
                  $available_leave_types = $row['available_leave_types'];

                  echo "<tr> 
              <td class='text-center p-3'> $r_em_id </td>
              <td class='text-center p-3'> $r_last_name, $r_first_name </td>
              <td class='text-center p-3'> <strong>Department</strong>: $r_dep_name <br> <strong>Designation</strong>: $r_des_name </td>";
                ?>

                  <!-- EDIT AND DELETE -->
                  <td class='text-center p-3'>
                    <div class="col-auto d-flex justify-content-center m-2">
                      <a href="./profiles.php"><button type="button" class="py-0 px-2 me-2 btn btn-secondary"><i class="fa-regular fa-eye"></i></button></a>

                      <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-em-id="<?php echo $r_em_id; ?>" data-gender="<?php echo $r_em_gender; ?>" data-f-name="<?php echo $r_first_name; ?>" data-l-name="<?php echo $r_last_name; ?>" data-des-id="<?php echo $row['des_id']; ?>" data-dep-id="<?php echo $row['dep_id']; ?>" data-es-id="<?php echo $row['es_id']; ?>" data-bt-id="<?php echo $row['bt_id']; ?>" data-em-phone="<?php echo $r_em_phone; ?>" data-em-birthday="<?php echo $r_em_birthday; ?>" data-role-id="<?php echo $row['user_id'] ?>" data-em-email="<?php echo $row['em_email']; ?>" data-em-address="<?php echo $row['em_address']; ?>" data-em-join-date="<?php echo $row['em_joining_date']; ?>" data-em-contract-end="<?php echo $row['em_contract_end']; ?>" data-available-leave-types="<?php echo $row['available_leave_types']; ?>"><i class="fas fa-edit"></i> Edit</button>

                      <a href="Employee/deleteEM.php?em_id=<?php echo $row['em_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to remove this Employee?')"><i class="fas fa-trash"></i>Remove</a>
                    </div>
                  </td>
                  </tr>
                <?php
                }
                ?>

                <!-- Modal sa Update Button -->
                <div class="modal fade wide" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
                  <div class="modal-dialog modal-xl">
                    <div class="modal-content">
                      <div class="modal-header d-flex justify-content-center">
                        <h5 class="modal-title" id="updateUserModalLabel">Edit Employee Details</h1>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                      </div>
                      <div class="modal-body">
                        <form method="post" action="">
                          <input type="hidden" class="form-control" id="em_id" name="em_id">

                          <div class="row">
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label for="f_name" class="form-label fw-bold">&nbsp;First Name</label>
                                <input type="text" class="form-control" id="f_name" name="f_name" required>
                              </div>
                              <div class="mb-3">
                                <label for="l_name" class="form-label fw-bold">&nbsp;Last Name</label>
                                <input type="text" class="form-control" id="l_name" name="l_name" required>
                              </div>
                              <div class="mb-3">
                                <label for="gender" class="form-label fw-bold">&nbsp;Gender</label>
                                <select class="form-select" aria-label="gender" name="gender" id="gender">
                                  <option selected>Select Gender</option>
                                  <option value="Male">Male</option>
                                  <option value="Female">Female</option>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="bt_id" class="form-label fw-bold">&nbsp;Blood Type</label>
                                <select class="form-select" aria-label="bt_id" name="bt_id" id="bt_id">
                                  <option selected>Select Blood Type</option>
                                  <?php
                                  $query = "SELECT * FROM `blood_group`";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                    <option value="<?php echo $row['bt_id']; ?>"><?php echo $row['bt_name']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="em_birthday" class="form-label fw-bold">&nbsp;Date of Birth</label>
                                <input type="date" class="form-control" id="em_birthday" name="em_birthday" required>
                              </div>
                              <div class="mb-3">
                                <label for="em_phone" class="form-label fw-bold">&nbsp;Contact Number</label>
                                <input type="text" class="form-control" id="em_phone" name="em_phone" required>
                              </div>
                              <div class="mb-3">
                                <label for="em_email" class="form-label fw-bold">&nbsp;Email</label>
                                <input type="email" class="form-control" id="em_email" name="em_email" required>
                              </div>
                              <div class="mb-3">
                                <label for="em_address" class="form-label fw-bold">&nbsp;Address</label>
                                <input type="text" class="form-control" id="em_address" name="em_address" required>
                              </div>
                            </div>
                            <div class="col-md-6">
                              <div class="mb-3">
                                <label for="dep_id" class="form-label fw-bold">&nbsp;Department</label>
                                <select class="form-select" aria-label="dep_id" name="dep_id" id="dep_id">
                                  <option selected>Select Department</option>
                                  <?php
                                  $query = "SELECT * FROM `department`";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                    <option value="<?php echo $row['dep_id']; ?>"><?php echo $row['dep_name']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="des_id" class="form-label fw-bold">&nbsp;Designation</label>
                                <select class="form-select" aria-label="des_id" name="des_id" id="des_id">
                                  <option selected>Select Designation</option>
                                  <?php
                                  $query = "SELECT * FROM `designation`";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                    <option value="<?php echo $row['des_id']; ?>"><?php echo $row['des_name']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="es_id" class="form-label fw-bold">&nbsp;Employment Status</label>
                                <select class="form-select" aria-label="es_id" name="es_id" id="es_id">
                                  <option selected>Select Employment Status</option>
                                  <?php
                                  $query = "SELECT * FROM `employment_status`";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                    <option value="<?php echo $row['es_id']; ?>"><?php echo $row['es_name']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="user_role" class="form-label fw-bold">&nbsp;User Role</label>
                                <select class="form-select" aria-label="user_role" name="user_role" id="user_role">
                                  <option selected>Select User Role</option>
                                  <?php
                                  $query = "SELECT * FROM `user_type`";
                                  $result = mysqli_query($conn, $query);
                                  while ($row = mysqli_fetch_assoc($result)) {
                                  ?>
                                    <option value="<?php echo $row['user_id']; ?>"><?php echo $row['user_role']; ?></option>
                                  <?php
                                  }
                                  ?>
                                </select>
                              </div>
                              <div class="mb-3">
                                <label for="em_joining_date" class="form-label fw-bold">&nbsp;Joining Date</label>
                                <input type="date" class="form-control" id="em_joining_date" name="em_joining_date" required>
                              </div>
                              <div class="mb-3">
                                <label for="em_contract_end" class="form-label fw-bold">&nbsp;Leaving Date</label>
                                <input type="date" class="form-control" id="em_contract_end" name="em_contract_end" required>
                              </div>
                              <div class="mb-3">
                                <p class="mb-2 fw-bold">Available Leave Types</p>
                                <div class="row">
                                  <?php
                                  $leave_types_query = $conn->query("SELECT * FROM leave_type WHERE lt_status = 1");
                                  $total_leave_types = $leave_types_query->num_rows;
                                  $leave_types_per_column = ceil($total_leave_types / 2); // Two columns

                                  $counter = 0;
                                  while ($leave_type = $leave_types_query->fetch_assoc()) {
                                    if ($counter % $leave_types_per_column == 0) {
                                      echo '<div class="col-md-6">'; // Two columns
                                    }

                                    // Display leave types as checkboxes
                                    echo '<div class="form-check m-1">';
                                    echo '<input type="checkbox" id="leave_type_' . $leave_type['lt_id'] . '" name="leave_types[]" value="' . $leave_type['lt_name'] . '" class="form-check-input">';
                                    echo '<label for="leave_type_' . $leave_type['lt_id'] . '" class="form-check-label">' . $leave_type['lt_name'] . '</label>';
                                    echo '</div>';
                                    $counter++;

                                    if ($counter % $leave_types_per_column == 0 || $counter == $total_leave_types) {
                                      echo '</div>';
                                    }
                                  }
                                  ?>
                                </div>
                              </div>
                            </div>
                          </div>

                          <div class="text-end my-1">
                            <button type="button" class="btn btn-success" name="btnUpdateEmployee" id="btnUpdateEmployee">UPDATE</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>


                <?php
                $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id INNER JOIN `user_type` ut ON ut.user_id = e.user_id INNER JOIN `employment_status` es ON es.es_id = e.es_id";

                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                  $r_em_id = $row['em_id'];
                  $r_first_name = $row['first_name'];
                  $r_last_name = $row['last_name'];
                  $r_dep_name = $row['dep_name'];
                  $r_des_name = $row['des_name'];
                  $r_user_role = $row['user_role'];
                  $r_em_gender = $row['em_gender'];
                  $r_bt_name = $row['bt_name'];
                  $r_em_phone = $row['em_phone'];
                  $r_em_address = $row['em_address'];
                  $r_em_birthday = $row['em_birthday'];
                  $r_em_joining_date = $row['em_joining_date'];
                  $r_em_contract_end = $row['em_contract_end'];
                  $r_em_email = $row['em_email'];
                  $r_em_password = $row['em_password'];
                ?>
                <?php
                }
                ?>
            </div>



            <script>
              var updateUserModal = document.getElementById('updateUserModal');
              updateUserModal.addEventListener('show.bs.modal', function(event) {
                var button = event.relatedTarget; // Button that triggered the modal
                var em_id = button.getAttribute('data-em-id'); // Extract info from data-* attributes
                var gender = button.getAttribute('data-gender');
                var first_name = button.getAttribute('data-f-name');
                var last_name = button.getAttribute('data-l-name');
                var des_id = button.getAttribute('data-des-id');
                var dep_id = button.getAttribute('data-dep-id');
                var es_id = button.getAttribute('data-es-id');
                var bt_id = button.getAttribute('data-bt-id');
                var phone = button.getAttribute('data-em-phone');
                var address = button.getAttribute('data-em-address');
                var birthday = button.getAttribute('data-em-birthday');
                var role = button.getAttribute('data-role-id');
                var email = button.getAttribute('data-em-email');
                var join_date = button.getAttribute('data-em-join-date');
                var contract_end = button.getAttribute('data-em-contract-end');
                var available_leave_types = button.getAttribute('data-available-leave-types').split(',');
                console.log(available_leave_types)

                var modalBody = updateUserModal.querySelector('.modal-body');
                modalBody.querySelector('#em_id').value = em_id;
                modalBody.querySelector('#gender').value = gender;
                modalBody.querySelector('#f_name').value = first_name;
                modalBody.querySelector('#l_name').value = last_name;
                modalBody.querySelector('#des_id').value = des_id;
                modalBody.querySelector('#dep_id').value = dep_id;
                modalBody.querySelector('#es_id').value = es_id;
                modalBody.querySelector('#bt_id').value = bt_id;
                modalBody.querySelector('#em_phone').value = phone;
                modalBody.querySelector('#em_address').value = address;
                modalBody.querySelector('#em_birthday').value = birthday;
                modalBody.querySelector('#user_role').value = role;
                modalBody.querySelector('#em_email').value = email;
                modalBody.querySelector('#em_joining_date').value = join_date;
                modalBody.querySelector('#em_contract_end').value = contract_end;

                // Check checkboxes for available leave types
                var checkboxes = modalBody.querySelectorAll('input[name="leave_types[]"]');
                checkboxes.forEach(function(checkbox) {
                  var lt_id = checkbox.value;
                  if (available_leave_types.includes(lt_id)) {
                    checkbox.checked = true;
                  }
                });
              });
            </script>



            <script src="Employee/updateEM.js"></script>