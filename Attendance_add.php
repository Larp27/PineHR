<!--Declaration of user session -logout- -->
<?php
$title = 'Attendance';
$page = 'attendance_add';
include_once('./main.php');
?>
<!--cont logout session-->

<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Attendance</span></strong>
        </strong>
      </div><br>

      <div class="col-md-7" style="width: 100%; height: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;  ">
          <div class="panel-heading">
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Add New Attendance</span></strong>

            <div class="panel-body">

              <form method="post" action="Attendance_list.php">
                <p id="message" class=text-danger> </p>

                <div class="form-group mb-3">
                  <label for="em_id" class="fw-bold">Employee Name</label>
                  <select class="form-select" id="em_id" name="em_id" required>
                    <option <?php echo (!isset($ms_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                    <?php
                    $em_qry = $conn->query("SELECT * FROM employee order by last_name asc");
                    while ($row = $em_qry->fetch_assoc()) :
                    ?>
                      <option value="<?php echo $row['em_id'] ?>" <?php echo (isset($em_id) && $em_id == $row['em_id']) ? 'selected' : '' ?>><?php echo $row['last_name'] ?>, <?php echo $row['first_name'] ?></option>
                    <?php endwhile; ?>
                  </select>
                </div>

                &nbsp;<strong><span>Attendance Date</span></strong><br>
                <br><input type="date" class="form-control" placeholder="Type here" id="att_date" aria-describedby="addon-wrapping"><br>

                &nbsp;<strong><span>Attendance Time In</span></strong><br>
                <br><input type="time" class="form-control" placeholder="Type here" id="att_s_in" aria-describedby="addon-wrapping"><br>

                &nbsp;<strong><span>Attendance Time Out</span></strong><br>
                <br><input type="time" class="form-control" placeholder="Type here" id="att_s_out" aria-describedby="addon-wrapping"><br>

                <!-- Add an empty span for displaying Total Hours -->
                &nbsp;<strong><span>Total Hours: <span id="total_hr">0</span></span></strong><br><br>

                <script>
                  // Add event listeners to time input fields
                  document.getElementById('att_s_in').addEventListener('change', calculateTotalHours);
                  document.getElementById('att_s_out').addEventListener('change', calculateTotalHours);

                  function calculateTotalHours() {
                    // Get the values of time in and time out
                    var timeIn = document.getElementById('att_s_in').value;
                    var timeOut = document.getElementById('att_s_out').value;

                    // If both time in and time out are set
                    if (timeIn && timeOut) {
                      // Parse time strings to Date objects
                      var timeInDate = new Date('1970-01-01T' + timeIn + 'Z');
                      var timeOutDate = new Date('1970-01-01T' + timeOut + 'Z');

                      // Calculate the difference in milliseconds
                      var timeDiff = timeOutDate - timeInDate;

                      // Convert milliseconds to hours and minutes
                      var totalHours = Math.floor(timeDiff / (1000 * 60 * 60));
                      var totalMinutes = Math.floor((timeDiff % (1000 * 60 * 60)) / (1000 * 60));

                      // Update the total hours display
                      document.getElementById('total_hr').textContent = totalHours + ':' + totalMinutes;
                    } else {
                      // If either time in or time out is not set, display 0 hours
                      document.getElementById('total_hr').textContent = '0';
                    }
                  }
                </script>






                <!-- Button trigger for saving modal -->
                <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style="background-color: #2468a0; margin-left: -15px"></i>
                Save
                </button>&nbsp;
                <a href="Attendance_list.php"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style=" margin-left: 5px"><i class="fa-solid fa-delete-left" style="color: #000000"></i>
                    Cancel
                  </button></a><br><br>



                <!-- Verification Modal -->
                <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-centered" role="document">
                    <div class="modal-content">
                      <div class="modal-header">
                        <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>

                      </div>
                      <div class="modal-body">
                        &nbsp;&nbsp;New Attendance Added!. Thank you.
                      </div>
                      <div class="modal-footer">
                        <a href="Attendance_list.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                      </div>
                    </div>
                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>

        <!--Attendance Process Add and Update JS-->
        <script src="Attendance/AttendanceJS.js"></script>
        <script src="Attendance/updateATT.js"></script>