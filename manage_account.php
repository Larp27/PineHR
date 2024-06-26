<?php
$title = 'Manage Account';
$page = 'manage_account';
include_once('./main.php');
?>

<?php
if (isset($_SESSION['s_em_id'])) {
  $em_id = ($_SESSION['s_em_id']);

  $query = "SELECT * FROM employee WHERE em_id = $em_id";
  $result = mysqli_query($conn, $query);

  if (mysqli_num_rows($result) > 0) {
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
    $employee_status = $row['employee_status'];
    $em_income = $row['em_income'];
  } else {
    echo "Employee not found";
  }
} else {
  echo "Employee ID not provided";
}
?>

<style>
  .select-photo-btn,
  .remove-photo-btn {
    --tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05);
    --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color);
    box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow);
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

  .select-photo-btn:hover,
  .remove-photo-btn:hover {
    background-color: rgb(249 250 251);
    transition-timing-function: cubic-bezier(.4, 0, .2, 1);
    transition-duration: .15s;
    border-color: rgb(209 213 219);
    border-width: 1px;
    border-radius: 0.375rem;
  }
</style>

<form method="post" id="updateEmployeeForm" enctype="multipart/form-data">
  <input type="hidden" id="em_id" name="em_id" value="<?php echo $_SESSION['s_em_id']; ?>">
  <div class="panel panel-default">
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;
        <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Manage Account</strong></span>
      </strong>
    </div>
  </div>
  <div style="height:100vh;">
    <div class="card card-outline card-primary m-3 mb-4">
      <div class="card-header">
        <div class="panel-heading" style="padding: 2px !important;">
          <strong>
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'">Update Information Details</span></strong>
          </strong>
        </div>
      </div>

      <div class="card-body">
        <div class="container-fluid">
          <p id="message" class=text-danger></p>
          <div class="row">
            <div class="col-6">
              <div class="form-group mb-3">
                <label for="first_name" class="fw-bold text-uppercase">First Name</label>
                <input type="text" class="form-control" placeholder="Employee's First Name" name="first_name" id="first_name" aria-describedby="addon-wrapping" required value="<?php echo isset($first_name) ? $first_name : ''; ?>">
              </div>
              <div class="form-group mb-3">
                <label for="last_name" class="fw-bold text-uppercase">Last Name</label>
                <input type="text" class="form-control" placeholder="Employee's Last Name" id="last_name" name="last_name" value="<?php echo isset($last_name) ? $last_name : ''; ?>" aria-describedby="addon-wrapping" required>
              </div>
              <div class="form-group mb-3">
                <label for="em_birthday" class="fw-bold text-uppercase">Date of Birth</label>
                <input type="date" name="em_birthday" id="em_birthday" class="form-control" aria-describedby="addon-wrapping" required value="<?php echo isset($em_birthday) ? $em_birthday : ''; ?>">
              </div>
              <div class="form-group mb-3">
                <label for="em_phone" class="fw-bold text-uppercase">Contact Number</label>
                <input type="text" name="em_phone" id="em_phone" class="form-control" aria-describedby="addon-wrapping" required value="<?php echo isset($em_phone) ? $em_phone : ''; ?>">
              </div>
              <div class="form-group mb-3">
                <label for="address_id" class="fw-bold text-uppercase mb-1 text-uppercase">Address</label>
                <select class="form-select" id="address_id" name="address_id" required>
                  <option disabled>Please Select Here</option>
                  <?php
                  $address_qry = $conn->query("SELECT * FROM `address` ORDER BY barangay ASC");
                  while ($address_row = $address_qry->fetch_assoc()) :
                    $selected = ($address_id == $address_row['address_id']) ? 'selected' : '';
                  ?>
                    <option value="<?php echo $address_row['address_id'] ?>" <?php echo $selected ?>>
                      <?php echo $address_row['barangay'] . ', ' . $address_row['city'] ?>
                    </option>
                  <?php endwhile; ?>
                </select>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group mb-3">
                <label for="em_email" class="fw-bold text-uppercase">Email</label>
                <div class="input-group">
                  <input type="email" name="em_email" id="em_email" class="form-control" aria-describedby="addon-wrapping" value="<?php echo isset($em_email) ? $em_email : ''; ?>">
                  <span class="input-group-text">@ormochr.com</span>
                </div>
              </div>
              <div class="form-group mb-3 password-toggle">
                <label for="current_password" class="form-label fw-bold text-uppercase">Current Password</label>
                <input type="password" class="form-control" id="current_password" name="current_password">
                <i id="toggleCurrent_password" class="toggle-icon fas fa-eye-slash" style="display: none; float: right; margin-left: -30px; margin-top: -25px; margin-right: 10px; position: relative; z-index: 2;" onclick="togglePassword('current_password')"></i>
              </div>
              <div class="form-group mb-3 password-toggle">
                <label for="new_password" class="form-label fw-bold text-uppercase">New Password</label>
                <input type="password" class="form-control" id="new_password" name="new_password">
                <i id="toggleNew_password" class="toggle-icon fas fa-eye-slash" style="display: none; float: right; margin-left: -30px; margin-top: -25px; margin-right: 10px; position: relative; z-index: 2;" onclick="togglePassword('new_password')"></i>
              </div>

              <div class="form-group mb-3">
                <label for="em_profile_pic" class="fw-bold text-uppercase">Profile Picture</label>
                <div class="mb-2">
                  <img src="../PINEHR/<?php echo substr($em_profile_pic, 3); ?>" style="width: 250px;" alt="Profile Photo" class="profile-photo">
                </div>
                <div class="mb-3 mx-4">
                  <button type="button" class="btn select-photo-btn">Select a new photo</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <div class="m-4 text-end">
      <button type="button" class="btn btn-success text-bold" name="manage_account_btn" id="manage_account_btn">UPDATE</button>
    </div>

    <!--Fill in Necessary fields error -->
    <script>
      document.getElementById('manage_account_btn').addEventListener('click', function() {
        // Get all required input fields
        var requiredFields = document.querySelectorAll('[required]');

        // Flag to track if any required field is empty
        var isEmpty = false;

        // Check if any required field is empty
        requiredFields.forEach(function(field) {
          if (!field.value.trim()) {
            isEmpty = true;
            field.classList.add('is-invalid'); // Add class to highlight the field
          } else {
            field.classList.remove('is-invalid'); // Remove class if the field is filled
          }
        });

        // If any required field is empty, show error message and prevent modal from showing
        if (isEmpty) {
          document.getElementById('message').textContent = 'Please fill in all required fields.';
        } else {
          // Submit the form if all required fields are filled
          document.getElementById('updateEmployeeForm').submit();
        }
      });
    </script>

    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>
          </div>
          <div class="modal-body">
            &nbsp;&nbsp;Updated Successfuly!. Thank you.
          </div>
          <div class="modal-footer">
            <a href="manage_account.php"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
          </div>
        </div>
      </div>
    </div>
</form>

<script>
  document.addEventListener('DOMContentLoaded', function() {
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

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
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

  function togglePassword(id) {
    let passwordField = document.getElementById(id);
    let toggleIcon = document.getElementById('toggle' + id.charAt(0).toUpperCase() + id.slice(1));

    if (passwordField.type === 'password') {
      passwordField.type = 'text';
      toggleIcon.classList.remove('fa-eye-slash');
      toggleIcon.classList.add('fa-eye');
    } else {
      passwordField.type = 'password';
      toggleIcon.classList.remove('fa-eye');
      toggleIcon.classList.add('fa-eye-slash');
    }
  }

  // Add event listeners to the password fields to toggle the eye icon visibility dynamically
  document.getElementById('current_password').addEventListener('input', function() {
    let toggleIcon = document.getElementById('toggleCurrent_password');
    if (this.value !== '') {
      toggleIcon.style.display = 'inline-block';
    } else {
      toggleIcon.style.display = 'none';
    }

    // Add required attribute to password fields based on user input
    const newPasswordInput = document.getElementById('new_password');
    if (this.value !== '') {
      this.setAttribute('required', 'required');
      newPasswordInput.setAttribute('required', 'required');
    } else {
      this.removeAttribute('required');
      newPasswordInput.removeAttribute('required');
    }
  });

  document.getElementById('new_password').addEventListener('input', function() {
    let toggleIcon = document.getElementById('toggleNew_password');
    if (this.value !== '') {
      toggleIcon.style.display = 'inline-block';
    } else {
      toggleIcon.style.display = 'none';
    }

    const currentPasswordInput = document.getElementById('current_password');
    if (this.value !== '') {
      this.setAttribute('required', 'required');
      currentPasswordInput.setAttribute('required', 'required');
    } else {
      this.removeAttribute('required');
      currentPasswordInput.removeAttribute('required');
    }
  });
</script>
<script src="manage_account.js"></script>