<?php
$title = 'Employee';
$page = 'employee_list';
include_once('./main.php');
?>

<!--Gawas sa navbar-->
<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</span></strong>
      </div><br>

      <div class="col-md-7" style="width: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;">
          <div class="panel-heading">
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee List</span></strong>
            <!-- PHP for triggering modal -->
            <?php if ($_SESSION['s_user_id'] == 1) {
              $query = "select * from user_type";
              $result = mysqli_query($conn, $query);
              echo '<a href="em_add.php"><i><button type="button" class="btn btn-success" style = "margin-left: 1155px; background-color: #2468a0"></i>&nbsp;&nbsp;Add New Employee +</button> </a>';
            } ?>
          </div>

          <div class="dash_content">
            <div class="dash_content_main">
              <table id="example" class="table">
                <colgroup>
                  <col width="10%">
                  <col width="10%">
                  <col width="25%">
                  <col width="25%">
                  <col width="20%">
                </colgroup>
                <thead class="" style="background-color: rgb(255, 206, 46)">
                  <tr>
                    <th class="text-center p-2">Employee ID</th>
                    <th class="text-center p-2">Profile</th>
                    <th class="text-center p-2">Name</th>
                    <th class="text-center p-2">Details</th>
                    <th class="text-center p-2">Actions</th>
                  </tr>
                </thead>

                <tbody>
                <?php
                  $query = "SELECT e.*, elc.lt_id AS available_leave_types, d.dep_name, de.des_name
                  FROM `employee` e 
                  LEFT JOIN `department` d ON e.dep_id = d.dep_id 
                  INNER JOIN `designation` de ON de.des_id = e.des_id 
                  INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id 
                  INNER JOIN `user_type` ut ON ut.user_id = e.user_id 
                  INNER JOIN `employment_status` es ON es.es_id = e.es_id 
                  LEFT JOIN `employee_leave_credits` elc ON e.em_id = elc.em_id";

                  $result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_assoc($result)) {
                ?>
                  <tr> 
                    <td class='text-center p-3'> <?php echo $row['em_id']; ?> </td>
                    <td class='text-center p-3'><img src="../HRM/<?php echo substr($row['em_profile_pic'], 3); ?>" style="max-width:100px;max-height:100px;"></td>
                    <td class='text-left p-3'><?php echo $row['last_name'] . ', ' . $row['first_name']; ?> </td>
                    <td class='text-left p-3'> <strong>Department</strong>: <?php echo $row['dep_name']; ?> <br> <strong>Designation</strong>: <?php echo $row['des_name']; ?> </td>
                    <td class='text-center p-3'>
                      <div class="col-auto d-flex justify-content-center m-2">
                        <!-- <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn"  
                                data-bs-toggle="modal" data-bs-target="#updateUserModal" 
                                data-em-id="<?php echo $row['em_id']; ?>"
                                data-f-name="<?php echo $row['first_name']; ?>"  
                                data-l-name="<?php echo $row['last_name']; ?>" 
                                data-gender="<?php echo $row['em_gender']; ?>" 
                                data-ms-id="<?php echo $row['ms_id']; ?>"
                                data-r-id="<?php echo $row['r_id']; ?>"
                                data-bt-id="<?php echo $row['bt_id']; ?>" 
                                data-em-birthday="<?php echo $row['em_birthday']; ?>" 
                                data-em-phone="<?php echo $row['em_phone']; ?>" 
                                data-em-email="<?php echo $row['em_email']; ?>"
                                data-address-id="<?php echo $row['address_id']; ?>"
                                data-edu-id="<?php echo $row['edu_id']; ?>"
                                data-dep-id="<?php echo $row['dep_id']; ?>" 
                                data-des-id="<?php echo $row['des_id']; ?>" 
                                data-es-id="<?php echo $row['es_id']; ?>" 
                                data-role-id="<?php echo $row['user_id'] ?>" 
                                data-em-join-date="<?php echo $row['em_joining_date']; ?>" 
                                data-em-contract-end="<?php echo $row['em_contract_end']; ?>" 
                                data-em-profile-pic="<?php echo $row['em_profile_pic']; ?>" 
                                data-available-leave-types="<?php echo $row['available_leave_types']; ?>">
                          <i class="fas fa-edit"></i> Edit
                        </button> -->

                        <a href="em_edit.php?em_id=<?php echo $row['em_id']; ?>" class="btn btn-success btn-sm">
                          <i class="fas fa-edit"></i> Edit
                        </a>

                        <a href="Employee/deleteEM.php?em_id=<?php echo $row['em_id']; ?>" class="btn btn-danger btn-sm" 
                          onclick="return confirm('Are you sure you want to remove this Employee?')">
                          <i class="fas fa-trash"></i> Remove
                        </a>
                      </div>
                    </td>           
                  </tr>
                <?php
                  }
                ?>
                </tbody>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function (event) {
    var button = event.relatedTarget; // Button that triggered the modal
    var em_id = button.getAttribute('data-em-id'); // Extract info from data-* attributes
    // Extract other attributes
  });
</script>

<script src="Employee/updateEM.js"></script>