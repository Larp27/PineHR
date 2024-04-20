<?php
  $title = 'Employee';
  $page = 'employee_list';
  include_once('./main.php');
?>

<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>

<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</strong></span>
      </div><br>

      <div class="col-md-7" style="width: 99%">
        <div class="panel panel-default" style="margin-left: 20px; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;">
          <div class="panel-heading">
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee List</strong></span>
            <?php if ($_SESSION['s_user_id'] == 1) {
              echo '<a href="em_add.php"><button type="button" class="btn btn-primary" style="float: right; background-color: #2468a0; border-color:#2468a0;"><i class="fa fa-plus" style="padding-right: 5px;" aria-hidden="true"></i> Add New Employee</button></a>';
            } ?>
          </div>

          <div class="dash_content m-3">
            <div class="dash_content_main m-4 pt-2">
              <table id="example" class="table">
                <colgroup>
                  <col width="10%">
                  <col width="10%">
                  <col width="15%">
                  <col width="40%">
                  <col width="25%">
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
                <tbody style='font-size: 15px;'>
                  <?php
                  $query = "SELECT DISTINCT e.em_id, e.em_profile_pic, e.last_name, e.first_name, d.dep_name, de.des_name
                            FROM `employee` e 
                            INNER JOIN `department` d ON e.dep_id = d.dep_id 
                            INNER JOIN `designation` de ON de.des_id = e.des_id 
                            INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id 
                            INNER JOIN `user_type` ut ON ut.user_id = e.user_id 
                            INNER JOIN `employment_status` es ON es.es_id = e.es_id
                            WHERE e.em_id != " . $_SESSION['s_em_id'];

                  $result = mysqli_query($conn, $query);
                  if (!$result) {
                    echo "Error: " . mysqli_error($conn);
                  } else {
                    while ($row = mysqli_fetch_assoc($result)) {
                      echo "<tr>";
                      echo "<td class='text-center p-3'>" . $row['em_id'] . "</td>";
                      echo "<td class='text-center p-3'><img src='../PINEHR/" . substr($row['em_profile_pic'], 3) . "' style='width:100%; height: 80px'></td>";
                    
                      echo "<td class='text-left p-3'>" . $row['last_name'] . ", " . $row['first_name'] . "</td>";
                      echo "<td class='text-left p-3' style='font-size: 15px;'>
                              <strong>Department</strong>:" . $row['dep_name'] . " <br>
                              <strong>Designation</strong>:" . $row['des_name'] . "
                            </td>";
          
                      echo "<td class='text-center p-3'>
                              <div class='col-auto d-flex justify-content-center m-2'>
                                <a href='em_view.php?em_id=" . $row['em_id'] . "' class='btn btn-primary btn-sm m-2 p-1' style='padding-left: 10px !important; padding-right: 10px !important;'>
                                  <i class='fas fa-eye'> </i> View
                                </a>
                                <a href='em_edit.php?em_id=" . $row['em_id'] . "' class='btn btn-success btn-sm m-2 p-1' style='padding-left: 10px !important; padding-right: 10px !important;'>
                                  <i class='fas fa-edit'> </i> Edit
                                </a>
                                <a href='Employee/deleteEM.php?em_id=" . $row['em_id'] . "' class='btn btn-danger btn-sm m-2 p-1' style='padding-left: 10px !important; padding-right: 10px !important;' onclick='return confirm(\"Are you sure you want to remove this Employee?\")'>
                                  <i class='fas fa-trash'> </i> Remove
                                </a>
                              </div>
                            </td>";
                      echo "</tr>";
                    }
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