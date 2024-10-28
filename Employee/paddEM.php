<?php
session_start();
include "../DBConnection.php";

function insertRecord(){
  global $conn;

  // Check if em_income is set, otherwise set it to an empty string and check if em_income is set and is a valid numeric value
  $em_income = isset($_POST['em_income']) ? $_POST['em_income'] : '';
  if (!is_numeric($em_income)) {
    echo "Invalid em_income value.";
    return;
  }

  // Start transaction
  mysqli_autocommit($conn, false);
  $success = true;

  // EMPLOYMENT DETAILS & SYSTEM CREDENTIALS
  $dep_id = $_POST['dep_id'];
  $des_id = $_POST['des_id'];
  $es_id = $_POST['es_id'];
  $em_joining_date = $_POST['em_joining_date'];
  $em_contract_end = $_POST['em_contract_end'];
  $em_income = $_POST['em_income'];
  $employee_status = $_POST['employee_status'];
  $user_id = $_POST['user_id'];
  $em_password = $_POST['em_password'];

  // LEAVE TYPES
  $leave_type_ids = $_POST['leave_type_ids'];
  $leave_credits = $_POST['leave_credits'];

  $targetDirectory = "../uploads/";
  $em_profile_pic = '';

  if(isset($_FILES['em_profile_pic'])){
    $fileName = $_FILES['em_profile_pic']['name'];
    $fileExt = pathinfo($fileName, PATHINFO_EXTENSION);
    $fileNameWithoutExt = pathinfo($fileName, PATHINFO_FILENAME);
    $uniqueID = uniqid();
    $newFileName = $fileNameWithoutExt . '_' . $uniqueID . '.' . $fileExt;
    $targetFilePath = $targetDirectory . $newFileName;

    // Define allowed file types
    $allowedTypes = array('jpg', 'png', 'jpeg', 'gif');

    if (in_array(strtolower($fileExt), $allowedTypes)){
      if (move_uploaded_file($_FILES['em_profile_pic']['tmp_name'], $targetFilePath)){
        $em_profile_pic = $targetFilePath;
      } else {
        echo "Error uploading file.";
        return;
      }
    } else {
      echo "File type not allowed.";
      return;
    }
  } else {
    echo "No file uploaded.";
    return;
  }

  // PERSONAL INFORMATION
  $last_name = $_POST['last_name'];
  $first_name = $_POST['first_name'];
  $name_extension = $_POST['name_extension'];
  $middle_name = $_POST['middle_name'];
  $date_of_birth = $_POST['date_of_birth'];
  $place_of_birth = $_POST['place_of_birth'];
  $sex = $_POST['sex'];
  $civil_status = $_POST['civil_status'];
  $citizenship = $_POST['citizenship'];
  $dual_citizenship_type = $_POST['dual_citizenship_type'];
  $dual_citizenship_country = $_POST['dual_citizenship_country'];
  $height = $_POST['height'];
  $weight = $_POST['weight'];
  $blood_type = $_POST['blood_type'];
  $gsis_id_no = $_POST['gsis_id_no'];
  $pagibig_id_no = $_POST['pagibig_id_no'];
  $philhealth_no = $_POST['philhealth_no'];
  $sss_no = $_POST['sss_no'];
  $tin_no = $_POST['tin_no'];
  $agency_employee_no = $_POST['agency_employee_no'];
  $telephone_no = $_POST['telephone_no'];
  $mobile_no = '+63' . $_POST['mobile_no'];
  $email_address = $_POST['email_address'];
  $residential_house_block_lot_no = $_POST['residential_house_block_lot_no'];
  $residential_street = $_POST['residential_street'];
  $residential_subdivision_village = $_POST['residential_subdivision_village'];
  $residential_barangay = $_POST['residential_barangay'];
  $residential_city_municipality = $_POST['residential_city_municipality'];
  $residential_province = $_POST['residential_province'];
  $residential_zip_code = $_POST['residential_zip_code'];
  $permanent_house_block_lot_no = $_POST['permanent_house_block_lot_no'];
  $permanent_street = $_POST['permanent_street'];
  $permanent_subdivision_village = $_POST['permanent_subdivision_village'];
  $permanent_barangay = $_POST['permanent_barangay'];
  $permanent_city_municipality = $_POST['permanent_city_municipality'];
  $permanent_province = $_POST['permanent_province'];
  $permanent_zip_code = $_POST['permanent_zip_code'];

  // FAMILY BACKGROUND
  $spouse_surname = $_POST['spouse_surname'];
  $spouse_first_name = $_POST['spouse_first_name'];
  $spouse_name_extension = $_POST['spouse_name_extension'];
  $spouse_middle_name = $_POST['spouse_middle_name'];
  $spouse_occupation = $_POST['spouse_occupation'];
  $spouse_employer_name = $_POST['spouse_employer_name'];
  $spouse_business_address = $_POST['spouse_business_address'];
  $spouse_telephone_no = $_POST['spouse_telephone_no'];

  $father_surname = $_POST['father_surname'];
  $father_first_name = $_POST['father_first_name'];
  $father_name_extension = $_POST['father_name_extension'];
  $father_middle_name = $_POST['father_middle_name'];

  $mother_maiden_surname = $_POST['mother_maiden_surname'];
  $mother_first_name = $_POST['mother_first_name'];
  $mother_middle_name = $_POST['mother_middle_name'];

  // EDUCATIONAL BACKGROUND
  $elementary_school_name = $_POST['elementary_school_name'];
  $elementary_education = $_POST['elementary_education'];
  $elementary_period_of_attendance_from = $_POST['elementary_period_of_attendance_from'];
  $elementary_period_of_attendance_to = $_POST['elementary_period_of_attendance_to'];
  $elementary_year_graduated = $_POST['elementary_year_graduated'];
  $elementary_highest_level_earned = $_POST['elementary_highest_level_earned'];
  $elementary_scholarship_or_academic_received = $_POST['elementary_scholarship_or_academic_received'];

  $secondary_school_name = $_POST['secondary_school_name'];
  $secondary_education = $_POST['secondary_education'];
  $secondary_period_of_attendance_from = $_POST['secondary_period_of_attendance_from'];
  $secondary_period_of_attendance_to = $_POST['secondary_period_of_attendance_to'];
  $secondary_year_graduated = $_POST['secondary_year_graduated'];
  $secondary_highest_level_earned = $_POST['secondary_highest_level_earned'];
  $secondary_scholarship_or_academic_received = $_POST['secondary_scholarship_or_academic_received'];

  $vocational_school_name = $_POST['vocational_school_name'];
  $vocational_education = $_POST['vocational_education'];
  $vocational_period_of_attendance_from = $_POST['vocational_period_of_attendance_from'];
  $vocational_period_of_attendance_to = $_POST['vocational_period_of_attendance_to'];
  $vocational_year_graduated = $_POST['vocational_year_graduated'];
  $vocational_highest_level_earned = $_POST['vocational_highest_level_earned'];
  $vocational_scholarship_or_academic_received = $_POST['vocational_scholarship_or_academic_received'];

  $college_school_name = $_POST['college_school_name'];
  $college_education = $_POST['college_education'];
  $college_period_of_attendance_from = $_POST['college_period_of_attendance_from'];
  $college_period_of_attendance_to = $_POST['college_period_of_attendance_to'];
  $college_year_graduated = $_POST['college_year_graduated'];
  $college_highest_level_earned = $_POST['college_highest_level_earned'];
  $college_scholarship_or_academic_received = $_POST['college_scholarship_or_academic_received'];

  $graduate_studies_school_name = $_POST['graduate_studies_school_name'];
  $graduate_studies_education = $_POST['graduate_studies_education'];
  $graduate_studies_period_of_attendance_from = $_POST['graduate_studies_period_of_attendance_from'];
  $graduate_studies_period_of_attendance_to = $_POST['graduate_studies_period_of_attendance_to'];
  $graduate_studies_year_graduated = $_POST['graduate_studies_year_graduated'];
  $graduate_studies_highest_level_earned = $_POST['graduate_studies_highest_level_earned'];
  $graduate_studies_scholarship_or_academic_received = $_POST['graduate_studies_scholarship_or_academic_received'];

  $employeeQuery = "INSERT INTO employee (dep_id, des_id, es_id, em_joining_date, em_contract_end, em_income, employee_status, user_id, em_password, em_profile_pic, last_name, first_name, name_extension, middle_name, date_of_birth, place_of_birth, sex, civil_status, citizenship, dual_citizenship_type, dual_citizenship_country, height, weight, blood_type, gsis_id_no, pagibig_id_no, philhealth_no, sss_no, tin_no, agency_employee_no, telephone_no, mobile_no, em_email, residential_house_block_lot_no, residential_street, residential_subdivision_village, residential_barangay, residential_city_municipality, residential_province, residential_zip_code, permanent_house_block_lot_no, permanent_street, permanent_subdivision_village, permanent_barangay, permanent_city_municipality, permanent_province, permanent_zip_code)
  VALUES ('$dep_id', '$des_id', '$es_id', '$em_joining_date', '$em_contract_end', '$em_income', '$employee_status', '$user_id', '$em_password', '$em_profile_pic', '$last_name', '$first_name', '$name_extension', '$middle_name', '$date_of_birth', '$place_of_birth', '$sex', '$civil_status', '$citizenship', '$dual_citizenship_type', '$dual_citizenship_country', '$height', '$weight', '$blood_type', '$gsis_id_no', '$pagibig_id_no', '$philhealth_no', '$sss_no', '$tin_no', '$agency_employee_no', '$telephone_no', '$mobile_no', '$email_address', '$residential_house_block_lot_no', '$residential_street', '$residential_subdivision_village', '$residential_barangay', '$residential_city_municipality', '$residential_province', '$residential_zip_code', '$permanent_house_block_lot_no', '$permanent_street', '$permanent_subdivision_village', '$permanent_barangay', '$permanent_city_municipality', '$permanent_province', '$permanent_zip_code')";

  if(mysqli_query($conn, $employeeQuery)){
    // Get the last inserted employee ID
    $em_id = mysqli_insert_id($conn);

    // Insert into employee_family_background table
    $employeeFamilyBackgroundQuery = "INSERT INTO employee_family_background (employee_id, spouse_surname, spouse_first_name, spouse_name_extension, spouse_middle_name, spouse_occupation, spouse_employer_name, spouse_business_address, spouse_telephone_no, father_surname, father_first_name, father_name_extension, father_middle_name, mother_maiden_surname, mother_first_name, mother_middle_name) 
    VALUES ('$em_id', '$spouse_surname', '$spouse_first_name', '$spouse_name_extension', '$spouse_middle_name', '$spouse_occupation', '$spouse_employer_name', '$spouse_business_address', '$spouse_telephone_no', '$father_surname', '$father_first_name', '$father_name_extension', '$father_middle_name', '$mother_maiden_surname', '$mother_first_name', '$mother_middle_name')";

    if(!mysqli_query($conn, $employeeFamilyBackgroundQuery)){
      $success = false;
    }

    // Get the last inserted family background ID
    $family_background_id = mysqli_insert_id($conn);

    // Insert into employee_children table
    foreach ($_POST['children'] as $child) {
      $child_name = $child['name'];
      $child_date_of_birth = $child['date_of_birth'];
    
      // Assuming $family_background_id and $em_id are defined elsewhere
      $employeeChildrenQuery = "INSERT INTO employee_children (employee_family_background_id, employee_id, child_name, child_date_of_birth) 
      VALUES ('$family_background_id', '$em_id', '$child_name', '$child_date_of_birth')";
    
      if (!mysqli_query($conn, $employeeChildrenQuery)) {
        $success = false;
      }
    }

    // Insert into employee_educational_background table
    $employeeEducationalBackgroundQuery = "INSERT INTO employee_educational_background (employee_id, elementary_school_name, elementary_education, elementary_period_of_attendance_from, elementary_period_of_attendance_to, elementary_year_graduated, elementary_highest_level_earned, elementary_scholarship_or_academic_received, secondary_school_name, secondary_education, secondary_period_of_attendance_from, secondary_period_of_attendance_to, secondary_year_graduated, secondary_highest_level_earned, secondary_scholarship_or_academic_received, vocational_school_name, vocational_education, vocational_period_of_attendance_from, vocational_period_of_attendance_to, vocational_year_graduated, vocational_highest_level_earned, vocational_scholarship_or_academic_received, college_school_name, college_education, college_period_of_attendance_from, college_period_of_attendance_to, college_year_graduated, college_highest_level_earned, college_scholarship_or_academic_received, graduate_studies_school_name, graduate_studies_education, graduate_studies_period_of_attendance_from, graduate_studies_period_of_attendance_to, graduate_studies_year_graduated, graduate_studies_highest_level_earned, graduate_studies_scholarship_or_academic_received) 
    VALUES ('$em_id', '$elementary_school_name', '$elementary_education', '$elementary_period_of_attendance_from', '$elementary_period_of_attendance_to', '$elementary_year_graduated', '$elementary_highest_level_earned', '$elementary_scholarship_or_academic_received', '$secondary_school_name', '$secondary_education', '$secondary_period_of_attendance_from', '$secondary_period_of_attendance_to', '$secondary_year_graduated', '$secondary_highest_level_earned', '$secondary_scholarship_or_academic_received', '$vocational_school_name', '$vocational_education', '$vocational_period_of_attendance_from', '$vocational_period_of_attendance_to', '$vocational_year_graduated', '$vocational_highest_level_earned', '$vocational_scholarship_or_academic_received', '$college_school_name', '$college_education', '$college_period_of_attendance_from', '$college_period_of_attendance_to', '$college_year_graduated', '$college_highest_level_earned', '$college_scholarship_or_academic_received', '$graduate_studies_school_name', '$graduate_studies_education', '$graduate_studies_period_of_attendance_from', '$graduate_studies_period_of_attendance_to', '$graduate_studies_year_graduated', '$graduate_studies_highest_level_earned', '$graduate_studies_scholarship_or_academic_received')";
    
    if(!mysqli_query($conn, $employeeEducationalBackgroundQuery)){
      $success = false;
    }
    
    foreach($leave_type_ids as $index => $leave_type_id) {
      $lt_id = $leave_type_id;
      $credits = $leave_credits[$index];
      $leaveCreditsQuery = "INSERT INTO employee_leave_credits (em_id, lt_id, available_credits) VALUES ('$em_id', '$lt_id', '$credits')";

      if(!mysqli_query($conn, $leaveCreditsQuery)){
        $success = false;
      }
    }

    if($success){
      // Commit transaction if all queries succeed
      mysqli_commit($conn);
      echo "success";
    } else {
      // Rollback if any query fails
      mysqli_rollback($conn);
      echo "Error: Unable to insert data.";
    }
  } else {
    echo "Please check your query: " . mysqli_error($conn);
  }

  // Reset autocommit mode
  mysqli_autocommit($conn, true);
}
?>