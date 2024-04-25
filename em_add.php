<!--Declaration of user session -logout- -->
<?php
$title = 'Employee';
$page = 'employee_add';
include_once('./main.php');
?>
<!--cont logout session-->

<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default">
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;
        <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</strong></span>
      </strong>
    </div>
  </div>

  <div class="card card-outline card-primary m-3">
    <div class="card-header">
      <div class="panel-heading" style="padding: 2px !important;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add Employee</span></strong>
        </strong>
      </div>
    </div>

    <div class="card-body">
      <div class="container-fluid">
        <p id="message" class=text-danger></p>
        <div class="row">
          <div class="col-6">
            <script>
              document.addEventListener("DOMContentLoaded", function() {
                var first_name_input = document.getElementById("first_name");
                var last_name_input = document.getElementById("last_name");

                var createNotification = function(inputElement, message) {
                  // Check if a notification already exists
                  var existingNotification = inputElement.nextElementSibling;
                  if (!existingNotification || !existingNotification.classList.contains("text-danger")) {
                    // Create a small notification element
                    var notification = document.createElement("div");
                    notification.className = "text-danger";
                    notification.textContent = message;

                    // Insert the notification after the input element
                    inputElement.parentNode.insertBefore(notification, inputElement.nextSibling);

                    // Remove the notification after a short delay
                    setTimeout(function() {
                      notification.parentNode.removeChild(notification);
                    }, 3000);
                  }
                };

                first_name_input.addEventListener("input", function(event) {
                  var value = event.target.value;
                  if (!/^[a-zA-Z ]*$/.test(value)) {
                    createNotification(first_name_input, "Please enter only letters and spaces in the First Name field.");
                    event.target.value = value.replace(/[^a-zA-Z ]/g, '');
                  }
                });

                last_name_input.addEventListener("input", function(event) {
                  var value = event.target.value;
                  if (!/^[a-zA-Z ]*$/.test(value)) {
                    createNotification(last_name_input, "Please enter only letters and spaces in the Last Name field.");
                    event.target.value = value.replace(/[^a-zA-Z ]/g, '');
                  }
                });
              });
            </script>


            <div class="form-group mb-3">
              <label for="first_name" class="fw-bold text-uppercase">First Name</label>
              <input type="text" class="form-control" placeholder="Employee's First Name" name="first_name" id="first_name" aria-describedby="addon-wrapping" required>
            </div>
            <div class="form-group mb-3">
              <label for="last_name" class="fw-bold text-uppercase">Last Name</label>
              <input type="text" class="form-control" placeholder="Employee's Last Name" id="last_name" name="last_name" aria-describedby="addon-wrapping" required>
            </div>
            <div class="form-group mb-3">
              <label for="em_gender" class="fw-bold text-uppercase">Gender</label>
              <select class="form-select" id="em_gender" name="em_gender" required>
                <option selected disabled>Select Gender</option>
                <option value="Male">Male</option>
                <option value="Female">Female</option>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="ms_id" class="fw-bold text-uppercase">Marital Status</label>
              <select class="form-select" id="ms_id" name="ms_id" required>
                <option <?php echo (!isset($ms_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $ms_qry = $conn->query("SELECT * FROM marital_status order by ms_name asc");
                while ($row = $ms_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['ms_id'] ?>" <?php echo (isset($ms_id) && $ms_id == $row['ms_id']) ? 'selected' : '' ?>><?php echo $row['ms_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="r_id" class="fw-bold text-uppercase">Religion</label>
              <select class="form-select" id="r_id" name="r_id" required>
                <option <?php echo (!isset($dep_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $r_qry = $conn->query("SELECT * FROM religion order by r_name asc");
                while ($row = $r_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['r_id'] ?>" <?php echo (isset($r_id) && $r_id == $row['r_id']) ? 'selected' : '' ?>><?php echo $row['r_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="bt_id" class="fw-bold text-uppercase">Bloodtype</label>
              <select class="form-select" id="bt_id" name="bt_id" required>
                <option <?php echo (!isset($bt_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $bt_qry = $conn->query("SELECT * FROM blood_group order by bt_name asc");
                while ($row = $bt_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['bt_id'] ?>" <?php echo (isset($bt_id) && $bt_id == $row['bt_id']) ? 'selected' : '' ?>><?php echo $row['bt_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="em_birthday" class="fw-bold text-uppercase">Date of Birth</label>
              <input type="date" name="em_birthday" id="em_birthday" class="form-control" aria-describedby="addon-wrapping" required>
            </div>
            <script>
              document.addEventListener("DOMContentLoaded", function() {
                var em_phone_input = document.getElementById("em_phone");

                em_phone_input.addEventListener("input", function(event) {
                  var value = event.target.value;
                  // Remove any non-digit characters from the input value
                  event.target.value = value.replace(/\D/g, '');
                });
              });
            </script>

            <div class="form-group mb-3">
              <label for="em_phone" class="fw-bold text-uppercase">Contact Number</label>
              <div class="input-group">
                <span class="input-group-text">+63</span>
                <input type="text" name="em_phone" id="em_phone" class="form-control" aria-describedby="addon-wrapping" minlength="10" maxlength="10" oninput="limitInputLength(this, 10);" required>
              </div>
            </div>

            <script>
              function limitInputLength(element, maxLength) {
                if (element.value.length > maxLength) {
                  element.value = element.value.slice(0, maxLength);
                }
              }
            </script>

            <div class="form-group mb-3">
              <label for="address_id" class="fw-bold text-uppercase mb-1 text-uppercase">Address</label>
              <select class="form-select" id="address_id" name="address_id" required>
                <option <?php echo (!isset($barangay)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $address_qry = $conn->query("SELECT * FROM `address` ORDER BY barangay ASC");
                while ($row = $address_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['address_id'] ?>" <?php echo (isset($barangay) && $barangay == $row['barangay'] . ', ' . $row['city']) ? 'selected' : '' ?>>
                    <?php echo $row['barangay'] . ', ' . $row['city'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="edu_id" class="fw-bold  text-uppercase">Educational Attainment</label>
              <select class="form-select" id="edu_id" name="edu_id" required>
                <option <?php echo (!isset($edu_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $edu_qry = $conn->query("SELECT * FROM education order by education asc");
                while ($row = $edu_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['edu_id'] ?>" <?php echo (isset($edu_id) && $edu_id == $row['edu_id']) ? 'selected' : '' ?>><?php echo $row['education'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group mb-3">
              <label for="dep_id" class="fw-bold  text-uppercase">Department</label>
              <select class="form-select" id="dep_id" name="dep_id" required>
                <option <?php echo (!isset($dep_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $dep_qry = $conn->query("SELECT * FROM department order by dep_name asc");
                while ($row = $dep_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['dep_id'] ?>" <?php echo (isset($dep_id) && $dep_id == $row['dep_id']) ? 'selected' : '' ?>><?php echo $row['dep_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="des_id" class="fw-bold  text-uppercase">Designation</label>
              <select class="form-select" id="des_id" name="des_id" required>
                <option <?php echo (!isset($des_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $des_qry = $conn->query("SELECT * FROM designation order by des_name asc");
                while ($row = $des_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['des_id'] ?>" <?php echo (isset($des_id) && $des_id == $row['des_id']) ? 'selected' : '' ?>><?php echo $row['des_name'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>

            <div class="form-group mb-3">
              <label for="es_id" class="fw-bold text-uppercase">Employment Status</label>
              <select class="form-select" id="es_id" name="es_id" required>
                <option <?php echo (!isset($user_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $user_qry = $conn->query("SELECT * FROM employment_status ORDER BY es_name ASC");
                while ($row = $user_qry->fetch_assoc()) :
                  // Fetch the es_income for each employment status
                  $es_income = $row['es_income'];
                ?>
                  <option value="<?php echo $row['es_id'] ?>" <?php echo (isset($es_id) && $es_id == $row['es_id']) ? 'selected' : '' ?>>
                    <?php echo $row['es_name'] . " - $es_income Default Daily Income"; ?>
                  </option>
                <?php endwhile; ?>
              </select>
            </div>


            <div class="form-group mb-3">
              <label for="em_income" class="fw-bold text-uppercase">Daily Income</label>
              <input type="text" class="form-control" placeholder="Daily Income" name="em_income" id="em_income" aria-describedby="addon-wrapping" required>
            </div>


            <div class="form-group mb-3">
              <label for="user_id" class="fw-bold  text-uppercase">User Role</label>
              <select class="form-select" id="user_id" name="user_id" required>
                <option <?php echo (!isset($user_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                <?php
                $user_qry = $conn->query("SELECT * FROM user_type order by user_role asc");
                while ($row = $user_qry->fetch_assoc()) :
                ?>
                  <option value="<?php echo $row['user_id'] ?>" <?php echo (isset($user_id) && $user_id == $row['user_id']) ? 'selected' : '' ?>><?php echo $row['user_role'] ?></option>
                <?php endwhile; ?>
              </select>
            </div>
            <div class="form-group mb-3">
              <label for="em_joining_date" class="fw-bold  text-uppercase">Date of Joining</label>
              <input type="date" class="form-control" placeholder="" id="em_joining_date" aria-describedby="addon-wrapping" required>
            </div>
            <div class="form-group mb-3">
              <label for="em_contract_end" class="fw-bold  text-uppercase">Date of Leaving</label>
              <input type="date" class="form-control" placeholder="" id="em_contract_end" aria-describedby="addon-wrapping">
            </div>
            
            <div class="form-group mb-3">
              <label for="em_email" class="fw-bold text-uppercase">Email</label>
              <div class="input-group">
                <input type="email" class="form-control" placeholder="" id="em_email" aria-describedby="addon-wrapping">
                <span class="input-group-text">@ormochr.com</span>
              </div>
            </div>
            

            <div class="form-group mb-3">
              <label for="em_password" class="fw-bold text-uppercase">Password (Default)</label>
              <input type="text" class="form-control" placeholder="(Default Password)" id="em_password" aria-describedby="addon-wrapping" value="ormochr123" readonly>
            </div>


            <div class="form-group mb-3">
              <label for="em_profile_pic" class="fw-bold text-uppercase">Profile Picture</label>
              <input type="file" class="form-control" id="em_profile_pic" name="em_profile_pic" accept="image/*">
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>

  <div class="card card-outline card-primary m-3">
    <div class="card-header">
      <div class="panel-heading" style="padding: 2px !important;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Leave Types Permission</span></strong>
        </strong>
      </div>
    </div>

    <div class="card-body">
      <div class="container-fluid">
        <p id="message" class="text-danger"></p>
        <div class="row">
          <div class="col-12">
            <div class="form-group mb-3">
              <div class="row">
                <?php
                $leave_types_query = $conn->query("SELECT lt_id, lt_name, lt_credit FROM leave_type WHERE lt_status = 1");
                $total_leave_types = $leave_types_query->num_rows;
                $leave_types_per_column = ceil($total_leave_types / 2);

                $counter = 0;
                while ($leave_type = $leave_types_query->fetch_assoc()) {
                  if ($counter % $leave_types_per_column == 0) {
                    echo '<div class="col-md-6">';
                  }
                  echo '<div class="row">';
                  echo '<div class="col-5">';
                  echo '<div class="form-check my-1">';

                  echo '<input type="checkbox" id="leave_type_' . $leave_type['lt_id'] . '" name="leave_type_ids[]" value="' . $leave_type['lt_id'] . '" class="form-check-input leave-type-checkbox">';
                  echo '<label for="leave_type_' . $leave_type['lt_id'] . '" class="form-check-label">' . $leave_type['lt_name'] . '</label>';
                  echo '</div>';
                  echo '</div>';

                  echo '<div class="col-4 my-1">';
                  echo '<input type="number" id="credits_' . $leave_type['lt_id'] . '" name="leave_type_credits[]" class="form-control d-none leave-type-credit" value="' . $leave_type['lt_credit'] . '">';
                  echo '</div>';

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
      </div>
    </div>
  </div>

  <!-- Button trigger for saving modal -->
  <div class="m-4 text-end">
    <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="addEmployee" name="buttonSAVE" style="background-color: #2468a0;"><i class="fa-solid fa-check" style="color: #ffffff;">&nbsp;</i> Save
    </button>
    <a href="em_list.php" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose"><i class="fa-solid fa-delete-left" style="color: #000000"></i> Cancel</a>
  </div>

  <!-- Verification Modal -->
  <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>
        </div>
        <div class="modal-body">
          &nbsp;&nbsp;New Employee Added!. Thank you.
        </div>
        <div class="modal-footer">
          <a href="em_list.php"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
        </div>
      </div>
    </div>
  </div>
</form>

<script src="Employee/EmployeeJS.js"></script>
<script>
  document.addEventListener('DOMContentLoaded', function() {
    const checkboxes = document.querySelectorAll('.leave-type-checkbox');
    checkboxes.forEach(function(checkbox) {
      checkbox.addEventListener('change', function() {
        const leaveTypeId = this.value;
        const creditInput = document.getElementById('credits_' + leaveTypeId);
        if (this.checked) {
          creditInput.classList.remove('d-none');
        } else {
          creditInput.classList.add('d-none');
        }
      });
    });

    const barangaySelect = document.getElementById('address_id');
    const citySelect = document.getElementById('city');
    barangaySelect.addEventListener('change', function() {
      const selectedBarangay = barangaySelect.value;
      if (selectedBarangay) {
        // Make AJAX request to fetch city based on selected barangay
        $.ajax({
          url: 'Employee/fetchCity.php',
          method: 'POST',
          data: {
            barangay: selectedBarangay
          },
          success: function(data) {
            citySelect.value = data;
          },
          error: function(xhr, status, error) {
            console.error('Error fetching city:', error);
          }
        });
      } else {
        citySelect.value = '';
      }
    });
  });

  var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
  var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
    return new bootstrap.Tooltip(tooltipTriggerEl);
  });
</script>