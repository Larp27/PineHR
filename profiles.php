<!--Declaration of user session -logout- -->
<?php
$title = 'Profile';
$page = 'profile';
include_once('./main.php');
?>
<!--cont logout session-->


<!--Employee Process Update JS-->
<script src="Employee/updateEM.js"></script>
<!--Employee Process JS-->
<script src="Employee/EmployeeJS.js"></script>


<form>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">

                &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-clipboard-user fa-2xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Employee</span></strong>

            </div><br>

            <div class="col-md-7" style="width: 100%">
                <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0; ">
                    <div class="panel-heading">



                        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-users-between-lines fa-lg" style="color: #2468a0;"></i>&nbsp;&nbsp;Profile</span></strong>

                        <!-- PHP for triggering modal -->

                        <?php
                        $em_id = $_SESSION['s_em_id'];
                        if ($_SESSION['s_user_id'] == 1) {
                            $query = "Select * from employee where em_id = $em_id";

                            $result = mysqli_query($conn, $query);
                        }
                        ?>
                        <?php if ($_SESSION['s_user_id'] == 1) {
                            $query = "select * from user_type";

                            $result = mysqli_query($conn, $query);
                        }

                        ?>


                    </div>

                    <?php
                    $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id INNER JOIN `user_type` ut ON ut.user_id = e.user_id INNER JOIN `employment_status` es ON es.es_id = e.es_id";
                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {

                        $r_em_id = $row['em_id'];
                        $r_em_gender = $row['em_gender'];
                        $r_first_name = $row['first_name'];
                        $r_last_name = $row['last_name'];
                        $r_des_name = $row['des_name'];
                        $r_dep_name = $row['dep_name'];
                        $r_es_name = $row['es_name'];
                        $r_bt_name = $row['bt_name'];
                        $r_em_phone = $row['em_phone'];
                        $r_em_birthday = $row['em_birthday'];
                        $r_user_role = $row['user_role'];
                        $r_em_address = $row['em_address'];


                    ?> <?php } ?>




                    <table class="table info-table">
                        <tr class='boder-0'>
                            <td width="10%">

                            </td>
                            <td width="90%" class='boder-0 align-bottom'>
                                <div class="row">
                                    <div class="col-12">
                                        <div class="d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Employee ID:</label>
                                            <p class="col-md-auto border-bottom border-dark w-100"><b><?php echo  $r_em_id ?></b></p>
                                        </div>
                                        <div class="d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Name:</label>
                                            <p class="col-md-auto border-bottom border-dark w-100"><b><?php echo $r_first_name,  $r_last_name ?></b></p>
                                        </div>
                                        <div class="row justify-content-between  w-max-100 mr-0">
                                            <div class="col-6 d-flex w-max-100">
                                                <label class="float-left w-auto whitespace-nowrap">Birthdate: </label>
                                                <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo date("M d, Y", strtotime($r_em_birthday)) ?></b></p>
                                            </div>
                                            <div class="col-6 d-flex w-max-100">
                                                <label class="float-left w-auto whitespace-nowrap">Contact No.: </label>
                                                <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo  $r_em_phone ?></b></p>
                                            </div>
                                        </div>
                                        <div class="d-flex w-max-100">
                                            <label class="float-left w-auto whitespace-nowrap">Address:</label>
                                            <p class="col-md-auto border-bottom border-dark w-100"><b><?php echo $r_em_address ?></b></p>
                                        </div>
                                        <div class="row justify-content-between  w-max-100  mr-0">
                                            <div class="col-6 d-flex w-max-100">
                                                <label class="float-left w-auto whitespace-nowrap">Department: </label>
                                                <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo $r_dep_name ?></b></p>
                                            </div>
                                            <div class="col-6 d-flex w-max-100">
                                                <label class="float-left w-auto whitespace-nowrap">Designation: </label>
                                                <p class="col-md-auto border-bottom px-2 border-dark w-100"><b><?php echo $r_des_name ?></b></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>


                    <!--cont LOGOUT Session -- -->

                    <?php

                    $query = "SELECT * FROM `employee` e INNER JOIN `department` d ON e.dep_id = d.dep_id INNER JOIN `designation` de ON de.des_id = e.des_id INNER JOIN `blood_group` bg ON bg.bt_id = e.bt_id INNER JOIN `user_type` ut ON ut.user_id = e.user_id INNER JOIN `employment_status` es ON es.es_id = e.es_id";

                    $result = mysqli_query($conn, $query);
                    while ($row = mysqli_fetch_assoc($result)) {

                        $r_em_id = $row['em_id'];
                        $r_first_name = $row['first_name'];
                        $r_last_name = $row['last_name'];
                        $r_dep_name = $row['dep_name'];
                        $r_des_name = $row['des_name'];
                        $r_user_role = $row['user_role'];
                        $r_em_gender = $row['em_gender'];
                        $r_bt_name = $row['bt_name'];
                        $r_em_phone = $row['em_phone'];
                        $r_em_birthday = $row['em_birthday'];
                        $r_em_joining_date = $row['em_joining_date'];
                        $r_em_contract_end = $row['em_contract_end'];
                        $r_em_email = $row['em_email'];
                        $r_em_password = $row['em_password'];

                    ?>
                    <?php
                    }
                    ?>
                </div>




                <script>
                    var updateUserModal = document.getElementById('updateUserModal');
                    updateUserModal.addEventListener('show.bs.modal', function(event) {
                        var button = event.relatedTarget; // Button that triggered the modal
                        var em_id = button.getAttribute('data-em-id'); // Extract info from data-* attributes
                        var gender = button.getAttribute('data-gender');
                        var first_name = button.getAttribute('data-f-name');
                        var last_name = button.getAttribute('data-l-name');
                        var des_id = button.getAttribute('data-des-id');
                        var dep_id = button.getAttribute('data-dep-id');
                        var es_id = button.getAttribute('data-es-id');
                        var bt_id = button.getAttribute('data-bt-id');
                        var phone = button.getAttribute('data-em-phone');
                        var address = button.getAttribute('data-em-address');
                        var birthday = button.getAttribute('data-em-birthday');
                        var role = button.getAttribute('data-role-id');
                        var email = button.getAttribute('data-em-email');
                        var join_date = button.getAttribute('data-em-join-date');
                        var contract_end = button.getAttribute('data-em-contract-end');


                        var modalBody = updateUserModal.querySelector('.modal-body');
                        modalBody.querySelector('#em_id').value = em_id;
                        modalBody.querySelector('#gender').value = gender;
                        modalBody.querySelector('#f_name').value = first_name;
                        modalBody.querySelector('#l_name').value = last_name;
                        modalBody.querySelector('#des_id').value = des_id;
                        modalBody.querySelector('#dep_id').value = dep_id;
                        modalBody.querySelector('#es_id').value = es_id;
                        modalBody.querySelector('#bt_id').value = bt_id;
                        modalBody.querySelector('#em_phone').value = phone;
                        modalBody.querySelector('#em_address').value = address;
                        modalBody.querySelector('#em_birthday').value = birthday;
                        modalBody.querySelector('#user_role').value = role;
                        modalBody.querySelector('#em_email').value = email;
                        modalBody.querySelector('#em_joining_date').value = join_date;
                        modalBody.querySelector('#em_contract_end').value = contract_end;
                    })
                </script>






                <script src="Employee/updateEM.js"></script>