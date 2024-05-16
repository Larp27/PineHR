<!--Declaration of user session -logout- -->
<?php
$title = 'Certificate';
$page = 'certificate_add';
include_once('./main.php');
?>
<!--cont logout session-->

<div class="col-md-12">
    <div class="panel panel-default">
        <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
            <strong>
                &nbsp;<span><strong style="font-family: 'Glacial Indiffernce'"><i class="fa-solid fa-hands-praying fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Employee Certificate</span></strong>
            </strong>
        </div><br>

        <div class="col-md-7" style="width: 100%; height: 100%">
            <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;">
                <div class="panel-heading">
                    &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Add New Employee Certificate</span></strong>

                    <div class="panel-body">
                        <p id="message" class="text-danger"></p>



                        <div class="row mb-3">
                            <div class="col-md-5">
                                <div class="form-group">
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
                            </div>
                            <div class="col-md-5">
                                <div class="form-group">
                                    <label for="cert_description" class="fw-bold">Certificate Title</label>
                                    <input type="text" class="form-control" placeholder="Type here" id="cert_description" aria-describedby="addon-wrapping">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-5">
                            <div class="col-md-5">
                                <div class="form-group">
                                  
                                    <label for="cert_media" class="fw-bold">Cert Media</label>
                                    <input type="file" class="form-control" id="cert_media" name="cert_media" accept="image/*">
                                </div>

                                <div class="form-group mt-3">
                                    <label for="cert_date" class="fw-bold">Date Acquired</label>
                                    <input type="date" class="form-control" id="cert_date" name="cert_date">
                                </div>
                            </div>

                            <div class="col-md-5">
                                <div class="form-group mb-7">
                                    <br>
                                    <?php
                                    $default_pic = 'bgimages/certificate.png'; // Replace with the actual path to your default picture
                                    $cert_media_path = !empty($cert_media) ? '../PINEHR/' . substr($cert_media, 3) : $default_pic;
                                    ?>
                                    <img src="<?php echo $cert_media_path; ?>" id="cert_media_preview" style="width: 600px; height: 400px;" alt="Profile Photo" class="profile-photo">
                                </div>
                            </div>
                        </div>
                        <script>
                            document.getElementById('cert_media').addEventListener('change', function(event) {
                                const [file] = event.target.files;
                                if (file) {
                                    const reader = new FileReader();
                                    reader.onload = function(e) {
                                        document.getElementById('cert_media_preview').src = e.target.result;
                                    }
                                    reader.readAsDataURL(file);
                                }
                            });
                        </script>



                        <!-- Button trigger for saving modal -->
                        <div class="text-left mb-3">  &nbsp;  &nbsp;  &nbsp;
                            <button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style="background-color: #2468a0; margin-left: -15px">
                                <i class="fa-solid fa-check" style="color: #ffffff;"></i> Save
                            </button>
                            &nbsp;
                            <a href="Certificate.php">
                                <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style="margin-left: 5px">
                                    <i class="fa-solid fa-delete-left" style="color: #000000"></i> Cancel
                                </button>
                            </a>
                        </div>



                        <!-- Verification Modal -->
                        <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                            <div class="modal-dialog modal-dialog-centered" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title text-success" id="exampleModalLongTitle">Recorded Successfully!</h5>

                                    </div>
                                    <div class="modal-body">
                                        &nbsp;&nbsp;Employee Certificate Added!
                                    </div>
                                    <div class="modal-footer">
                                        <a href="Certificate.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
                </div>
            </div>

            <!--Certificate Process Add and Update JS-->
            <script src="Certificate/CertificateJS.js"></script>
        </div>
    </div>
</div>