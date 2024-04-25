<?php
$title = 'Employee';
$page = 'employee_list';
include_once('./main.php');
?>

<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }

  div.dataTables_wrapper div.dataTables_length select{
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
    <div class="col-md-12">
      <div class="m-2 pt-2">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fw-bold fs-5 text-uppercase">Employment List</p>
          <?php
          if ($_SESSION['s_user_id'] == 1) {
            echo '<a href="em_add.php"><button type="button" class="btn btn-success style="float: right; background-color: #2468a0; border-color:#2468a0;"><i class="fa fa-plus" style="padding-right: 5px;" aria-hidden="true"></i> Add New Employee</button></a>';
          } ?>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main m-4 pt-2">
            <table id="example" class="table">
              <colgroup>
                <col width="5%">
                <col width="10%">
                <col width="15%">
                <col width="25%">
                <col width="10%">
                <col width="25%">
              </colgroup>
              <thead class="" style="background-color: rgb(255, 206, 46)">
                <tr>
                  <th class="text-center p-2 text-uppercase">#</th>
                  <th class="text-center p-2 text-uppercase">Profile</th>
                  <th class="text-center p-2 text-uppercase">Name</th>
                  <th class="text-center p-2 text-uppercase">Details</th>
                  <th class="text-center p-2 text-uppercase">Status</th>
                  <th class="text-center p-2 text-uppercase">Actions</th>
                </tr>
              </thead>
              <tbody style='font-size: 15px;'>
                <?php
                 $i = 1;
                $query = "SELECT DISTINCT e.em_id, e.employee_status, e.em_profile_pic, e.last_name, e.first_name, d.dep_name, de.des_name
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
                    // Apply the logic to determine status color
                    switch ($row['employee_status']) {
                      case 'Active':
                        $status_color = 'bg-primary';
                        break;
                      case 'Inactive':
                        $status_color = 'bg-secondary';
                        break;
                      case 'On Leave':
                        $status_color = 'bg-success';
                        break;
                      default:
                        $status_color = 'bg-secondary';
                        break;
                    }
                    echo "<tr>";
                    echo "<td class='text-center p-3'>" . $i++ . "</td>";
                    echo "<td class='text-center p-3'><img src='../PINEHR/" . substr($row['em_profile_pic'], 3) . "' style='width:60%; height: 80px; border-radius: 50%; border: 2px solid #2468a0;'></td>";
                    echo "<td class='text-left p-3'>" . $row['last_name'] . ", " . $row['first_name'] . "</td>";
                    echo "<td class='text-left p-3' style='font-size: 15px;'>
                                <strong>Department</strong>: " . $row['dep_name'] . " <br>
                                <strong>Designation</strong>: " . $row['des_name'] . "
                              </td>";
                    echo "<td class='text-center p-3'><span class='badge $status_color'>" . $row['employee_status'] . "</span></td>";
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
</div>