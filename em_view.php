<?php
  $title = 'Employee';
  $page = 'employee_edit';
  include_once('./main.php');
?>

<?php
  if(isset($_GET['em_id'])) {
    $em_id = $_GET['em_id'];

    $query = "SELECT employee.*, employee_family_background.*, employee_children.*, employee_educational_background.* FROM employee LEFT JOIN employee_family_background ON employee.em_id = employee_family_background.employee_id LEFT JOIN employee_children ON employee.em_id = employee_children.employee_id LEFT JOIN employee_educational_background ON employee.em_id = employee_educational_background.employee_id WHERE employee.em_id = $em_id";
    $result = mysqli_query($conn, $query);

    // Check if there are children records
    $children_data = [];

    if (mysqli_num_rows($result) > 0) {
      $row = mysqli_fetch_assoc($result);

      // while ($row) {
      //   // Assuming child data is in employee_children table
      //   $child_name = $row['child_name']; // Adjust based on your column name
      //   $child_dob = $row['child_date_of_birth']; // Adjust based on your column name

      //   $children_data[] = [
      //     'child_name' => $child_name,
      //     'child_dob' => $child_dob
      //   ];
      // }

      function check_empty($value, $columnName) {
        if (empty($value)) {
          return "N/A $columnName";
        } else {
          return $value;
        }
      }

      // EMPLOYMENT DETAILS & SYSTEM CREDENTIALS
      $em_id = check_empty($row['em_id'], 'Employee ID');
      $dep_id = check_empty($row['dep_id'], 'Department ID');
      $des_id = check_empty($row['des_id'], 'Designation ID');
      $es_id = check_empty($row['es_id'], 'ES ID');
      $em_joining_date = check_empty($row['em_joining_date'], 'Joining Date');
      $em_contract_end = check_empty($row['em_contract_end'], 'Contract End Date');
      $em_income = check_empty($row['em_income'], 'Income');
      $employee_status = check_empty($row['employee_status'], 'Employee Status');
      $user_id = check_empty($row['user_id'], 'User ID');
      $em_password = check_empty($row['em_password'], 'Password');
      $em_profile_pic = check_empty($row['em_profile_pic'], 'Profile Picture');

      // PERSONAL INFORMATION
      $last_name = check_empty($row['last_name'], 'Last Name');
      $first_name = check_empty($row['first_name'], 'First Name');
      $name_extension = check_empty($row['name_extension'], 'Name Extension');
      $middle_name = check_empty($row['middle_name'], 'Middle Name');
      $date_of_birth = check_empty($row['date_of_birth'], 'Date of Birth');
      $place_of_birth = check_empty($row['place_of_birth'], 'Place of Birth');
      $sex = check_empty($row['sex'], 'Sex');
      $civil_status = check_empty($row['civil_status'], 'Civil Status');
      $citizenship = check_empty($row['citizenship'], 'Citizenship');
      $dual_citizenship_type = check_empty($row['dual_citizenship_type'], 'Dual Citizenship Type');
      $dual_citizenship_country = check_empty($row['dual_citizenship_country'], 'Dual Citizenship Country');
      $height = check_empty($row['height'], 'Height');
      $weight = check_empty($row['weight'], 'Weight');
      $blood_type = check_empty($row['blood_type'], 'Blood Type');
      $gsis_id_no = check_empty($row['gsis_id_no'], 'GSIS ID No');
      $pagibig_id_no = check_empty($row['pagibig_id_no'], 'Pagibig ID No');
      $philhealth_no = check_empty($row['philhealth_no'], 'Philhealth No');
      $sss_no = check_empty($row['sss_no'], 'SSS No');
      $tin_no = check_empty($row['tin_no'], 'TIN No');
      $agency_employee_no = check_empty($row['agency_employee_no'], 'Agency Employee No');
      $telephone_no = check_empty($row['telephone_no'], 'Telephone No');
      $mobile_no = check_empty($row['mobile_no'], 'Mobile No');
      $email_address = check_empty($row['em_email'], 'Email Address');
      $residential_house_block_lot_no = check_empty($row['residential_house_block_lot_no'], 'Residential House/Block/Lot No');
      $residential_street = check_empty($row['residential_street'], 'Residential Street');
      $residential_subdivision_village = check_empty($row['residential_subdivision_village'], 'Residential Subdivision/Village');
      $residential_barangay = check_empty($row['residential_barangay'], 'Residential Barangay');
      $residential_city_municipality = check_empty($row['residential_city_municipality'], 'Residential City/Municipality');
      $residential_province = check_empty($row['residential_province'], 'Residential Province');
      $residential_zip_code = check_empty($row['residential_zip_code'], 'Residential Zip Code');
      $permanent_house_block_lot_no = check_empty($row['permanent_house_block_lot_no'], 'Permanent House/Block/Lot No');
      $permanent_street = check_empty($row['permanent_street'], 'Permanent Street');
      $permanent_subdivision_village = check_empty($row['permanent_subdivision_village'], 'Permanent Subdivision/Village');
      $permanent_barangay = check_empty($row['permanent_barangay'], 'Permanent Barangay');
      $permanent_city_municipality = check_empty($row['permanent_city_municipality'], 'Permanent City/Municipality');
      $permanent_province = check_empty($row['permanent_province'], 'Permanent Province');
      $permanent_zip_code = check_empty($row['permanent_zip_code'], 'Permanent Zip Code');

      // FAMILY BACKGROUND INFORMATION
      $spouse_surname = check_empty($row['spouse_surname'], 'Spouse Surname');
      $spouse_first_name = check_empty($row['spouse_first_name'], 'Spouse First Name');
      $spouse_name_extension = check_empty($row['spouse_name_extension'], 'Spouse Name Extension');
      $spouse_middle_name = check_empty($row['spouse_middle_name'], 'Spouse Middle Name');
      $spouse_occupation = check_empty($row['spouse_occupation'], 'Spouse Occupation');
      $spouse_employer_name = check_empty($row['spouse_employer_name'], 'Spouse Employer Name');
      $spouse_business_address = check_empty($row['spouse_business_address'], 'Spouse Business Address');
      $spouse_telephone_no = check_empty($row['spouse_telephone_no'], 'Spouse Telephone No');

      $father_surname = check_empty($row['father_surname'], 'Father Surname');
      $father_first_name = check_empty($row['father_first_name'], 'Father First Name');
      $father_name_extension = check_empty($row['father_name_extension'], 'Father Name Extension');
      $father_middle_name = check_empty($row['father_middle_name'], 'Father Middle Name');

      $mother_maiden_surname = check_empty($row['mother_maiden_surname'], 'Mother Maiden Surname');
      $mother_first_name = check_empty($row['mother_first_name'], 'Mother First Name');
      $mother_middle_name = check_empty($row['mother_middle_name'], 'Mother Middle Name');

      // EDUCATIONAL BACKGROUND
      $elementary_school_name = check_empty($row['elementary_school_name'], 'Elementary School Name');
      $elementary_education = check_empty($row['elementary_education'], 'Elementary Basic Education/Degree/Course');
      $elementary_period_of_attendance_from = check_empty($row['elementary_period_of_attendance_from'], 'Elementary Period of Attendance From');
      $elementary_period_of_attendance_to = check_empty($row['elementary_period_of_attendance_to'], 'Elementary Period of Attendance To');
      $elementary_year_graduated = check_empty($row['elementary_year_graduated'], 'Elementary Year Graduated');
      $elementary_highest_level_earned = check_empty($row['elementary_highest_level_earned'], 'Elementary Highest Level/Units Earned');
      $elementary_scholarship_or_academic_received = check_empty($row['elementary_scholarship_or_academic_received'], 'Elementary Scholarship or Academic Honors Received');

      $secondary_school_name = check_empty($row['secondary_school_name'], 'Secondary School Name');
      $secondary_education = check_empty($row['secondary_education'], 'Secondary Basic Education/Degree/Course');
      $secondary_period_of_attendance_from = check_empty($row['secondary_period_of_attendance_from'], 'Secondary Period of Attendance From');
      $secondary_period_of_attendance_to = check_empty($row['secondary_period_of_attendance_to'], 'Secondary Period of Attendance To');
      $secondary_year_graduated = check_empty($row['secondary_year_graduated'], 'Secondary Year Graduated');
      $secondary_highest_level_earned = check_empty($row['secondary_highest_level_earned'], 'Secondary Highest Level/Units Earned');
      $secondary_scholarship_or_academic_received = check_empty($row['secondary_scholarship_or_academic_received'], 'Secondary Scholarship or Academic Honors Received');

      $vocational_school_name = check_empty($row['vocational_school_name'], 'Vocational School Name');
      $vocational_education = check_empty($row['vocational_education'], 'Vocational Basic Education/Degree/Course');
      $vocational_period_of_attendance_from = check_empty($row['vocational_period_of_attendance_from'], 'Vocational Period of Attendance From');
      $vocational_period_of_attendance_to = check_empty($row['vocational_period_of_attendance_to'], 'Vocational Period of Attendance To');
      $vocational_year_graduated = check_empty($row['vocational_year_graduated'], 'Vocational Year Graduated');
      $vocational_highest_level_earned = check_empty($row['vocational_highest_level_earned'], 'Vocational Highest Level/Units Earned');
      $vocational_scholarship_or_academic_received = check_empty($row['vocational_scholarship_or_academic_received'], 'Vocational Scholarship or Academic Honors Received');

      $college_school_name = check_empty($row['college_school_name'], 'College School Name');
      $college_education = check_empty($row['college_education'], 'College Basic Education/Degree/Course');
      $college_period_of_attendance_from = check_empty($row['college_period_of_attendance_from'], 'College Period of Attendance From');
      $college_period_of_attendance_to = check_empty($row['college_period_of_attendance_to'], 'College Period of Attendance To');
      $college_year_graduated = check_empty($row['college_year_graduated'], 'College Year Graduated');
      $college_highest_level_earned = check_empty($row['college_highest_level_earned'], 'College Highest Level/Units Earned');
      $college_scholarship_or_academic_received = check_empty($row['college_scholarship_or_academic_received'], 'College Scholarship or Academic Honors Received');

      $graduate_studies_school_name = check_empty($row['graduate_studies_school_name'], 'Graduate Studies School Name');
      $graduate_studies_education = check_empty($row['graduate_studies_education'], 'Graduate Studies Basic Education/Degree/Course');
      $graduate_studies_period_of_attendance_from = check_empty($row['graduate_studies_period_of_attendance_from'], 'Graduate Studies Period of Attendance From');
      $graduate_studies_period_of_attendance_to = check_empty($row['graduate_studies_period_of_attendance_to'], 'Graduate Studies Period of Attendance To');
      $graduate_studies_year_graduated = check_empty($row['graduate_studies_year_graduated'], 'Graduate Studies Year Graduated');
      $graduate_studies_highest_level_earned = check_empty($row['graduate_studies_highest_level_earned'], 'Graduate Studies Highest Level/Units Earned');
      $graduate_studies_scholarship_or_academic_received = check_empty($row['graduate_studies_scholarship_or_academic_received'], 'Graduate Studies Scholarship or Academic Honors Received');

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
  .readonly-checkbox {
    pointer-events: none; /* Prevents clicking */
  }
  .readonly-checkbox:checked {
    background-color: #007bff; /* Blue background color when checked */
    border-color: #007bff; /* Blue border color when checked */
  }
  .collapsible {
    background-color: #cae1ef;
    color: #333;
    cursor: pointer;
    padding-top: 15px;
    padding-left: 15px;
    margin-top: 5px;
    margin-bottom: 20px;
    width: 100%;
    border: none;
    text-align: left;
    outline: none;
    font-size: 18px;
    transition: 0.4s;
  }
  .collapsible:hover {
    background-color: #e2e6ea;
  }
  .collapsible-active-button {
    background-color: #2292d6 !important;
    color: white !important;
  }
  .collapsible-inactive-button {
    background-color: #cae1ef;
    color: black;
  }
  .collapsible:after {
    content: '\f078';
    font-family: "Font Awesome 5 Free";
    font-weight: 900;
    float: right;
    margin-left: 5px;
  }
  .collapsible-content {
    padding: 0 15px;
    display: none;
    overflow: hidden;
    background-color: #f1f1f1;
    border: 1px solid #ddd;
  }
  .form-control {
    margin-bottom: 15px;
  }
  label {
    text-transform: uppercase;
    font-weight: bold;
  }
</style>

<input type="hidden" id="em_id" name="em_id" value="<?php echo $_GET['em_id']; ?>">

<div class="panel panel-default">
  <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
    <strong>
      &nbsp;
      <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</strong></span>
    </strong>
  </div>
</div>

<main class="container mt-4 p-1">
  <div class="row">
    <div class="col-10 text-uppercase nav-top" id="mainPersonalDataSheetForm">
      <h6 class="title-head fw-bold">View Employee Personal Data Form</span></h6>
    </div>
    <div class="col-1 justify-content-end text-end">
      <button onclick='printEmployeeData(<?php echo $em_id; ?>)' class='btn btn-info btn-sm text-end'><i class='fas fa-print'> </i> Print</button>
    </div>
  </div>

  <script>
    function printEmployeeData(em_id) {
      // Redirect to the print page with the employee ID as a parameter
      var newTab = window.open('print_employee.php?em_id=' + em_id, '', 'height=400,width=800');
      
      // Detect if print dialog is canceled
      newTab.onbeforeunload = function() {
        newTab.close(); // Close the new tab
      };
    }
  </script>

  <div class="mb-2 pt-3">
    <p id="message" class="text-danger"></p>
  </div>

  <section id="sectionForm" class="mt-4">
    <button type="button" class="collapsible fw-bold fs-5 d-flex" id="btnform1" onclick="toggleForm('form1', ['form2', 'form3', 'form4', 'form5'])">
      <p class="fs-6 fw-bold">I. Employment Details & System Credentials</p>
    </button>
    <div class="collapsible-content content-form content-container mt-2 mb-3" style="display: block;" id="form1">
      <div class="row mb-1 px-1 pt-3">
        <div class="col-6">
          <div class="form-group mb-3">
            <label for="dep_id" class="fw-bold text-uppercase">Department</label>
            <?php
            $dep_name = '';
            if (isset($dep_id)) {
              $dep_qry = $conn->query("SELECT dep_name FROM department WHERE dep_id = $dep_id");
              if ($dep_qry->num_rows > 0) {
                $dep_name = $dep_qry->fetch_assoc()['dep_name'];
              }
            }
            ?>
            <input type="text" class="form-control" id="dep_id" name="dep_id" value="<?php echo $dep_name; ?>" readonly style="pointer-events: none;">
          </div>

          <div class="form-group mb-3">
            <label for="des_id" class="fw-bold text-uppercase">Designation</label>
            <?php
            $des_name = '';
            if (isset($dep_id)) {
              $des_qry = $conn->query("SELECT des_name FROM designation WHERE des_id = $des_id");
              if ($des_qry->num_rows > 0) {
                $des_name = $des_qry->fetch_assoc()['des_name'];
              }
            }
            ?>
            <input type="text" class="form-control" id="des_id" name="des_id" value="<?php echo $des_name; ?>" readonly style="pointer-events: none;">
          </div>

          <div class="form-group mb-3">
            <label for="es_id" class="fw-bold text-uppercase">Employment Status</label>
            <?php
            $es_name = '';
            if (isset($es_id)) {
              $es_qry = $conn->query("SELECT es_name FROM employment_status WHERE es_id = $es_id");
              if ($es_qry->num_rows > 0) {
                $es_name = $es_qry->fetch_assoc()['es_name'];
              }
            }
            ?>
            <input type="text" class="form-control" id="es_id" name="es_id" value="<?php echo $es_name; ?>" readonly style="pointer-events: none;">
          </div>

          <div class="form-group mb-3">
            <label for="em_joining_date" class="fw-bold  text-uppercase">Date of Joining</label>
            <input type="date" class="form-control" placeholder="" id="em_joining_date"  value="<?php echo isset($em_joining_date) ? $em_joining_date : ''; ?>"  readonly style="pointer-events: none;">
          </div>
          <div class="form-group mb-3">
            <label for="em_contract_end" class="fw-bold  text-uppercase">Date of Leaving</label>
            <input type="date" class="form-control" placeholder="" id="em_contract_end" value="<?php echo isset($em_contract_end) ? $em_contract_end : ''; ?>"   readonly style="pointer-events: none;">
          </div>
        </div>
        <div class="col-6">
          <div class="form-group mb-3">
            <label for="em_income" class="fw-bold text-uppercase">Daily Income</label>
            <input type="text" class="form-control" placeholder="Daily Income" name="em_income" value="<?php echo isset($em_income) ? '₱' . $em_income : ''; ?>"  id="em_income"  readonly style="pointer-events: none;">
          </div>

          <div class="form-group mb-3">
            <label for="employee_status" class="fw-bold text-uppercase">Employee Status</label>
            <input type="text" class="form-control" name="employee_status" value="<?php echo isset($employee_status) ? $employee_status : ''; ?>"  id="employee_status"  readonly style="pointer-events: none;">
          </div>

          <div class="form-group">
            <label for="user_id" class="fw-bold text-uppercase">User Role</label>
            <?php
            $user_role = '';
            if (isset($user_id)) {
              $user_qry = $conn->query("SELECT user_role FROM user_type WHERE user_id = $user_id");
              if ($user_qry->num_rows > 0) {
                $user_role = $user_qry->fetch_assoc()['user_role'];
              }
            }
            ?>
            <input type="text" class="form-control" id="user_id" name="user_id" value="<?php echo $user_role; ?>" readonly style="pointer-events: none;">
          </div>

          <div class="form-group mb-3">
            <label for="em_profile_pic" class="fw-bold text-uppercase">Profile Picture</label>
            <div class="mt-1">
              <img src="../PINEHR/<?php echo substr($em_profile_pic, 3); ?>" style="width: 200px;" alt="Profile Photo" class="profile-photo">
            </div>
          </div>

        </div>
      </div>
    </div>

    <button type="button" class="collapsible fw-bold fs-5 d-flex" id="btnform2" onclick="toggleForm('form2', ['form1', 'form3', 'form4', 'form5'])">
      <p class="fs-6 fw-bold">II. Personal Information</p>
    </button>
    <div class="collapsible-content content-form content-container mt-2 mb-3" style="display: none;" id="form2">
      <div class="row mb-1 px-1 pt-3">
        <div class="col-md-6">
          <label>Surname</label>
          <input type="text" name="surname" id="surname" class="form-control" value="<?php echo $last_name; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label>First Name</label>
          <input type="text" name="first_name" id="first_name" class="form-control" value="<?php echo $first_name; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="middle_name">Middle Name</label>
          <input type="text" id="middle_name" name="middle_name" class="form-control" value="<?php echo $middle_name; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="name_extension">Name Extension (JR., SR)</label>
          <input type="text" id="name_extension" name="name_extension" class="form-control" value="<?php echo $name_extension; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="date_of_birth">Date of Birth</label>
          <input type="date" id="date_of_birth" name="date_of_birth" class="form-control" value="<?php echo $date_of_birth; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="place_of_birth">Place of Birth</label>
          <input type="text" id="place_of_birth" name="place_of_birth" class="form-control" value="<?php echo $place_of_birth; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label>Sex</label>
          <div class="mx-4 mt-2">
            <input type="checkbox" id="sex_male" name="sex" value="Male" class="readonly-checkbox" <?php if ($sex == 'Male') echo 'checked'; ?>> Male <span class="mx-3"></span>
            <input type="checkbox" id="sex_female" name="sex" value="Female" class="readonly-checkbox" <?php if ($sex == 'Female') echo 'checked'; ?>> Female
          </div>
        </div>

        <?php
          function getCivilStatusEnumValues($conn, $table, $column) {
            $query = "SHOW COLUMNS FROM $table LIKE '$column'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $enum = $row['Type'];
            preg_match("/^enum\(\'(.*)\'\)$/", $enum, $matches);
            $enum = explode("','", $matches[1]);
            return $enum;
          }

          $civilStatusOptions = getCivilStatusEnumValues($conn, 'employee', 'civil_status');
        ?>

        <div class="col-md-6">
          <label>Civil Status</label>
          <div class="mx-4 mt-2 mb-2">
            <?php foreach ($civilStatusOptions as $index => $status) { ?>
              <input type="checkbox" class="readonly-checkbox" name="civil_status" id="civil_status_<?php echo $index; ?>" value="<?php echo $status; ?>" <?php if ($status == $civil_status) echo 'checked'; ?>> <?php echo $status; ?>
              <span class="mx-3"></span>
            <?php } ?>
          </div>
        </div>

        <div class="col-md-6 mt-3 mb-3">
          <label>Citizenship</label>
          <div class="mx-4 mt-2">
            <input type="checkbox" name="citizenship" value="Filipino" class="readonly-checkbox" <?php if ($citizenship == 'Filipino') echo 'checked'; ?>> Filipino <span class="mx-3"></span>
            <input type="checkbox" name="citizenship" value="Dual Citizenship" class="readonly-checkbox" <?php if ($citizenship == 'Dual Citizenship') echo 'checked'; ?> onclick="toggleDualCitizenship(this)"> Dual Citizenship
          </div>
        </div>

        <script>
          document.addEventListener('DOMContentLoaded', function() {
            var dualCitizenshipCheckbox = document.querySelector('input[name="citizenship"][value="Dual Citizenship"]');
            var dualCitizenshipDetails = document.getElementById('dual-citizenship-details');
            var dualCitizenshipCountry = document.getElementById('dual-citizenship-country');
            
            if (dualCitizenshipCheckbox.checked) {
              dualCitizenshipDetails.classList.remove('d-none');
              dualCitizenshipCountry.classList.remove('d-none');
            }
          });
        </script>

        <div class="col-md-6 mt-3 d-none" id="dual-citizenship-details">
          <label for="dual_citizenship_type">Dual Citizenship Type</label>
          <div class="mx-4 mt-2">
            <input type="checkbox" name="dual_citizenship_type" value="by birth" onclick="checkOnlyOne(this)" <?php if ($dual_citizenship_type == 'by birth') echo 'checked'; ?>> by birth <span class="mx-3"></span>
            <input type="checkbox" name="dual_citizenship_type" value="by naturalization" onclick="checkOnlyOne(this)" <?php if ($dual_citizenship_type == 'by naturalization') echo 'checked'; ?>> by naturalization
          </div>
        </div>

        <div class="col-md-6 d-none" id="dual-citizenship-country">
          <label for="dualCitizenshipCountry">If holder of dual citizenship, please indicate the details</label>
          <select class="form-select" name="dualCitizenshipCountrySelect" id="dualCitizenshipCountrySelect" aria-label="select">
            <option value="" disabled <?php if (!$dual_citizenship_country) echo 'selected'; ?>>Select Country</option>
            <?php foreach ($countryOptions as $country) { ?>
              <option value="<?php echo $country; ?>" <?php if ($dual_citizenship_country == $country) echo 'selected'; ?>><?php echo $country; ?></option>
            <?php } ?>
          </select>
        </div>

        <div class="col-md-6">
          <label>Height (m)</label>
          <input type="text" name="height" id="height" class="form-control" value="<?php echo $height; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label>Weight (kg)</label>
          <input type="text" name="weight" id="weight" class="form-control" value="<?php echo $weight; ?>" readonly style="pointer-events: none;">
        </div>

        <?php
          function getBloodTypeEnumValues($conn, $table, $column) {
            $query = "SHOW COLUMNS FROM $table LIKE '$column'";
            $result = $conn->query($query);
            $row = $result->fetch_assoc();
            $enum = $row['Type'];
            preg_match("/^enum\(\'(.*)\'\)$/", $enum, $matches);
            $enum = explode("','", $matches[1]);
            return $enum;
          }

          $bloodTypes = getBloodTypeEnumValues($conn, 'employee', 'blood_type');
        ?>

        <div class="col-md-6">
          <label for="blood_type">Blood Type</label>
          <input type="text" class="form-control" id="blood_type" name="blood_type" value="<?php echo $blood_type; ?>" readonly style="pointer-events: none;">
        </div>


        <div class="col-md-6">
          <label for="gsis_id_no">GSIS ID No.</label>
          <input type="text" name="gsis_id_no" id="gsis_id_no" class="form-control" value="<?php echo $gsis_id_no; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="pagibig_id_no">PAG-IBIG ID No.</label>
          <input type="text" name="pagibig_id_no" id="pagibig_id_no" class="form-control" value="<?php echo $pagibig_id_no; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="philhealth_no">PhilHealth No.</label>
          <input type="text" name="philhealth_no" id="philhealth_no" class="form-control" value="<?php echo $philhealth_no; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="sss_no">SSS No.</label>
          <input type="text" name="sss_no" id="sss_no" class="form-control" value="<?php echo $sss_no; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="tin_no">TIN No.</label>
          <input type="text" name="tin_no" id="tin_no" class="form-control" value="<?php echo $tin_no; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="agency_employee_no">Agency Employee No.</label>
          <input type="text" name="agency_employee_no" id="agency_employee_no" class="form-control" value="<?php echo $agency_employee_no; ?>" readonly style="pointer-events: none;">
        </div>
      </div>

      <div class="row mb-1 px-1">
        <div class="col-md-6">
          <label for="residentialAddress" class="form-label">RESIDENTIAL ADDRESS</label>
          <input type="text" class="form-control mb-2" id="residentialHouseBlockLotNo" name="residentialHouseBlockLotNo" placeholder="House/Block/Lot No." value="<?php echo $residential_house_block_lot_no; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="residentialStreet" name="residentialStreet" placeholder="Street" value="<?php echo $residential_street; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="residentialSubdivisionVillage" name="residentialSubdivisionVillage" placeholder="Subdivision/Village" value="<?php echo $residential_subdivision_village; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="residentialBarangay" name="residentialBarangay" placeholder="Barangay" value="<?php echo $residential_barangay; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="residentialCityMunicipality" name="residentialCityMunicipality" placeholder="City/Municipality" value="<?php echo $residential_city_municipality; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="residentialProvince" placeholder="Province" name="residentialProvince" value="<?php echo $residential_province; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control" id="residentialZipCode" name="residentialZipCode" placeholder="ZIP CODE" value="<?php echo $residential_zip_code; ?>" readonly style="pointer-events: none;">
        </div>
        <div class="col-md-6">
          <label for="permanentAddress" class="form-label">PERMANENT ADDRESS</label>
          <input type="text" class="form-control mb-2" id="permanentHouseBlockLotNo" name="permanentHouseBlockLotNo" placeholder="House/Block/Lot No." value="<?php echo $permanent_house_block_lot_no; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="permanentStreet" name="permanentStreet" placeholder="Street" value="<?php echo $permanent_street; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="permanentSubdivisionVillage" name="permanentSubdivisionVillage" placeholder="Subdivision/Village" value="<?php echo $permanent_subdivision_village; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="permanentBarangay" name="permanentBarangay" placeholder="Barangay" value="<?php echo $permanent_barangay; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="permanentCityMunicipality" name="permanentCityMunicipality"  placeholder="City/Municipality" value="<?php echo $permanent_city_municipality; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control mb-2" id="permanentProvince" name="permanentProvince" placeholder="Province" value="<?php echo $permanent_province; ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control" id="permanentZipCode" name="permanentZipCode" placeholder="ZIP CODE" value="<?php echo $permanent_zip_code; ?>" readonly style="pointer-events: none;">
        </div>
      </div>
      <div class="row mb-1 px-1">
        <div class="col-md-6">
          <label>Telephone No.</label>
          <input type="text" name="telephone_no" id="telephone_no" class="form-control" value="<?php echo $telephone_no; ?>" readonly style="pointer-events: none;">
        </div>

        <?php
          // Check if the number starts with '+63' and remove it
          if (substr($mobile_no, 0, 3) == '+63') {
            $mobile_no = substr($mobile_no, 3);
          } 
          // Check if the number starts with '0' and remove it
          elseif (substr($mobile_no, 0, 1) == '0') {
            $mobile_no = substr($mobile_no, 1);
          }
        ?>

        <div class="col-md-6">
          <label>Mobile No.</label>
          <div class="input-group">
            <span class="input-group-text h-50">+63</span>
            <input type="text" name="mobile_no" id="mobile_no" class="form-control" value="<?php echo $mobile_no; ?>" readonly style="pointer-events: none;">
          </div>
        </div>
        <script>
          document.addEventListener("DOMContentLoaded", function() {
            var em_phone_input = document.getElementById("mobile_no");

            em_phone_input.addEventListener("input", function(event) {
              var value = event.target.value;
              // Remove any non-digit characters from the input value
              event.target.value = value.replace(/\D/g, '');
            });
          });

          function limitInputLength(element, maxLength) {
            if (element.value.length > maxLength) {
              element.value = element.value.slice(0, maxLength);
            }
          }
        </script>

        <div class="col-md-6">
          <label>Email Address</label>
          <input type="email" name="email_address" id="email_address" class="form-control" value="<?php echo $email_address; ?>" readonly style="pointer-events: none;">
        </div>
      </div>
    </div>

    <button type="button" class="collapsible fw-bold fs-5 d-flex" id="btnform3" onclick="toggleForm('form3', ['form5', 'form4', 'form2', 'form1'])">
      <p class="fs-6 fw-bold">III. Family Background</p>
    </button>
    <div class="collapsible-content content-form content-container mt-2 mb-3" style="display: none;" id="form3">
      <div class="row mb-1 px-1">
        <div class="col-md-12">
          <label for="spouseDetails" class="form-label pt-3">SPOUSE</label>
          <input type="text" class="form-control" id="spouseSurname" name="spouseSurname" placeholder="Spouse Surname" value="<?php echo ($spouse_surname); ?>" readonly style="pointer-events: none;">
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="spouseFirstName" name="spouseFirstName" placeholder="Spouse First Name" value="<?php echo ($spouse_first_name); ?>" readonly style="pointer-events: none;">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="spouseNameExtension" name="spouseNameExtension" placeholder="Spouse Name Extension (Jr., Sr.)" value="<?php echo ($spouse_name_extension); ?>" readonly style="pointer-events: none;">
            </div>
          </div>
          <input type="text" class="form-control" id="spouseMiddleName" name="spouseMiddleName" placeholder="Spouse Middle Name" value="<?php echo ($spouse_middle_name); ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control" id="spouseOccupation" name="spouseOccupation" placeholder="Spouse Occupation" value="<?php echo ($spouse_occupation); ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control" id="spouseEmployerName" name="spouseEmployerName" placeholder="Spouse Employer Name" value="<?php echo ($spouse_employer_name); ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control" id="spouseBusinessAddress" name="spouseBusinessAddress" placeholder="Spouse Business Address" value="<?php echo ($spouse_business_address); ?>" readonly style="pointer-events: none;">
          <input type="text" class="form-control" id="spouseTelephoneNo" name="spouseTelephoneNo" placeholder="Spouse Telephone Number" value="<?php echo ($spouse_telephone_no); ?>" readonly style="pointer-events: none;">
        </div>
      </div>

      <?php if (!empty($children_data)): ?>
        <?php foreach ($children_data as $key => $child): ?>
          <div class="row mb-1 px-1">
            <div class="col-md-6">
              <label for="childName<?php echo $key; ?>" class="form-label pt-2">Name of Child</label>
              <input type="text" class="form-control mb-1" id="childName<?php echo $key; ?>" name="childName<?php echo $key; ?>" value="<?php echo $child['child_name']; ?>" placeholder="Child's Full Name">
            </div>
            <div class="col-md-6">
              <label for="childDOB<?php echo $key; ?>" class="form-label pt-2">Date of Birth</label>
              <input type="date" class="form-control mb-1" id="childDOB<?php echo $key; ?>" name="childDOB<?php echo $key; ?>" value="<?php echo $child['child_dob']; ?>">
            </div>
          </div>
        <?php endforeach; ?>
      <?php else: ?>
        <div class="row mb-1 px-1">
          <div class="col-md-12">
            Employee has no children
          </div>
        </div>
      <?php endif; ?>

      <div class="row mb-1 px-1">
        <div class="col-md-6">
          <label for="fatherDetails" class="form-label pt-2">FATHER</label>
          <input type="text" class="form-control" id="fatherSurname" name="fatherSurname" placeholder="Father Surname">
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="fatherFirstName" name="fatherFirstName" placeholder="Father First Name">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="fatherNameExtension" name="fatherNameExtension" placeholder="Father Name Extension (Jr., Sr.)">
            </div>
          </div>
          <input type="text" class="form-control" id="fatherMiddleName" name="fatherMiddleName" placeholder="Father Middle Name">
        </div>

        <div class="col-md-6">
          <label for="motherDetails" class="form-label pt-2">MOTHER's MAIDEN NAME</label>
          <input type="text" class="form-control" id="motherMaidenSurname" name="motherMaidenSurname" placeholder="Mother Surname">
          <input type="text" class="form-control" id="motherFirstName" name="motherFirstName" placeholder="Mother First Name">
          <input type="text" class="form-control" id="motherMiddleName" name="motherMiddleName" placeholder="Mother Middle Name">
        </div>
      </div>
    </div>

    <button type="button" class="collapsible fw-bold fs-5 d-flex" id="btnform4" onclick="toggleForm('form4', ['form5', 'form3', 'form2', 'form1'])">
      <p class="fs-6 fw-bold">IV. Educational Background</p>
    </button>
    <div class="collapsible-content content-form content-container mt-2 mb-3" style="display: none;" id="form4">
      <div class="row mb-1 px-1">
        <div class="col-md-12">
          <label for="elementaryLevelDetails" class="form-label pt-3">ELEMENTARY LEVEL</label>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="elementarySchoolName" name="elementarySchoolName" placeholder="Elementary School Name (Write in full)">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="elementaryEducation" name="elementaryEducation" placeholder="Basic Education/Degree/Course (Write in full)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" id="elementaryPeriodOfAttendanceFrom" name="elementaryPeriodOfAttendanceFrom" placeholder="Period of Attendance From">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="elementaryPeriodOfAttendanceTo" name="elementaryPeriodOfAttendanceTo" placeholder="Period of Attendance To">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="elementaryYearGraduated" name="elementaryYearGraduated" placeholder="Year Graduated">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="elementaryHighestLevelEarned" name="elementaryHighestLevelEarned" placeholder="Highest Level/Units Earned (if not graduated)">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="elementaryScholarshipOrAcademicReceived" name="elementaryScholarshipOrAcademicReceived" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>

      <div class="row mb-1 px-1">
        <div class="col-md-12">
          <label for="secondaryLevelDetails" class="form-label pt-3">SECONDARY LEVEL</label>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="secondarySchoolName" name="secondarySchoolName" placeholder="Secondary School Name (Write in full)">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="secondaryEducation" name="secondaryEducation" placeholder="Basic Education/Degree/Course (Write in full)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" id="secondaryPeriodOfAttendanceFrom" name="secondaryPeriodOfAttendanceFrom" placeholder="Period of Attendance From">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="secondaryPeriodOfAttendanceTo" name="secondaryPeriodOfAttendanceTo" placeholder="Period of Attendance To">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="secondaryYearGraduated" name="secondaryYearGraduated" placeholder="Year Graduated">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="secondaryHighestLevelEarned" name="secondaryHighestLevelEarned" placeholder="Highest Level/Units Earned (if not graduated)">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="secondaryScholarshipOrAcademicReceived" name="secondaryScholarshipOrAcademicReceived" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>

      <div class="row mb-1 px-1">
        <div class="col-md-12">
          <label for="vocationalLevelDetails" class="form-label pt-3">VOCATIONAL/TRADE COURSE LEVEL</label>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="vocationalSchoolName" name="vocationalSchoolName" placeholder="Vocational School Name (Write in full)">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="vocationalEducation" name="vocationalEducation" placeholder="Basic Education/Degree/Course (Write in full)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" id="vocationalPeriodOfAttendanceFrom" name="vocationalPeriodOfAttendanceFrom" placeholder="Period of Attendance From">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="vocationalPeriodOfAttendanceTo" name="vocationalPeriodOfAttendanceTo" placeholder="Period of Attendance To">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="vocationalYearGraduated" name="vocationalYearGraduated" placeholder="Year Graduated">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="vocationalHighestLevelEarned" name="vocationalHighestLevelEarned" placeholder="Highest Level/Units Earned (if not graduated)">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="vocationalScholarshipOrAcademicReceived" name="vocationalScholarshipOrAcademicReceived" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>

      <div class="row mb-1 px-1">
        <div class="col-md-12">
          <label for="collegeLevelDetails" class="form-label pt-3">COLLEGE LEVEL</label>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="collegeSchoolName" name="collegeSchoolName" placeholder="College School Name (Write in full)">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="collegeEducation" name="collegeEducation" placeholder="Basic Education/Degree/Course (Write in full)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" id="collegePeriodOfAttendanceFrom" name="collegePeriodOfAttendanceFrom" placeholder="Period of Attendance From">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="collegePeriodOfAttendanceTo" name="collegePeriodOfAttendanceTo" placeholder="Period of Attendance To">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="collegeYearGraduated" name="collegeYearGraduated" placeholder="Year Graduated">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="collegeHighestLevelEarned" name="collegeHighestLevelEarned" placeholder="Highest Level/Units Earned (if not graduated)">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="collegeScholarshipOrAcademicReceived" name="collegeScholarshipOrAcademicReceived" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>

      <div class="row mb-1 px-1">
        <div class="col-md-12">
          <label for="graduateStudiesLevelDetails" class="form-label pt-3">GRADUATE STUDIES</label>
          <div class="form-group row">
            <div class="col-6">
              <input type="text" class="form-control" id="graduateStudiesSchoolName" name="graduateStudiesSchoolName" placeholder="Graduate Studies School Name (Write in full)">
            </div>
            <div class="col-6">
              <input type="text" class="form-control" id="graduateStudiesEducation" name="graduateStudiesEducation" placeholder="Basic Education/Degree/Course (Write in full)">
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <input type="number" class="form-control" id="graduateStudiesPeriodOfAttendanceFrom" name="graduateStudiesPeriodOfAttendanceFrom" placeholder="Period of Attendance From">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="graduateStudiesPeriodOfAttendanceTo" name="graduateStudiesPeriodOfAttendanceTo" placeholder="Period of Attendance To">
        </div>
        <div class="col-md-4">
          <input type="number" class="form-control" id="graduateStudiesYearGraduated" name="graduateStudiesYearGraduated" placeholder="Year Graduated">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="graduateStudiesHighestLevelEarned" name="graduateStudiesHighestLevelEarned" placeholder="Highest Level/Units Earned (if not graduated)">
        </div>
        <div class="col-md-6">
          <input type="text" class="form-control" id="graduateStudiesScholarshipOrAcademicReceived" name="graduateStudiesScholarshipOrAcademicReceived" placeholder="Scholarship/Academic Honors Received">
        </div>
      </div>
    </div>

    <button type="button" class="collapsible fw-bold fs-5 d-flex" id="btnform5" onclick="toggleForm('form5', ['form4', 'form3', 'form2', 'form1'])">
      <p class="fs-6 fw-bold">V. Leave Types Permission</p>
    </button>
    <div class="collapsible-content content-form content-container mt-2 mb-3" style="display: none;" id="form5">
      <div class="row mb-1 px-1">
        <div class="col-md-12 pt-3 pb-3">
          <div class="form-group">
            <div class="row">
              <?php
                $leave_types_query = $conn->query("SELECT lt.lt_id, lt.lt_name, IFNULL(elc.available_credits, lt.lt_credit) AS lt_credit FROM leave_type lt LEFT JOIN employee_leave_credits elc ON lt.lt_id = elc.lt_id AND elc.em_id = $em_id WHERE elc.em_id = $em_id");
                $total_leave_types = $leave_types_query->num_rows;
                $leave_types_per_column = ceil($total_leave_types / 2); 

                $counter = 0;
                $has_leave_credits = false;

                while ($leave_type = $leave_types_query->fetch_assoc()) {
                  if ($counter % $leave_types_per_column == 0) {
                    echo '<div class="col-md-12">';
                  }
                  echo '<div class="row">';
                  echo '<div class="col-md-12">';
                  echo '<div class="form-check my-1 col-md-6">';

                  // Check if lt_credit is empty or null
                  if (!isset($leave_type['lt_credit']) || $leave_type['lt_credit'] === null || $leave_type['lt_credit'] === '') {
                    echo '<li type="text" id="leave_type_' . $leave_type['lt_id'] . '" name="leave_type_ids[]" value="' . $leave_type['lt_id'] . '" class="leave-type-checkbox text-capitalize" read-only>' . $leave_type['lt_name'] . ' <span class="text-lowercase">(User has no available leave credits)</span></li>';
                  } else {
                    echo '<li type="text" id="leave_type_' . $leave_type['lt_id'] . '" name="leave_type_ids[]" value="' . $leave_type['lt_id'] . '" class="leave-type-checkbox text-capitalize" read-only>' . $leave_type['lt_name'] . ' <span class="text-lowercase">(' . $leave_type['lt_credit'] . ' Remaining Credits)</span></li>';
                    $has_leave_credits = true;
                  }

                  echo '</div>';
                  echo '</div>';
                  echo '</div>';
                  $counter++;

                  if ($counter % $leave_types_per_column == 0 || $counter == $total_leave_types) {
                    echo '</div>';
                  }
                }

                // Display message if no leave credits were found
                if (!$has_leave_credits) {
                  echo '<p>User has no available leave credits</p>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </section>
</main>

<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
<script src="./personalDataSheetToggle.js"></script>
<script>
  // Function to allow only one checkbox to be checked at a time
  function checkOnlyOne(checkbox) {
    var checkboxes = document.getElementsByName(checkbox.name);
    checkboxes.forEach((item) => {
      if (item !== checkbox) item.checked = false;
    });

    // If Dual Citizenship is unchecked, clear related fields
    if (checkbox.name === "citizenship" && !checkbox.checked && checkbox.value === "Dual Citizenship") {
      clearDualCitizenshipDetails();
    }
  }

  function clearDualCitizenshipDetails() {
    // Clear dual citizenship type checkboxes
    var dualCitizenshipTypes = document.getElementsByName('dual_citizenship_type');
    dualCitizenshipTypes.forEach((item) => {
      item.checked = false;
    });
    // Clear dual citizenship country select
    document.getElementById('dualCitizenshipCountrySelect').value = "";
    // Hide the fields and remove required attribute
    toggleDualCitizenship({checked: false});
  }

  function toggleDualCitizenship(checkbox) {
    var details = document.getElementById('dual-citizenship-details');
    var country = document.getElementById('dual-citizenship-country');
    if (checkbox.checked) {
      details.classList.remove('d-none');
      country.classList.remove('d-none');
      // Mark dual citizenship type and country as required
      document.getElementsByName('dual_citizenship_type')[0].setAttribute('required', 'required');
      document.getElementsByName('dual_citizenship_type')[1].setAttribute('required', 'required');
      document.getElementById('dualCitizenshipCountrySelect').setAttribute('required', 'required');
    } else {
      details.classList.add('d-none');
      country.classList.add('d-none');
      // Remove required attribute
      document.getElementsByName('dual_citizenship_type')[0].removeAttribute('required');
      document.getElementsByName('dual_citizenship_type')[1].removeAttribute('required');
      document.getElementById('dualCitizenshipCountrySelect').removeAttribute('required');
    }
  }

  let childCount = 1; // Initial count of children
  function addChildField() {
    childCount++; // Increment the child count

    // Create a new input field for the child's name
    const newChildNameField = document.createElement('input');
    newChildNameField.type = 'text';
    newChildNameField.className = 'form-control mb-1';
    newChildNameField.id = `childName${childCount}`;
    newChildNameField.name = `childName${childCount}`;
    newChildNameField.placeholder = "Child's Full Name";

    // Create a new input field for the child's date of birth
    const newChildDOBField = document.createElement('input');
    newChildDOBField.type = 'date';
    newChildDOBField.className = 'form-control mb-1';
    newChildDOBField.id = `childDOB${childCount}`;
    newChildDOBField.name = `childDOB${childCount}`;

    // Append the new fields to the respective containers
    document.getElementById('childrenNamesContainer').appendChild(newChildNameField);
    document.getElementById('childrenDOBContainer').appendChild(newChildDOBField);
  }

  document.addEventListener("DOMContentLoaded", function() {
    var dualCitizenshipCountrySelect = document.getElementById("dualCitizenshipCountrySelect");

    fetch('https://restcountries.com/v3.1/all')
      .then(response => response.json())
      .then(data => {
        data.forEach(country => {
          var option = document.createElement("option");
          option.value = country.cca2;
          option.text = country.name.common;
          dualCitizenshipCountrySelect.appendChild(option);
        });
      })
      .catch(error => console.error('Error fetching country data:', error));
  });
  
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