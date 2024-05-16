<!--Declaration of user session -logout- -->
<?php
  $title = 'Address';
  $page = 'Address';
  include_once('./main.php');
?>

<style>
  div.dataTables_wrapper div.dataTables_paginate .paginate_button {
    border: none !important;
    padding: 0px !important;
  }
</style>

<div class="container-fluid">
  <div class="row">
    <div class="col-md-12 p-5 shadow-lg ">
      <div style="height:100vh;">
        <div class="d-flex justify-content-between align-items-center">
          <p class="fs-5 fw-bold text-uppercase">Address</p>
          <a href="Address_add.php" class="text-decoration-none"><button type="button" class="btn btn-primary" style="background-color: #2468a0;">Add New Address +</button></a>
        </div>
        <div class="dash_content mt-3">
          <div class="dash_content_main">
            <div class="table-responsive">
              <table class="table" id="example">
                <colgroup>
                  <col width="10%">
                  <col width="35%">
                  <col width="30%">
                </colgroup>
                <thead class="" style="background-color: rgb(255, 206, 46)">
                  <tr>
                    <th class="text-center p-2">#</th>
                    <th class="text-center p-2">Barangay</th>
                    <th class="text-center p-2">City</th>
                    <th class="text-center p-2">Action</th>
                  </tr>
                </thead>
                <?php
                $i = 1;
                $query = "SELECT * from `address`";

                $result = mysqli_query($conn, $query);
                while ($row = mysqli_fetch_assoc($result)) {

                  $r_address_id = $row['address_id'];
                  $r_barangay = $row['barangay'];
                  $r_city = $row['city'];

                  echo "<tr> 
                    <td class='text-center p-3'>" . $i++ . "</td> <!-- Increment the counter and print its value -->
                    <td class='text-center p-3'> $r_barangay </td>
                    <td class='text-center p-3'> $r_city </td>";
                    
                ?>
                  <td class='text-center p-1'>
                    <div class="col-auto d-flex justify-content-center m-2">
                    <button type="button" class="py-0 px-1 me-1 btn btn-success btn-sm update-user-btn" data-bs-toggle="modal" data-bs-target="#updateUserModal" data-address_id="<?php echo $row['address_id']; ?>" data-barangay="<?php echo $row['barangay']; ?>" data-city="<?php echo $row['city']; ?>"><i class="fas fa-edit"></i> Edit</button>


                      <a href="BloodType/deleteAddress.php?bt_id=<?php echo $row['address_id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this Blood Type Data?')"><i class="fas fa-trash"></i> Delete </a>
                    </div>
                  </td>
                  </tr>
                <?php
                }
                ?>
              </table>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Modal sa Update Button -->
<div>
 <div class="modal" id="updateUserModal" tabindex="-1" aria-labelledby="updateUserModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="updateUserModalLabel">Update Address</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <p id="message" class=text-danger></p>
        <form method="post" action="">
          <div class="mb-3">
              <input type="hidden" class="form-control" id="address_id" name="address_id">
            </div>
            <div class="mb-3">
              <label for="update_barangay" class="form-label">&nbsp;Barangay</label>
              <input type="text" class="form-control" id="update_barangay" name="barangay" required>
            </div>
            <div class="mb-3">
              <label for="update_city" class="form-label">&nbsp;City</label>
              <input type="text" class="form-control" id="update_city" name="city" required>
            </div>
            <button type="button" class="btn btn-success" name="btnUpdate" id="btnUpdateAddress">Update</button>
        </form>
      </div>
    </div>
  </div>
</div>

<div class="modal" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title text-success" id="exampleModalLongTitle">Updated Successfully!</h5>
     
      </div>
      <div class="modal-body">
      &nbsp;&nbsp;Updated Address Details Successfully! Thank you.
      </div>
      <div class="modal-footer">
        <a class="btn btn-success" href = "Address.php">Done</a>
      </div>
    </div>
  </div>
</div>

<script>
  var updateUserModal = document.getElementById('updateUserModal');
  updateUserModal.addEventListener('show.bs.modal', function(event) {
    var button = event.relatedTarget;
    var address_id = button.getAttribute('data-address_id');
    var barangay = button.getAttribute('data-barangay');
    var city = button.getAttribute('data-city');


    var modalBody = updateUserModal.querySelector('.modal-body');
    modalBody.querySelector('#address_id').value = address_id;  
    modalBody.querySelector('#update_barangay').value = barangay;
    modalBody.querySelector('#update_city').value = city;
  });
</script>

<!--Education Process Add and Update JS-->
<script src="Address/AddressJS.js"></script>
<script src="Address/updateAddress.js"></script>
<link rel="stylesheet" href="css/employee.css">