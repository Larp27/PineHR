<?php
  session_start();
  include "DBConnection.php";

  if (isset($_GET['em_id'])) {
    $em_id = intval($_GET['em_id']);
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
      $residential_subdivision_village = check_empty($row['residential_subdivision_village'], 'Subdivision');
      $residential_barangay = check_empty($row['residential_barangay'], 'Residential Barangay');
      $residential_city_municipality = check_empty($row['residential_city_municipality'], 'Residential City/Municipality');
      $residential_province = check_empty($row['residential_province'], 'Residential Province');
      $residential_zip_code = check_empty($row['residential_zip_code'], 'Residential Zip Code');
      $permanent_house_block_lot_no = check_empty($row['permanent_house_block_lot_no'], 'Permanent House/Block/Lot No');
      $permanent_street = check_empty($row['permanent_street'], 'Permanent Street');
      $permanent_subdivision_village = check_empty($row['permanent_subdivision_village'], 'Subdivision');
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
      $elementary_school_name = check_empty($row['elementary_school_name'], '');
      $elementary_education = check_empty($row['elementary_education'], '');
      $elementary_period_of_attendance_from = check_empty($row['elementary_period_of_attendance_from'], '');
      $elementary_period_of_attendance_to = check_empty($row['elementary_period_of_attendance_to'], '');
      $elementary_year_graduated = check_empty($row['elementary_year_graduated'], '');
      $elementary_highest_level_earned = check_empty($row['elementary_highest_level_earned'], '');
      $elementary_scholarship_or_academic_received = check_empty($row['elementary_scholarship_or_academic_received'], '');

      $secondary_school_name = check_empty($row['secondary_school_name'], '');
      $secondary_education = check_empty($row['secondary_education'], '');
      $secondary_period_of_attendance_from = check_empty($row['secondary_period_of_attendance_from'], '');
      $secondary_period_of_attendance_to = check_empty($row['secondary_period_of_attendance_to'], '');
      $secondary_year_graduated = check_empty($row['secondary_year_graduated'], '');
      $secondary_highest_level_earned = check_empty($row['secondary_highest_level_earned'], '');
      $secondary_scholarship_or_academic_received = check_empty($row['secondary_scholarship_or_academic_received'], '');

      $vocational_school_name = check_empty($row['vocational_school_name'], '');
      $vocational_education = check_empty($row['vocational_education'], '');
      $vocational_period_of_attendance_from = check_empty($row['vocational_period_of_attendance_from'], '');
      $vocational_period_of_attendance_to = check_empty($row['vocational_period_of_attendance_to'], '');
      $vocational_year_graduated = check_empty($row['vocational_year_graduated'], '');
      $vocational_highest_level_earned = check_empty($row['vocational_highest_level_earned'], '');
      $vocational_scholarship_or_academic_received = check_empty($row['vocational_scholarship_or_academic_received'], '');

      $college_school_name = check_empty($row['college_school_name'], '');
      $college_education = check_empty($row['college_education'], '');
      $college_period_of_attendance_from = check_empty($row['college_period_of_attendance_from'], '');
      $college_period_of_attendance_to = check_empty($row['college_period_of_attendance_to'], '');
      $college_year_graduated = check_empty($row['college_year_graduated'], '');
      $college_highest_level_earned = check_empty($row['college_highest_level_earned'], '');
      $college_scholarship_or_academic_received = check_empty($row['college_scholarship_or_academic_received'], '');

      $graduate_studies_school_name = check_empty($row['graduate_studies_school_name'], '');
      $graduate_studies_education = check_empty($row['graduate_studies_education'], '');
      $graduate_studies_period_of_attendance_from = check_empty($row['graduate_studies_period_of_attendance_from'], '');
      $graduate_studies_period_of_attendance_to = check_empty($row['graduate_studies_period_of_attendance_to'], '');
      $graduate_studies_year_graduated = check_empty($row['graduate_studies_year_graduated'], '');
      $graduate_studies_highest_level_earned = check_empty($row['graduate_studies_highest_level_earned'], '');
      $graduate_studies_scholarship_or_academic_received = check_empty($row['graduate_studies_scholarship_or_academic_received'], '');

    } else {
      die("No employee found with ID $em_id");
    }
  } else {
    die("Invalid employee ID.");
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Personal Data Sheet</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
  <link rel="stylesheet" href="dashboard2.css" />
  <link rel="stylesheet" href="css/all.min.css">
  <link rel="stylesheet" href="css/fontawesome.min.css">
  <style>
    @media print {
      @page {
        size: legal;
        margin: 0;
      }
      body {
        margin: 0;
        padding: 0;
      }
    }
    * {
      -webkit-print-color-adjust: exact !important;
      print-color-adjust: exact !important;
      color-adjust: exact !important;
    }
    table {
      width: 100%;
      border-collapse: collapse;
    }
    tbody {
      font-size: 12px;
      padding: 0px;
    }
    th, td {
      border: 1px solid #000;
      padding: 2px;
      text-align: left;
      vertical-align: top;
    }
    .label-cell {
      width: 20%;
      text-align: left;
      padding-left: 10px;
      vertical-align: middle;
    }
    .input-cell {
      width: 40%;
      padding-left: 10px;
      vertical-align: middle;
      text-align: center;
    }
    .extension-cell {
      width: 40%;
      text-align: left;
      padding-left: 10px;
    }
    .section-header {
      background-color: #dee2e6;
      font-weight: bold;
      text-align: left;
      padding: 4px;
    }
    .checkbox-group {
      display: flex;
      align-items: center;
      justify-content: start;
      gap: 10px;
    }
    .checkbox-group .form-check {
      display: inline-block;
    }
  </style>
</head>
<body>
  <div class="container my-4">
    <table>
      <thead>
        <tr>
          <th colspan="3" class="section-header">I. PERSONAL INFORMATION</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td rowspan="3" class="label-cell">SURNAME<br><br>FIRST NAME<br><br>MIDDLE NAME</td>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $last_name; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="input-cell" style="border-right: none;"><?php echo $first_name; ?></td>
          <td class="extension-cell" style="border-left: none; background-color: #dee2e6;">NAME EXTENSION (JR., SR.):
            <span class="px-1"><?php echo $name_extension; ?></span>
          </td>
        </tr>
        <tr>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $middle_name; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="label-cell">DATE OF BIRTH (mm/dd/yyyy)</td>
          <td class="input-cell"><?php echo date("F j, Y", strtotime($date_of_birth)); ?></td>
          <td rowspan="3" class="extension-cell" style="text-align: left; vertical-align: top;">CITIZENSHIP<br>
            <div class="checkbox-group">
              <label class="form-check"><input type="checkbox" name="citizenship" value="Filipino" class="readonly-checkbox" <?php if ($citizenship == 'Filipino') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Filipino</label>
              <label class="form-check"><input type="checkbox" name="citizenship" value="Dual Citizenship" class="readonly-checkbox" <?php if ($citizenship == 'Dual Citizenship') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Dual Citizenship</label>
            </div>

            <p class="pt-1">If holder of dual citizenship, please indicate the details.</p>
            <div class="checkbox-group">
              <label class="form-check"><input type="checkbox" name="dual_citizenship" value="birth" <?php if ($dual_citizenship_type == 'by birth') echo 'checked'; ?> disabled style="pointer-events: none !important;"> by birth</label>
              <label class="form-check"><input type="checkbox" name="dual_citizenship" value="naturalization"  <?php if ($dual_citizenship_type == 'by birth') echo 'checked'; ?> disabled style="pointer-events: none !important;"> by naturalization</label>
            </div>
            <div class="pt-1">Please indicate country:<br><p class="px-1 pt-1"><?php echo $dual_citizenship_country; ?></p></div>
          </td>
        </tr>
        <tr>
          <td class="label-cell">PLACE OF BIRTH</td>
          <td class="input-cell text-center"><?php echo $place_of_birth; ?></td>
        </tr>
        <tr>
          <td class="label-cell">SEX</td>
          <td class="input-cell">
            <div class="checkbox-group">
              <label class="form-check"><input type="checkbox" name="sex" value="male" <?php if ($sex == 'Male') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Male</label>
              <label class="form-check"><input type="checkbox" name="sex" value="female" <?php if ($sex == 'Female') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Female</label>
            </div>
          </td>
        </tr>
        <tr>
          <td class="label-cell">CIVIL STATUS</td>
          <td class="input-cell">
            <div class="checkbox-group" style="display: flex; flex-wrap: wrap; gap: 20px;">
              <label class="form-check"><input type="checkbox" name="civil_status" value="single" <?php if ($civil_status == 'Single') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Single</label>

              <label class="form-check"><input type="checkbox" name="civil_status" value="married" <?php if ($civil_status == 'Married') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Married</label>
              <br style="flex-basis: 100%; height: 0; margin: 0;"> 
              <label class="form-check"><input type="checkbox" name="civil_status" value="widowed" <?php if ($civil_status == 'Widowed') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Widowed</label>
              <label class="form-check"><input type="checkbox" name="civil_status" value="separated" <?php if ($civil_status == 'Separated') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Separated</label>
              <label class="form-check"><input type="checkbox" name="civil_status" value="other" <?php if ($civil_status == 'Other/s') echo 'checked'; ?> disabled style="pointer-events: none !important;"> Other/s</label>
            </div>
          </td>

          <td rowspan="3" class="extension-cell" style="text-align: left; vertical-align: top;">RESIDENTIAL ADDRESS<br>
            <table>
              <tr class="my-1 pb-2">
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width: 100%" type="text" name="house_no" readonly style="pointer-events: none !important;" value="<?php echo $residential_house_block_lot_no; ?>"><br>House/Block/Lot No.</td>
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="street" readonly style="pointer-events: none !important;" value="<?php echo $residential_street; ?>"><br>Street</td>
              </tr>
              <tr class="my-1 pb-2">
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="subdivision" readonly style="pointer-events: none !important;" value="<?php echo $residential_subdivision_village; ?>"><br>Subdivision/Village</td>
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="barangay" readonly style="pointer-events: none !important;" value="<?php echo $residential_barangay; ?>"><br>Barangay</td>
              </tr>
              <tr class="my-1 pb-3 mb-2">
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="city" readonly style="pointer-events: none !important;" value="<?php echo $residential_city_municipality; ?>"><br>City/Municipality</td>
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="province" readonly style="pointer-events: none !important;" value="<?php echo $residential_province; ?>"><br>Province</td>
              </tr>
            
              <td class="pt-1" style="border: none; padding: 0px !important; margin: 0px !important;" class="extension-cell">ZIP CODE
                <p class="px-2 mx-2"><?php echo $residential_zip_code; ?></p>
              </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="label-cell">HEIGHT (m)</td>
          <td class="input-cell"><?php echo $height; ?></td>
        </tr>
        <tr>
          <td class="label-cell">WEIGHT (kg)</td>
          <td class="input-cell"><?php echo $weight; ?></td>
        </tr>
        <tr>
          <td class="label-cell">BLOOD TYPE</td>
          <td class="input-cell"><?php echo $blood_type; ?></td>

          <td rowspan="4" class="extension-cell" style="text-align: left; vertical-align: top;">PERMANENT ADDRESS<br>
            <table>
              <tr class="my-1 pb-2">
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width: 100%" type="text" name="house_no" readonly style="pointer-events: none !important;" value="<?php echo $permanent_house_block_lot_no; ?>"><br>House/Block/Lot No.</td>
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="street" readonly style="pointer-events: none !important;" value="<?php echo $permanent_street; ?>"><br>Street</td>
              </tr>
              <tr class="my-1 pb-2">
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="subdivision" readonly style="pointer-events: none !important;" value="<?php echo $permanent_subdivision_village; ?>"><br>Subdivision/Village</td>
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="barangay" readonly style="pointer-events: none !important;" value="<?php echo $permanent_barangay; ?>"><br>Barangay</td>
              </tr>
              <tr class="my-1 pb-3 mb-2">
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="city" readonly style="pointer-events: none !important;" value="<?php echo $permanent_city_municipality; ?>"><br>City/Municipality</td>
                <td style="border: none;" class="text-center"><input class="text-center" style="border: none; border-bottom: 1px solid black; width:100%" type="text" name="province" readonly style="pointer-events: none !important;" value="<?php echo $permanent_province; ?>"><br>Province</td>
              </tr>
            
              <td class="pt-1" style="border: none; padding: 0px !important; margin: 0px !important;" class="extension-cell">ZIP CODE
                <p class="px-2 mx-2"><?php echo $permanent_zip_code; ?></p>
              </td>
              </tr>
            </table>
          </td>
        </tr>
        <tr>
          <td class="label-cell">GSIS ID NO.</td>
          <td class="input-cell"><?php echo $gsis_id_no; ?></td>
        </tr>
        <tr>
          <td class="label-cell">PAG-IBIG ID NO.</td>
          <td class="input-cell"><?php echo $pagibig_id_no; ?></td>
        </tr>
        <tr>
          <td class="label-cell">PHILHEALTH NO.</td>
          <td class="input-cell"><?php echo $philhealth_no; ?></td>
        </tr>
        <tr></tr>
        <table>
          <tr>
            <td class="label-cell" style="border-right: none; width: 10% !important;">SSS NO.</td>
            <td class="input-cell"><?php echo $sss_no; ?></td>
            <td class="label-cell">TELEPHONE NO.</td>
            <td class="input-cell"><?php echo $telephone_no; ?></td>
          </tr>
          <tr>
            <td class="label-cell" style="border-right: none; width: 10% !important;">TIN NO.</td>
            <td class="input-cell"><?php echo $tin_no; ?></td>
            <td class="label-cell">MOBILE NO.</td>
            <td class="input-cell"><?php echo $mobile_no; ?></td>
          </tr>
          <tr>
            <td class="label-cell" style="border-right: none; width: 10% !important;">AGENCY EMPLOYEE NO.</td>
            <td class="input-cell"><?php echo $agency_employee_no; ?></td>
            <td class="label-cell">EMAIL ADDRESS (if any)</td>
            <td class="input-cell"><?php echo $email_address; ?></td>
          </tr>
        </table>
      </tbody>
    </table>

    <table>
      <thead>
        <tr>
          <th colspan="3" class="section-header">II. FAMILY BACKGROUND</th>
        </tr>
      </thead>
      <tbody style="padding:0px !important;">
        <tr>
          <td rowspan="3" class="label-cell">SPOUSE SURNAME<br><br>SPOUSE FIRST NAME<br><br>SPOUSE MIDDLE NAME</td>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $spouse_surname; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="input-cell" style="border-right: none;"><?php echo $spouse_first_name; ?></td>
          <td class="extension-cell" style="border-left: none; background-color: #dee2e6;">SPOUSE NAME EXTENSION (JR., SR.):
            <span class="px-1"><?php echo $spouse_name_extension; ?></span>
          </td>
        </tr>
        <tr>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $spouse_middle_name; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td rowspan="3" class="label-cell">FATHER SURNAME<br><br>FATHER FIRST NAME<br><br>FATHER MIDDLE NAME</td>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $father_surname; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="input-cell" style="border-right: none;"><?php echo $father_first_name; ?></td>
          <td class="extension-cell" style="border-left: none; background-color: #dee2e6;">FATHER NAME EXTENSION (JR., SR.):
            <span class="px-1"><?php echo $father_name_extension; ?></span>
          </td>
        </tr>
        <tr>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $father_middle_name; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td rowspan="3" class="label-cell">MOTHER MAIDEN's SURNAME<br><br>MOTHER FIRST NAME<br><br>MOTHER MIDDLE NAME</td>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $mother_maiden_surname; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="input-cell" style="border-right: none;"><?php echo $mother_first_name; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="input-cell py-1" style="border-right: none;"><?php echo $mother_middle_name; ?></td>
          <td class="extension-cell" style="border-left: none;"></td>
        </tr>
        <tr>
          <td class="label-cell" style="border-right: none; width: 10% !important;">NAME OF CHILDREN</td>
          <td style="border: none; border-bottom: 1px solid black; border-right: 1px solid black; width: 10% !important;"></td>
          <td class="label-cell" style="border-left: none; width: 10% !important;">DATE OF BIRTH (mm/dd/yyyy)</td>
          <td style="border: none; width: 10% !important;"></td>
        </tr>
        <tr>
          <td class="label-cell py-3" style="border-right: none; width: 10% !important;"></td>
          <td style="border: none; border-bottom: 1px solid black; border-right: 1px solid black; width: 10% !important;"></td>
          <td class="label-cell" style="border-left: none; width: 10% !important;"></td>
          <td style="border: none; width: 10% !important;"></td>
        </tr>
      </tbody>
    </table>
    
    <table>
      <thead>
        <tr>
          <th colspan="7" class="section-header">III. EDUCATIONAL BACKGROUND</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td class="text-center" style="border-right: none; width: 10% !important;">LEVEL</td>
          <td class="text-center" style="border-right: none; width: 10% !important;">NAME OF SCHOOL</td>
          <td class="text-center" style="border-right: none; width: 10% !important;">BASIC EDUCATION/DEGREE/COURSE</td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;">PERIOD OF ATTENDANCE
            <div class="row px-0 mx-0" style="padding: 0px !important; border-top: 1px solid black;">
              <div class="col-6 px-1" style="border-right: 1px solid black;">FROM  </div>
              <div class="col-6">TO </div>
            </div>
          </td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;">HIGHEST LEVEL / UNITS EARNED</td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;">YEAR GRADUATED</td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;">SCHOLARSHIP / ACADEMIC HONORS RECEIVED</td>
        </tr>
        <tr>
          <td class="text-center" style="border-right: none; width: 10% !important;">Elementary</td>
          <td class="text-center" style="border-right: none; width: 10% !important;"><?php echo $elementary_school_name; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $elementary_education; ?></td>
          <td class="text-center" style="border-right: none; width: 10% !important;">
            <div class="row px-0 mx-0" style="padding: 0px !important;">
              <div class="col-6" style="border-right: 1px solid black;"><?php echo $elementary_period_of_attendance_from; ?></div>
              <div class="col-6"><?php echo $elementary_period_of_attendance_to; ?></div>
            </div>
          </td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $elementary_highest_level_earned; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $elementary_year_graduated; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $elementary_scholarship_or_academic_received; ?></td>
        </tr>
        <tr>
          <td class="text-center" style="border-right: none; width: 10% !important;">Secondary</td>
          <td class="text-center" style="border-right: none; width: 10% !important;"><?php echo $secondary_school_name; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $secondary_education; ?></td>
          <td class="text-center" style="border-right: none; width: 10% !important;">
            <div class="row px-0 mx-0" style="padding: 0px !important;">
              <div class="col-6" style="border-right: 1px solid black;"><?php echo $secondary_period_of_attendance_from; ?></div>
              <div class="col-6"><?php echo $secondary_period_of_attendance_to; ?></div>
            </div>
          </td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $secondary_highest_level_earned; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $secondary_year_graduated; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $secondary_scholarship_or_academic_received; ?></td>
        </tr>

        <tr>
          <td class="text-center" style="border-right: none; width: 10% !important;">Vocational</td>
          <td class="text-center" style="border-right: none; width: 10% !important;"><?php echo $vocational_school_name; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $vocational_education; ?></td>
          <td class="text-center" style="border-right: none; width: 10% !important;">
            <div class="row px-0 mx-0" style="padding: 0px !important;">
              <div class="col-6" style="border-right: 1px solid black;"><?php echo $vocational_period_of_attendance_from; ?></div>
              <div class="col-6"><?php echo $vocational_period_of_attendance_to; ?></div>
            </div>
          </td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $vocational_highest_level_earned; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $vocational_year_graduated; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $vocational_scholarship_or_academic_received; ?></td>
        </tr>

        <tr>
          <td class="text-center" style="border-right: none; width: 10% !important;">College</td>
          <td class="text-center" style="border-right: none; width: 10% !important;"><?php echo $college_school_name; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $college_education; ?></td>
          <td class="text-center" style="border-right: none; width: 10% !important;">
            <div class="row px-0 mx-0" style="padding: 0px !important;">
              <div class="col-6" style="border-right: 1px solid black;"><?php echo $college_period_of_attendance_from; ?></div>
              <div class="col-6"><?php echo $college_period_of_attendance_to; ?></div>
            </div>
          </td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $college_highest_level_earned; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $college_year_graduated; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $college_scholarship_or_academic_received; ?></td>
        </tr>

        <tr>
          <td class="text-center" style="border-right: none; width: 10% !important;">Graduate Studies</td>
          <td class="text-center" style="border-right: none; width: 10% !important;"><?php echo $graduate_studies_school_name; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $graduate_studies_education; ?></td>
          <td class="text-center" style="border-right: none; width: 10% !important;">
            <div class="row px-0 mx-0" style="padding: 0px !important;">
              <div class="col-6" style="border-right: 1px solid black;"><?php echo $graduate_studies_period_of_attendance_from; ?></div>
              <div class="col-6"><?php echo $graduate_studies_period_of_attendance_to; ?></div>
            </div>
          </td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $graduate_studies_highest_level_earned; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $graduate_studies_year_graduated; ?></td>
          <td class="text-center" style="border-right: 1px solid black; width: 10% !important;"><?php echo $graduate_studies_scholarship_or_academic_received; ?></td>
        </tr>

      </tbody>
    </table>
  </div>
</body>
</html>
<script>
  window.print();
  // Close the new tab when the print dialog is closed or canceled
  window.onafterprint = function() {
    window.close();
  };
  window.onbeforeunload = function() {
    window.close();
  };
</script>