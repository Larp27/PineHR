<?php
$title = 'Leave';
$page = 'leave_app_add';
include_once('./main.php');
?>


    <!--Department Process Add and Update JS-->
    <script src="Department/DepartmentJS.js"></script>
    <script src="Department/updateDEPT.js"></script>



              <!--Declaration of user session -logout- -->
              <?php
              // Check if the user has any employee leave credits
              $em_id = $_SESSION['s_em_id'];
              $query = "SELECT COUNT(*) AS count FROM employee_leave_credits WHERE em_id = $em_id";
              $result = mysqli_query($conn, $query);
              $row = mysqli_fetch_assoc($result);
              $leave_credit_count = $row['count'];

              // Check if all leave credits are 0
              $all_credits_zero = false;
              if ($leave_credit_count > 0) {
                $query = "SELECT SUM(available_credits) AS total_credits FROM employee_leave_credits WHERE em_id = $em_id";
                $result = mysqli_query($conn, $query);
                $row = mysqli_fetch_assoc($result);
                $total_credits = $row['total_credits'];
                if ($total_credits == 0) {
                  $all_credits_zero = true;
                }
              }

              // Disable the "Application" dropdown item if necessary
              $application_disabled = ($leave_credit_count == 0 || $all_credits_zero) ? 'disabled' : '';

              // Determine the tooltip message
              $tooltip_message = "";
              if ($leave_credit_count == 0) {
                $tooltip_message = "You have no employee leave credits.";
              } elseif ($all_credits_zero) {
                $tooltip_message = "All your leave types have zero available credits.";
              }
              ?>
              <!-- end Declaration of user session -logout- -->

         
  

        <div class="col-md-12">
          <div class="panel panel-default">
            <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
              <strong>
                &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Application List</span></strong>
              </strong>
            </div><br>

            <div class="row">
              <div class="col-12">
                <div class="panel panel-default" style="margin-left: 20px; width: 95%; box-shadow: 3px 5px 8px #2468a0;">
                  <div class="panel-heading">
                    <strong>
                      &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add Application</span></strong>
                    </strong>
                  </div>

                  <div class="panel-body">
                    <form id="leaveForm" class="form m-3" action="save_leave_application1.php" method="post">
                      <div class="mb-3">
                        <label for="imId" class="form-label fw-bold">Employee ID & Name</label>
                        <select class="form-select" id="imId" name="imId" required>
                          <option value="">Select Employee Here</option>
                          <?php
                          $query = "SELECT em_id, first_name, last_name FROM employee";
                          $result = mysqli_query($conn, $query);
                          while ($row = mysqli_fetch_assoc($result)) {
                            echo '<option value="' . $row["em_id"] . '">' . $row["em_id"] . ' - ' . $row["first_name"] . ' ' . $row["last_name"] . '</option>';
                          }
                          ?>
                        </select>
                      </div>
                      <div class="mb-3">
                        <label for="leave" class="form-label fw-bold">Type of Leave</label>
                        <select name="leave" id="leave" class="form-select" aria-label="Default select example" required disabled data-bs-toggle="tooltip" title="Please select an employee before choosing the type of leave.">
                          <option class="fw-bold" selected disabled>Select a Leave</option>
                          <?php
                          // Placeholder options, since the actual options will be loaded dynamically based on employee selection
                          echo '<option value="" disabled style="display:none;"></option>';
                          ?>
                        </select>
                      </div>

                      <div class="mb-3">
                        <label for="leave_reason" class="form-label fw-bold">Leave Reason</label>
                        <textarea name="reason" cols="30" placeholder="State your Reason" rows="5" class="form-control" required></textarea>
                      </div>

                                           
                      <div class="mb-3">
                          <label for="st_day" class="form-label fw-bold">Starting Day</label>
                          <input type="date" class="form-control" id="st_day" name="st_day" required>
                      </div>

                      <div class="mb-3">
                          <label for="end_day" class="form-label fw-bold">Ending Day</label>
                          <input type="date" class="form-control" id="end_day" name="end_day" required>
                      </div>

                      <script>
                          document.getElementById('st_day').addEventListener('change', function() {
                              document.getElementById('end_day').min = this.value;
                          });
                      </script>
                     


                      <div class="mb-3 text-end">
                        <a href="Leave_app_list.php"> <button type="submit" id="submitLeave" class="btn btn-primary">ADD</button> </a>
                      </div>
                    </form>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>



      <!--Modal for logout-->
      <div>
        <div id="exampleModal" class="modal fade">
          <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
              <form id="addProductForm" action="">
                <div class="modal-header">
                  <h4 class="modal-title">Are you sure you want to logout?</h4>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-footer">
                  <a href="Leave_app_add.php"><button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button></a>
                  <a href="logout.php"><button type="button" class="btn btn-primary" name="btnSave2" id="btnSave2">Yes</button></a>
                </div>
              </form>
            </div>
          </div>
        </div>
      </div>
      <!--End of modal logout-->

      <!-- Success Modal -->
      <div class="modal fade" id="successModal" tabindex="-1" aria-labelledby="successModalLabel" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="successModalLabel">Leave Application Submitted Successfully</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
              Your leave application has been submitted successfully.
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
              <!-- Redirect button -->
              <a href="Leave_app_list.php" class="btn btn-primary">Go to Leave Application List</a>
            </div>
          </div>
        </div>
      </div>
    </div>


  <script>
    document.getElementById('imId').addEventListener('change', function() {
      var employeeId = this.value;
      var leaveSelect = document.getElementById('leave');

      // If employeeId is not empty, enable the leave select and fetch leave options
      if (employeeId !== '') {
        fetch('fetch_leave_options.php?employeeId=' + employeeId)
          .then(response => response.json())
          .then(data => {
            if (data.length > 0) {
              leaveSelect.innerHTML = '<option class="fw-bold" selected disabled>Select a Leave</option>';
              data.forEach(option => {
                leaveSelect.innerHTML += '<option value="' + option.lt_id + '">' + option.lt_name + ' (' + option.available_credits + ' remaining credits)' + '</option>';
              });

              leaveSelect.disabled = false;
              leaveSelect.removeAttribute('data-bs-original-title');
            } else {
              // If no leave types available, disable the leave select and show a tooltip
              leaveSelect.innerHTML = '<option class="fw-bold" selected disabled>No Leave Types Available</option>';
              leaveSelect.disabled = true;
              leaveSelect.setAttribute('data-bs-original-title', 'No leave types available for this employee.');
            }
          })
          .catch(error => console.error('Error:', error));
      } else {
        // If no employee is selected, disable the leave select and show a tooltip
        leaveSelect.innerHTML = '<option class="fw-bold" selected disabled>Select a Leave</option>';
        leaveSelect.disabled = true;
        leaveSelect.selectedIndex = 0;
      }
    });

    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function(tooltipTriggerEl) {
      return new bootstrap.Tooltip(tooltipTriggerEl)
    })

    $(document).ready(function() {
      $('#leaveForm').submit(function(e) {
        e.preventDefault();
        var formData = $(this).serialize();

        $.ajax({
          type: 'POST',
          url: $(this).attr('action'),
          data: formData,
          dataType: 'json',
          success: function(response) {
            if (response.status === "success") {
              $('#successModal').modal('show');
            } else {
              alert('An error occurred while submitting the leave application. Please try again.');
            }
          },
          error: function(xhr, status, error) {
            console.error(xhr.responseText);
            alert('An error occurred while submitting the leave application. Please try again.');
          }
        });
      });
    });

    
  </script>

  <script>
    /*var updateUserModal = document.getElementById('updateUserModal');
    updateUserModal.addEventListener('show.bs.modal', function(event) {
      var button = event.relatedTarget; // Button that triggered the modal
      var dep_id = button.getAttribute('data-dep-id'); // Extract info from data-* attributes
      var dep_name = button.getAttribute('data-dep-name'); // Extract info from data-* attributes

      var modalBody = updateUserModal.querySelector('.modal-body');
      modalBody.querySelector('#dep_id').value = dep_id;
      modalBody.querySelector('#dep_name').value = dep_name;

    })*/
  </script>
  