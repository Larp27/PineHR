<!--Declaration of user session -logout- -->
<?php
$title = 'Education';
$page = 'education_add';
include_once('./main.php');
?>
<!--cont logout session-->

<form>
  <div class="col-md-12">
    <div class="panel panel-default">
      <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
        <strong>
          &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-graduation-cap fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Department</span></strong>
        </strong>
      </div><br>

      <div class="col-md-7" style="width: 100%; height: 100%">
        <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;  ">
          <div class="panel-heading">
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Add New Educational Attainment</span></strong>

            <div class="panel-body">

              <form method="post" action="Education.php">
                <p id="message" class=text-danger> </p>

                &nbsp;<strong><span>Educational Attainment</span></strong><br>
                <br><input type="text" class="form-control" placeholder="Type here" id="education" aria-describedby="addon-wrapping"><br>


                <!-- Button trigger for saving modal -->
                <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style="background-color: #2468a0; margin-left: -15px"></i>
                Save
                </button>&nbsp;
                <a href="Education.php"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style=" margin-left: 5px"><i class="fa-solid fa-delete-left" style="color: #000000"></i>
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
                        &nbsp;&nbsp;New Education Added!. Thank you.
                      </div>
                      <div class="modal-footer">
                        <a href="Education.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                      </div>
                    </div>
                  </div>
                </div>


              </form>
            </div>
          </div>
        </div>

        <!--Department Process Add and Update JS-->
        <script src="Education/EducationJS.js"></script>
        <script src="Education/updateEDU.js"></script>