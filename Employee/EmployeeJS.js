$(document).ready(function() {
  $('#addEmployee').on('click', function() {
    var formData = new FormData();

    // Append the new fields for EMPLOYMENT DETAILS & SYSTEM CREDENTIALS
    formData.append('dep_id', $('#dep_id').val());
    formData.append('des_id', $('#des_id').val());
    formData.append('es_id', $('#es_id').val());
    formData.append('em_joining_date', $('#em_joining_date').val());
    formData.append('em_contract_end', $('#em_contract_end').val());
    formData.append('em_income', $('#em_income').val());
    formData.append('employee_status', $('#employee_status').val());
    formData.append('user_id', $('#user_id').val());
    formData.append('em_password', $('#em_password').val());
    formData.append('em_profile_pic', $('#em_profile_pic')[0].files[0]);

    // Append LEAVE TYPES and Loop through each checkbox to gather selected leave types and their credits
    $('input[name="leave_type_ids[]"]:checked').each(function() {
      var leaveTypeId = $(this).val();
      var creditInputId = 'credits_' + leaveTypeId;
      var leaveCredit = $('#' + creditInputId).val();
      formData.append('leave_type_ids[]', leaveTypeId); // Append leave type ID
      formData.append('leave_credits[]', leaveCredit); // Append leave credit
    });

    // Append the new fields for PERSONAL INFORMATION
    formData.append('last_name', $('#surname').val());
    formData.append('first_name', $('#first_name').val());
    formData.append('name_extension', $('#name_extension').val());
    formData.append('middle_name', $('#middle_name').val());
    formData.append('date_of_birth', $('#date_of_birth').val());
    formData.append('place_of_birth', $('#place_of_birth').val());

    var checkedSex = $('input[name="sex"]:checked').val();
    if (checkedSex) {
      formData.append('sex', checkedSex);
    }
  
    var checkedCivilStatus = $('input[name="civil_status"]:checked').val();
    if (checkedCivilStatus) {
      formData.append('civil_status', checkedCivilStatus);
    }
  
    var checkedCitizenship = $('input[name="citizenship"]:checked').val();
    if (checkedCitizenship) {
      formData.append('citizenship', checkedCitizenship);
    }  

    var checkedDualCitizenship = $('input[name="dual_citizenship_type"]:checked').val();

    if (checkedDualCitizenship) {
      formData.append('dual_citizenship_type', checkedDualCitizenship);
      formData.append('dual_citizenship_country', $('#dualCitizenshipCountrySelect').val());
    } else {
      formData.append('dual_citizenship_type', '');
      formData.append('dual_citizenship_country', '');
    }

    formData.append('height', $('#height').val());
    formData.append('weight', $('#weight').val());
    formData.append('blood_type', $('#blood_type').val());
    formData.append('gsis_id_no', $('#gsis_id_no').val());
    formData.append('pagibig_id_no', $('#pagibig_id_no').val());
    formData.append('philhealth_no', $('#philhealth_no').val());
    formData.append('sss_no', $('#sss_no').val());
    formData.append('tin_no', $('#tin_no').val());
    formData.append('agency_employee_no', $('#agency_employee_no').val());
    formData.append('telephone_no', $('#telephone_no').val());
    formData.append('mobile_no', $('#mobile_no').val());
    formData.append('email_address', $('#email_address').val());
    formData.append('residential_house_block_lot_no', $('#residentialHouseBlockLotNo').val());
    formData.append('residential_street', $('#residentialStreet').val());
    formData.append('residential_subdivision_village', $('#residentialSubdivisionVillage').val());
    formData.append('residential_barangay', $('#residentialBarangay').val());
    formData.append('residential_city_municipality', $('#residentialCityMunicipality').val());
    formData.append('residential_province', $('#residentialProvince').val());
    formData.append('residential_zip_code', $('#residentialZipCode').val());
    formData.append('permanent_house_block_lot_no', $('#permanentHouseBlockLotNo').val());
    formData.append('permanent_street', $('#permanentStreet').val());
    formData.append('permanent_subdivision_village', $('#permanentSubdivisionVillage').val());
    formData.append('permanent_barangay', $('#permanentBarangay').val());
    formData.append('permanent_city_municipality', $('#permanentCityMunicipality').val());
    formData.append('permanent_province', $('#permanentProvince').val());
    formData.append('permanent_zip_code', $('#permanentZipCode').val());    

    // Append the new fields for FAMILY BACKGROUND
    formData.append('spouse_surname', $('#spouseSurname').val());
    formData.append('spouse_first_name', $('#spouseFirstName').val());
    formData.append('spouse_name_extension', $('#spouseNameExtension').val());
    formData.append('spouse_middle_name', $('#spouseMiddleName').val());
    formData.append('spouse_occupation', $('#spouseOccupation').val());
    formData.append('spouse_employer_name', $('#spouseEmployerName').val());
    formData.append('spouse_business_address', $('#spouseBusinessAddress').val());
    formData.append('spouse_telephone_no', $('#spouseTelephoneNo').val());    

    // Append child name and date of birth fields
    for (let i = 1; i <= childCount; i++) {
      const childName = $(`#childName${i}`).val();
      const childDOB = $(`#childDOB${i}`).val();

      if (childName) {
        formData.append(`children[${i}][name]`, childName);
      }
      if (childDOB) {
        formData.append(`children[${i}][date_of_birth]`, childDOB);
      }
    }

    formData.append('father_surname', $('#fatherSurname').val());
    formData.append('father_first_name', $('#fatherFirstName').val());
    formData.append('father_name_extension', $('#fatherNameExtension').val());
    formData.append('father_middle_name', $('#fatherMiddleName').val());
    
    formData.append('mother_maiden_surname', $('#motherMaidenSurname').val());
    formData.append('mother_first_name', $('#motherFirstName').val());
    formData.append('mother_middle_name', $('#motherMiddleName').val());
    
    // Append the new fields for EDUCATIONAL BACKGROUND
    formData.append('elementary_school_name', $('#elementarySchoolName').val());
    formData.append('elementary_education', $('#elementaryEducation').val());
    formData.append('elementary_period_of_attendance_from', ($('#elementaryPeriodOfAttendanceFrom').val() == '0000' || $('#elementaryPeriodOfAttendanceFrom').val() == '') ? '' : $('#elementaryPeriodOfAttendanceFrom').val());
    formData.append('elementary_period_of_attendance_to', ($('#elementaryPeriodOfAttendanceTo').val() == '0000' || $('#elementaryPeriodOfAttendanceTo').val() == '') ? '' : $('#elementaryPeriodOfAttendanceTo').val());
    formData.append('elementary_year_graduated', ($('#elementaryYearGraduated').val() == '0000' || $('#elementaryYearGraduated').val() == '') ? '' : $('#elementaryYearGraduated').val());
    formData.append('elementary_highest_level_earned', $('#elementaryHighestLevelEarned').val());
    formData.append('elementary_scholarship_or_academic_received', $('#elementaryScholarshipOrAcademicReceived').val());

    formData.append('secondary_school_name', $('#secondarySchoolName').val());
    formData.append('secondary_education', $('#secondaryEducation').val());
    formData.append('secondary_period_of_attendance_from', ($('#secondaryPeriodOfAttendanceFrom').val() == '0000' || $('#secondaryPeriodOfAttendanceFrom').val() == '') ? '' : $('#secondaryPeriodOfAttendanceFrom').val());
    formData.append('secondary_period_of_attendance_to', ($('#secondaryPeriodOfAttendanceTo').val() == '0000' || $('#secondaryPeriodOfAttendanceTo').val() == '') ? '' : $('#secondaryPeriodOfAttendanceTo').val());
    formData.append('secondary_year_graduated', ($('#secondaryYearGraduated').val() == '0000' || $('#secondaryYearGraduated').val() == '') ? '' : $('#secondaryYearGraduated').val());
    formData.append('secondary_highest_level_earned', $('#secondaryHighestLevelEarned').val());
    formData.append('secondary_scholarship_or_academic_received', $('#secondaryScholarshipOrAcademicReceived').val());

    formData.append('vocational_school_name', $('#vocationalSchoolName').val());
    formData.append('vocational_education', $('#vocationalEducation').val());
    formData.append('vocational_period_of_attendance_from', ($('#vocationalPeriodOfAttendanceFrom').val() == '0000' || $('#vocationalPeriodOfAttendanceFrom').val() == '') ? '' : $('#vocationalPeriodOfAttendanceFrom').val());
    formData.append('vocational_period_of_attendance_to', ($('#vocationalPeriodOfAttendanceTo').val() == '0000' || $('#vocationalPeriodOfAttendanceTo').val() == '') ? '' : $('#vocationalPeriodOfAttendanceTo').val());
    formData.append('vocational_year_graduated', ($('#vocationalYearGraduated').val() == '0000' || $('#vocationalYearGraduated').val() == '') ? '' : $('#vocationalYearGraduated').val());
    formData.append('vocational_highest_level_earned', $('#vocationalHighestLevelEarned').val());
    formData.append('vocational_scholarship_or_academic_received', $('#vocationalScholarshipOrAcademicReceived').val());

    formData.append('college_school_name', $('#collegeSchoolName').val());
    formData.append('college_education', $('#collegeEducation').val());
    formData.append('college_period_of_attendance_from', ($('#collegePeriodOfAttendanceFrom').val() == '0000' || $('#collegePeriodOfAttendanceFrom').val() == '') ? '' : $('#collegePeriodOfAttendanceFrom').val());
    formData.append('college_period_of_attendance_to', ($('#collegePeriodOfAttendanceTo').val() == '0000' || $('#collegePeriodOfAttendanceTo').val() == '') ? '' : $('#collegePeriodOfAttendanceTo').val());
    formData.append('college_year_graduated', ($('#collegeYearGraduated').val() == '0000' || $('#collegeYearGraduated').val() == '') ? '' : $('#collegeYearGraduated').val());
    formData.append('college_highest_level_earned', $('#collegeHighestLevelEarned').val());
    formData.append('college_scholarship_or_academic_received', $('#collegeScholarshipOrAcademicReceived').val());

    formData.append('graduate_studies_school_name', $('#graduateStudiesSchoolName').val());
    formData.append('graduate_studies_education', $('#graduateStudiesEducation').val());
    formData.append('graduate_studies_period_of_attendance_from', ($('#graduateStudiesPeriodOfAttendanceFrom').val() == '0000' || $('#graduateStudiesPeriodOfAttendanceFrom').val() == '') ? '' : $('#graduateStudiesPeriodOfAttendanceFrom').val());
    formData.append('graduate_studies_period_of_attendance_to', ($('#graduateStudiesPeriodOfAttendanceTo').val() == '0000' || $('#graduateStudiesPeriodOfAttendanceTo').val() == '') ? '' : $('#graduateStudiesPeriodOfAttendanceTo').val());
    formData.append('graduate_studies_year_graduated', ($('#graduateStudiesYearGraduated').val() == '0000' || $('#graduateStudiesYearGraduated').val() == '') ? '' : $('#graduateStudiesYearGraduated').val());
    formData.append('graduate_studies_highest_level_earned', $('#graduateStudiesHighestLevelEarned').val());
    formData.append('graduate_studies_scholarship_or_academic_received', $('#graduateStudiesScholarshipOrAcademicReceived').val());


    const requiredFields = ['dep_id', 'des_id', 'es_id', 'em_joining_date', 'em_contract_end', 'em_income', 'em_password', 'user_id', 'last_name', 'first_name', 'middle_name', 'date_of_birth', 'place_of_birth', 'sex', 'civil_status', 'citizenship', 'blood_type', 'date_of_birth', 'place_of_birth', 'civil_status', 'citizenship', 'mobile_no', 'email_address', 'residential_barangay', 'residential_city_municipality', 'residential_province', 'residential_zip_code', 'permanent_barangay', 'permanent_city_municipality', 'permanent_province', 'permanent_zip_code', 'father_surname', 'father_first_name', 'father_middle_name', 'mother_maiden_surname', 'mother_first_name', 'mother_middle_name'];
    
    let isValid = true;
    requiredFields.forEach(field => {
      if (!formData.get(field)) { // checks for both null and "" values
        isValid = false;  
      }
    });
    
    if (!isValid) {
      $('#message').html('Please fill in all required fields');
      console.log(formData);
      for (let [key, value] of formData.entries()) {
        console.log(key + ': ' + value);
      }
    } else {
      $.ajax({
        url: 'Employee/insertEmployee.php',
        method: 'POST',
        data: formData,
        processData: false,
        contentType: false,
        success: function(data) {
          if (data.toLowerCase().includes('success')) {
            $('#exampleModalCenter').modal('show');
            $('form').trigger('reset');
          } else {
            $('#message').html(data);
          }
        }
      });
    }
  });
});