<!--Declaration of user session -logout- -->
<?php
$title = 'Certificate';
$page = 'certificate_add';
include_once('./main.php');
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

<form method="post" action="" enctype="multipart/form-data">
  <div class="panel panel-default" >
    <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
      <strong>
        &nbsp;
        <span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-hands-praying fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee Certificate</strong></span>
      </strong>
    </div>
  </div>

  <div class="m-2 pt-2" style="height:85vh !important;">
    <div class="card card-outline card-primary m-3">
      <div class="card-header">
        <div class="panel-heading" style="padding: 2px !important;">
          <strong>
            &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Add New Employee Certificate</span></strong>
          </strong>
        </div>
      </div>

      <div class="card-body">
        <div class="container-fluid">
          <p id="message" class=text-danger></p>
          <div class="row">
            <div class="col-6">
              <div class="form-group mb-3">
                <label for="em_id" class="fw-bold text-uppercase">Employee Name</label>
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
              <div class="form-group mb-3">
                <label for="cert_title" class="fw-bold text-uppercase">Certificate Title</label>
                <input type="text" class="form-control" placeholder="Certificate Title" id="cert_title" name="cert_title" aria-describedby="addon-wrapping" required>
              </div>
              <div class="form-group mb-3">
                <label for="cert_description" class="fw-bold text-uppercase">Certificate Description</label>
                <textarea class="form-control" placeholder="Type here" id="cert_description" rows="5" aria-describedby="addon-wrapping" required></textarea>
              </div>
            </div>
            <div class="col-6">
              <div class="form-group mb-3">
                <label for="cert_date" class="fw-bold text-uppercase">Date Acquired</label>
                <input type="date" class="form-control" id="cert_date" name="cert_date" required>
              </div>
              <div class="form-group mb-3">
                <label for="cert_media" class="fw-bold text-uppercase">Certificate Media</label>
                <div class="d-flex justify-content-center mb-2">
                  <?php
                    $default_pic = '../PINEHR/bgimages/certificate.png'; 
                    $cert_media_path = !empty($cert_media) ? '../PINEHR/' . substr($cert_media, 3) : $default_pic;
                  ?>

                  <img src="<?php echo $cert_media_path; ?>" style="width: 250px;" alt="Certificate Media" class="cert-photo">
                </div>
                <div class="text-center mb-3">
                  <button type="button" class="btn select-photo-btn m-1" style="--tw-shadow: 0 1px 2px 0 rgb(0 0 0 / .05); --tw-shadow-colored: 0 1px 2px 0 var(--tw-shadow-color); box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); color: rgb(55 65 81); text-transform: uppercase; font-weight: 600; font-size: .75rem; line-height: 1rem; letter-spacing: .1em; margin-right: 5px; padding: 0.5rem 1rem; border-color: rgb(209 213 219); border-width: 1px; border-radius: 0.375rem; text-align: center;">Select a new photo</button>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>

    <!-- Button trigger for saving modal -->
    <div class="m-4 text-end">
      <button type="button" class="btn btn-success text-uppercase fw-bold" style="letter-spacing: 0.8px;" id="buttonCertificateSAVE" name="buttonCertificateSAVE" style="background-color: #2468a0; margin-left: -15px">
        <i class="fa-solid fa-check" style="color: #ffffff;"> Save</i>
      </button>
      <a href="Certificate.php" class="btn btn-warning text-uppercase fw-bold" id="btnClose" name="btnClose">
        <i class="fa-solid fa-delete-left" style="color: #000000"></i> Cancel
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
            <a href="Certificate.php" class="btn btn-success">Done</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</form>
<script src="Certificate/CertificateJS.js"></script>
<script>
  document.querySelector('.select-photo-btn').addEventListener('click', function() {
    const input = document.createElement('input');
    input.type = 'file';
    input.accept = 'image/*';
    input.id = 'cert_media';
    input.name = 'cert_media';
    input.onchange = function(e) {
      const file = e.target.files[0];
      if (file) {
        const reader = new FileReader();
        reader.onload = function(e) {
          const img = document.querySelector('.cert-photo');
          img.src = e.target.result;
        };
        reader.readAsDataURL(file);
      }
    };
    input.click();

    const form = document.querySelector('form');
    form.appendChild(input);
  });
</script>
