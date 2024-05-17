<?php
$title = 'Payroll';
$page = 'payroll_add';
include_once('./main.php');
?>
<!--cont logout session-->

<form>
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading" style="box-shadow: 0 4px 5px -1px #2468a0;">
                <strong>
                    &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-building-user fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;&nbsp;Payroll</span></strong>
                </strong>
            </div><br>

            <div class="col-md-7" style="width: 100%; height: 100%">
                <div class="panel panel-default" style="margin-left: 20px; width: 98%; box-shadow: -3px 5px 8px #2468a0, 3px 5px 8px #2468a0;  ">
                    <div class="panel-heading">
                        &nbsp;<span><strong style="font-family: 'Glacial Indifference'"><i class="fa-solid fa-plus fa-xl" style="color: #2468a0;"></i>&nbsp;&nbsp;Add New Payroll</span></strong>

                        <div class="panel-body">

                            <form method="post" action="Payroll_list.php">
                                <p id="message" class=text-danger> </p>

                                <div class="form-group mb-3">
                                    <label for="em_id" class="fw-bold">Employee Name</label>
                                    <select class="form-select" id="em_id" name="em_id" required>
                                        <option <?php echo (!isset($ms_id)) ? 'selected' : '' ?> disabled>Please Select Here</option>
                                        <?php
                                        $em_qry = $conn->query("SELECT * FROM employee ORDER BY last_name ASC");
                                        while ($row = $em_qry->fetch_assoc()) :
                                            $em_full_name = $row['last_name'] . ', ' . $row['first_name'];
                                            $em_income = $row['em_income'];
                                        ?>
                                            <option value="<?php echo $row['em_id'] ?>" <?php echo (isset($em_id) && $em_id == $row['em_id']) ? 'selected' : '' ?>>
                                                <?php echo 'Name: ' . $em_full_name . ' &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; >>>Income: ' . $em_income . '' ?>
                                            </option>




                                        <?php endwhile; ?>
                                    </select>
                                </div>


                                &nbsp;<strong><span>Payroll Date Range</span></strong><br><br>
                                &nbsp;<strong><span>Payroll Start Date</span></strong>
                                <br><input type="date" class="form-control" placeholder="Type here" id="payroll_start_date" name="payroll_start_date" aria-describedby="addon-wrapping"><br>

                                &nbsp;<strong><span>Payroll End Date</span></strong>
                                <br><input type="date" class="form-control" placeholder="Type here" id="payroll_end_date" name="payroll_end_date" aria-describedby="addon-wrapping"><br>
                                <script>
                                    $(document).ready(function() {
                                        // Call the function when the page loads
                                        computePayrollTWD();

                                        // Call the function when the user changes the start date or end date
                                        $('#payroll_start_date, #payroll_end_date').change(function() {
                                            computePayrollTWD();
                                        });
                                    });

                                    function computePayrollTWD() {
                                        var startDate = new Date($('#payroll_start_date').val());
                                        var endDate = new Date($('#payroll_end_date').val());

                                        // Calculate the difference in milliseconds between the two dates
                                        var timeDifference = endDate.getTime() - startDate.getTime();

                                        // Convert milliseconds to days and round to two decimal places
                                        var totalWorkingDays = Math.round(timeDifference / (1000 * 3600 * 24));

                                        // Set the computed value to the payroll_twd field
                                        $('#payroll_twd').val(totalWorkingDays);
                                    }
                                </script>


                                <strong><span>Payroll Income</span></strong><br><br>
                                <input type="text" class="form-control" placeholder="Manually type the income here for modification" id="payroll_income" name="payroll_income" aria-describedby="addon-wrapping"><br>


                                &nbsp;<strong><span>Payroll Deduction</span></strong><br>
                                <br><input type="text" class="form-control" placeholder="Type here" id="payroll_deduction" name="payroll_deduction" aria-describedby="addon-wrapping"><br>

                                &nbsp;<strong><span>Payroll TWD</span></strong><br>
                                <br><input type="text" class="form-control" placeholder="Type here" id="payroll_twd" name="payroll_twd" aria-describedby="addon-wrapping" readonly><br>

                                &nbsp;<strong><span>Payroll Total</span></strong><br>
                                <br><input type="text" class="form-control" placeholder="Type here" id="payroll_total" name="payroll_total" aria-describedby="addon-wrapping" readonly><br>


                                <!-- Button trigger for saving modal -->
                                <i class="fa-solid fa-check" style="color: #ffffff;"><button type="button" class="btn btn-success" data-toggle="modal" data-target="#exampleModalCenter" id="buttonSAVE" name="buttonSAVE" style="background-color: #2468a0; margin-left: -15px"></i>
                                Save
                                </button>&nbsp;
                                <a href="Payroll_list.php"><button type="button" class="btn btn-warning" data-toggle="modal" data-target="#exampleModalCenter" id="btnClose" name="btnClose" style=" margin-left: 5px"><i class="fa-solid fa-delete-left" style="color: #000000"></i>
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
                                                &nbsp;&nbsp;New Payroll Added!. Thank you.
                                            </div>
                                            <div class="modal-footer">
                                                <a href="Payroll_list.php?"><button type="button" class="btn btn-success" data-dismiss="modal">Done</button></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <!-- JavaScript code for calculating total payroll -->
                <!-- JavaScript code for calculating total payroll -->
                <script>
                    $(document).ready(function() {
                        // Call the function when the page loads
                        calculateTotalPayroll();

                        // Call the function when the user changes the daily income
                        $('#payroll_income').on('input', function() {
                            calculateTotalPayroll();
                        });

                        // Call the function when the user changes the total working days
                        $('#payroll_twd').on('input', function() {
                            calculateTotalPayroll();
                        });

                        // Call the function when the user changes the deduction
                        $('#payroll_deduction').on('input', function() {
                            calculateTotalPayroll();
                        });
                    });

                    function calculateTotalPayroll() {
                        // Get the values of payroll income (daily income), payroll TWD (total working days), and payroll deduction
                        var income = parseFloat($('#payroll_income').val());
                        var twd = parseFloat($('#payroll_twd').val());
                        var deduction = parseFloat($('#payroll_deduction').val());

                        // Calculate the new total payroll by multiplying the daily income with total working days and then subtracting the deduction
                        var newTotal = (income * twd) - deduction;

                        // Update the value of payroll total
                        $('#payroll_total').val(isNaN(newTotal) ? 'Automated Label' : newTotal);
                    }
                </script>

                <!-- Include jQuery -->
                <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
                <!-- Include your additional JavaScript files -->
                <script src="Payroll/PayrollJS.js"></script>
                <script src="Payroll/updatePAYROLL.js"></script>