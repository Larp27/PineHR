<?php
  $title = 'Employee';
  $page = 'employee_list';
  include_once('./main.php');
  ?>

  <form>
    <div class="col-md-12 m-2">
      <div class="panel panel-default">
        <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
          &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</strong></span>
        </div><br>

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

        <div class="col-md-7" style="width: 100%">
          <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;">
            <div class="panel-heading">
              &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee List</strong></span>
              <?php if ($_SESSION['s_user_id'] == 1) {
                echo '<a href="em_add.php"><button type="button" class="btn btn-success" style="margin-left: 1155px; background-color: #2468a0;">Add New Employee +</button></a>';
              } ?>
            </div>

            <div class="dash_content m-3">
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
                    $query = "SELECT DISTINCT e.em_id, e.em_profile_pic, e.last_name, e.first_name, d.dep_name, de.des_name
                              FROM `employee` e 
                              INNER JOIN `department` d ON e.dep_id = d.dep_id 
                              INNER JOIN `designation` de ON de.des_id = e.des_id 
                              INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id 
                              INNER JOIN `user_type` ut ON ut.user_id = e.user_id 
                              INNER JOIN `employment_status` es ON es.es_id = e.es_id";

                    $result = mysqli_query($conn, $query);
                    if (!$result) {
                      echo "Error: " . mysqli_error($conn);
                    } else {
                      while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>";
                        echo "<td class='text-center p-3'>" . $row['em_id'] . "</td>";
                        echo "<td class='text-center p-3'><img src='../PINEHR/" . substr($row['em_profile_pic'], 3) . "' style='max-width:100px;max-height:100px;'></td>";
                        echo "<td class='text-left p-3'>" . $row['last_name'] . ", " . $row['first_name'] . "</td>";
                        echo "<td class='text-left p-3'><strong>Department</strong>: " . $row['dep_name'] . "<br><strong>Designation</strong>: " . $row['des_name'] . "</td>";
                        echo "<td class='text-center p-3'>
                                <div class='col-auto d-flex justify-content-center m-2'>
                                  <a href='em_edit.php?em_id=" . $row['em_id'] . "' class='btn btn-success btn-sm m-2 p-1'>
                                    <i class='fas fa-edit'></i> Edit
                                  </a>
                                  <a href='Employee/deleteEM.php?em_id=" . $row['em_id'] . "' class='btn btn-danger btn-sm m-2 p-1' onclick='return confirm(\"Are you sure you want to remove this Employee?\")'>
                                    <i class='fas fa-trash'></i> Remove
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