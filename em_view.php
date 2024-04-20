<?php
  $title = 'Employee';
  $page = 'employee_edit';
  include_once('./main.php');
?>

<?php
  if(isset($_GET['em_id'])) {
    $em_id = $_GET['em_id'];

    $query = "SELECT * FROM employee WHERE em_id = $em_id";
    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);
      
      $em_id = $row['em_id'];
      $des_id = $row['des_id'];
      $dep_id = $row['dep_id'];
      $bt_id = $row['bt_id'];
      $user_id = $row['user_id'];
      $es_id = $row['es_id'];
      $address_id = $row['address_id'];
      $edu_id = $row['edu_id'];
      $r_id = $row['r_id'];
      $ms_id = $row['ms_id'];
      $first_name = $row['first_name'];
      $last_name = $row['last_name'];
      $em_email = $row['em_email'];
      $em_gender = $row['em_gender'];
      $em_phone = $row['em_phone'];
      $em_birthday = $row['em_birthday'];
      $em_joining_date = $row['em_joining_date'];
      $em_contract_end = $row['em_contract_end'];
      $em_profile_pic = $row['em_profile_pic'];
    } else {
      echo "Employee not found";
    }
  } else {
    echo "Employee ID not provided";
  }
?>

<style>
  .select-photo-btn, .remove-photo-btn {
    --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);
    --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000),var(--tw-ring-shadow, 0 0 #0000),var(--tw-shadow);
    color: rgb(55 65 81);
    text-transform: uppercase;
    font-weight: 600;
    font-size: .75rem;
    line-height: 1rem;
    letter-spacing: .1em;
    margin-right: 5px;
    padding: 0.5rem 1rem;
    border-color: rgb(209 213 219);
    border-width: 1px;
    border-radius: 0.375rem;
    text-align: center;
  }

  .select-photo-btn:hover, .remove-photo-btn:hover {
    background-color: rgb(249 250 251);
    transition-timing-function: cubic-bezier(.4,0,.2,1);
    transition-duration: .15s;
    border-color: rgb(209 213 219);
    border-width: 1px;
    border-radius: 0.375rem;
  }
</style>

<input type="hidden" id="em_id" name="em_id" value="<?php echo $_GET['em_id']; ?>">
<div class="panel panel-default">
  <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;" >
    <strong>
      &nbsp;
      <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</strong></span>
    </strong>
  </div>
</div>
<div>
  <div class="card card-outline card-primary m-3 mb-4">
    <div class="card-header">
      <div class="panel-heading" style="padding: 2px !important;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;View Employee</span></strong>
        </strong>
      </div>
    </div>

    <div class="card-body">
      <div class="container-fluid">
        <p id = "message" class = text-danger></p>
        <div class="row">
          <div class="col-6">
            <div class="form-group mb-3">
              <label for="first_name" class="fw-bold text-uppercase">First Name</label>
              <input type="text" class="form-control" placeholder="Employee's First Name" name="first_name" id="first_name" aria-describedby="addon-wrapping" required value="<?php echo isset($first_name) ? $first_name : ''; ?>" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="last_name" class="fw-bold text-uppercase">Last Name</label>
              <input type="text" class="form-control" placeholder="Employee's Last Name" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" aria-describedby="addon-wrapping" required readonly>
            </div>
            <div class="form-group mb-3">
              <label for="em_gender" class="fw-bold text-uppercase">Gender</label>
              <input type="text" class="form-control" placeholder="Employee's Last Name" id="last_name" name="last_name" value="<?php echo isset($em_gender) ? $em_gender : ''; ?>" aria-describedby="addon-wrapping" required readonly>
            </div>
            <div class="form-group mb-3">
              <label for="ms_id" class="fw-bold text-uppercase">Marital Status</label>
              <?php
                $ms_qry = $conn->query("SELECT * FROM marital_status WHERE ms_id = '$ms_id'");
                if ($ms_qry) {
                  if ($ms_row = $ms_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $ms_row['ms_name'] . "' readonly>";
                  }
                  $ms_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="r_id" class="fw-bold text-uppercase">Religion</label>
              <?php
                $r_qry = $conn->query("SELECT * FROM religion WHERE r_id = '$r_id'");
                if ($r_qry) {
                  if ($r_row = $r_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $r_row['r_name'] . "' readonly>";
                  }
                  $r_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="bt_id" class="fw-bold text-uppercase">Bloodtype</label>
              <?php
                $bt_qry = $conn->query("SELECT * FROM blood_group WHERE bt_id = '$bt_id'");
                if ($bt_qry) {
                  if ($bt_row = $bt_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $bt_row['bt_name'] . "' readonly>";
                  }
                  $bt_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="em_birthday" class="fw-bold text-uppercase">Date of Birth</label>
              <input type="text" name="em_birthday" id="em_birthday" class="form-control" aria-describedby="addon-wrapping" required value="<?php echo isset($em_birthday) ? $em_birthday : ''; ?>" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="em_phone" class="fw-bold text-uppercase">Contact Number</label>
              <input type="text" name="em_phone" id="em_phone" class="form-control" aria-describedby="addon-wrapping" required value="<?php echo isset($em_phone) ? $em_phone : ''; ?>" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="address_id" class="fw-bold text-uppercase mb-1 text-uppercase">Address</label>
              <?php
                $address_qry = $conn->query("SELECT * FROM address WHERE address_id = '$address_id'");
                if ($address_qry) {
                  if ($address_row = $address_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $address_row['barangay'] . ', ' . $address_row['city'] . "' readonly>";
                  }
                  $address_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="edu_id" class="fw-bold text-uppercase">Educational Attainment</label>
              <?php
                $edu_qry = $conn->query("SELECT * FROM education WHERE edu_id = '$edu_id'");
                if ($edu_qry) {
                  if ($edu_row = $edu_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $edu_row['education'] . "' readonly>";
                  }
                  $edu_qry->close();
                } 
              ?>
            </div>
          </div>
          <div class="col-6">
            <div class="form-group mb-3">
              <label for="dep_id" class="fw-bold text-uppercase">Department</label>
              <?php
                $dep_qry = $conn->query("SELECT * FROM department WHERE dep_id = '$dep_id'");
                if ($dep_qry) {
                  if ($dep_row = $dep_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $dep_row['dep_name'] . "' readonly>";
                  }
                  $dep_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="des_id" class="fw-bold text-uppercase">Designation</label>
              <?php
                $des_qry = $conn->query("SELECT * FROM designation WHERE des_id = '$des_id'");
                if ($des_qry) {
                  if ($des_row = $des_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $des_row['des_name'] . "' readonly>";
                  }
                  $des_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="es_id" class="fw-bold text-uppercase">Employment Status</label>
              <?php
                $es_qry = $conn->query("SELECT * FROM employment_status WHERE es_id = '$es_id'");
                if ($es_qry) {
                  if ($es_row = $es_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $es_row['es_name'] . "' readonly>";
                  }
                  $es_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="user_id" class="fw-bold text-uppercase">User Role</label>
              <?php
                $user_qry = $conn->query("SELECT * FROM user_type WHERE user_id = '$user_id'");
                if ($user_qry) {
                  if ($user_row = $user_qry->fetch_assoc()) {
                    echo "<input type='text' class='form-control' value='" . $user_row['user_role'] . "' readonly>";
                  }
                  $user_qry->close();
                } 
              ?>
            </div>
            <div class="form-group mb-3">
              <label for="em_joining_date" class="fw-bold text-uppercase">Date of Joining</label>
              <input type="text" class="form-control" placeholder="" id="em_joining_date" name="em_joining_date" aria-describedby="addon-wrapping" required value="<?php echo isset($em_joining_date) ? $em_joining_date : ''; ?>" readonly>
            </div>
            <div class="form-group mb-3">
              <label for="em_contract_end" class="fw-bold text-uppercase">Date of Leaving</label>
              <input type="text" class="form-control" placeholder="" id="em_contract_end" name="em_contract_end" aria-describedby="addon-wrapping" value="<?php echo isset($em_contract_end) ? $em_contract_end : ''; ?>" readonly>
            </div>
            <div class="form-group">
              <label for="em_email" class="fw-bold text-uppercase">Email</label>
              <input type="text" name="em_email" id="em_email" class="form-control" aria-describedby="addon-wrapping" value="<?php echo isset($em_email) ? $em_email : ''; ?>" readonly>
            </div>

            <div class="form-group mb-3"><br>
              <label for="em_profile_pic" class="fw-bold text-uppercase">Profile Picture</label>
              <div class="mt-2">
                <img src="../PINEHR/<?php echo substr($em_profile_pic, 3); ?>" style="width: 200px;" alt="Profile Photo" class="profile-photo">
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div>
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
                  $leave_types_query = $conn->query("SELECT lt.lt_id, lt.lt_name, IFNULL(elc.available_credits, lt.lt_credit) AS lt_credit FROM leave_type lt LEFT JOIN employee_leave_credits elc ON lt.lt_id = elc.lt_id AND elc.em_id = $em_id WHERE elc.em_id = $em_id");
                  $total_leave_types = $leave_types_query->num_rows;
                  $leave_types_per_column = ceil($total_leave_types / 2); 

                  $counter = 0;
                  while ($leave_type = $leave_types_query->fetch_assoc()) {
                    if ($counter % $leave_types_per_column == 0) {
                        echo '<div class="col-md-6">';
                    }
                    echo '<div class="row">';
                    echo '<div class="col-6">';
                    echo '<div class="form-check my-1">';

                    echo '<li type="text" id="leave_type_' . $leave_type['lt_id'] . '" name="leave_type_ids[]" value="' . $leave_type['lt_id'] . '" class="leave-type-checkbox text-capitalize" read-only>' . $leave_type['lt_name'] . ' <span class="text-lowercase">(' . $leave_type['lt_credit'] . ' Remaining Credits)</span></li>';

                    echo '</div>';
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
</div>

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
      <a href = "em_list.php"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
    </div>
    </div>
  </div>
</div>  


<script>
  document.addEventListener('DOMContentLoaded', function () {
    const checkboxes = document.querySelectorAll('.leave-type-checkbox');
    checkboxes.forEach(function (checkbox) {
      checkbox.addEventListener('change', function () {
        const leaveTypeId = this.value;
        const creditInput = document.getElementById('credits_' + leaveTypeId);
        if (this.checked) {
          creditInput.classList.remove('d-none');
        } else {
          creditInput.classList.add('d-none');
        }
      });
      
      // Trigger change event for checkboxes on page load to initially show/hide credit input fields
      checkbox.dispatchEvent(new Event('change'));
    });

    // Check the checkboxes for leave types with available credits
    <?php
      $leave_credits_query = $conn->query("SELECT lt_id FROM employee_leave_credits WHERE em_id = $em_id");
      while ($row = $leave_credits_query->fetch_assoc()) {
        $lt_id = $row['lt_id'];
        echo "document.getElementById('leave_type_$lt_id').checked = true;\n";
        echo "document.getElementById('credits_$lt_id').classList.remove('d-none');\n";
      }
    ?>

    const barangaySelect = document.getElementById('address_id');
    const citySelect = document.getElementById('city');
    barangaySelect.addEventListener('change', function () {
      const selectedBarangay = barangaySelect.value;
      if (selectedBarangay) {
        // Make AJAX request to fetch city based on selected barangay
        $.ajax({
          url: 'Employee/fetchCity.php',
          method: 'POST',
          data: { barangay: selectedBarangay },
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

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl);
    });
  });

  document.querySelector('.select-photo-btn').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.id = 'em_profile_pic';
    input.name = 'em_profile_pic';
    input.onchange = function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.querySelector('.profile-photo');
          img.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };
    input.click();

    const form = document.querySelector('form');
    form.appendChild(input);
  });


  // INITIALIZE DATATABLE
  $(document).ready(function() {
    $('#example').DataTable();
  });
</script>
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
<script src="Employee/updateEM.js"></script>