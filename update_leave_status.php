
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
session_start();
include "DBConnection.php";
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

function sendInfobipSMS($number, $message) {
    $base_url = "https://l3l6n5.api.infobip.com";
    $api_key = "b7e5bb75e1114f7830c8492e2327b96f-03078fe6-a6f5-41e5-94b3-ea6997956ffd";

    // Set up configuration
    $configuration = new Configuration(host: $base_url, apiKey: $api_key);
    
    // Initialize SMS API
    $api = new SmsApi(config: $configuration);

    // Define destination number
    $destination = new SmsDestination(to: $number);

    // Construct SMS message
    $smsMessage = new SmsTextualMessage(
        destinations: [$destination],
        text: $message,
        from: "YourSenderID" // Replace this with your sender ID
    );

    // Construct SMS request
    $request = new SmsAdvancedTextualRequest(messages: [$smsMessage]);

    try {
        // Send SMS message
        $response = $api->sendSmsMessage($request);
        
        // Handle response
        if ($response->getMessages()[0]->getStatus()->getGroupId() == 1) {

          echo "<script>
          document.addEventListener('DOMContentLoaded', function () {
              Swal.fire({
                  icon: 'success',
                  title: ' okay na boss.',
                  showConfirmButton: false,
                  timer: 1500
              }).then(() => {
                  window.location.href = 'Leave_app_list.php'; 
              });
          });
        </script>";

            
        } else {
            return "Failed to send message: " . $response->getMessages()[0]->getStatus()->getDescription();
        }
    } catch (\Exception $e) {
        return "Error: " . $e->getMessage();
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['accept'])) {
        $la_id = $_POST['la_id'];
        $approved_by = $_POST['s_em_id'];
        $lt_id = $_POST['lt_id']; 
        $ako = $_POST['s_em_id'];

        $em_id_query = "SELECT em_id, la_date_start, la_date_end FROM leave_application WHERE la_id = '$la_id'";
        $result = mysqli_query($conn, $em_id_query);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $approved_by = $row['em_id'];
            $la_date_start = $row['la_date_start'];
            $la_date_end = $row['la_date_end'];

            // Check if leave dates overlap with current date update the employee status to "On Leave"
            $current_date = date("Y-m-d");
            if ($current_date >= $la_date_start && $current_date <= $la_date_end) {
                $update_employee_status_query = "UPDATE employee SET employee_status = 'On Leave' WHERE em_id = '$approved_by'";
                if (!mysqli_query($conn, $update_employee_status_query)) {
                    echo "Error updating employee status: " . mysqli_error($conn);
                    exit;
                }
            }
        } else {
            echo "Error retrieving em_id and leave dates from leave_application: " . mysqli_error($conn);
            exit; 
        }

        $query = "UPDATE leave_application SET la_status = 'Accepted', la_approved_by = '$approved_by' WHERE la_id = '$la_id'";

        if (mysqli_query($conn, $query)) {
            // Deduct leave credits only when the leave application is accepted
            $deduct_query = "UPDATE employee_leave_credits SET available_credits = available_credits - 1 WHERE em_id = '$approved_by' AND lt_id = '$lt_id'";
            if (mysqli_query($conn, $deduct_query)) {
                // Send SMS notification
                $em_id_query = "SELECT em_phone FROM employee WHERE em_id = '$ako'";
                $result = mysqli_query($conn, $em_id_query);
                if ($result && mysqli_num_rows($result) > 0) {
                    $row = mysqli_fetch_assoc($result);
                    $em_phone = $row['em_phone'];
                    $recipientNumber = $em_phone; // Replace this with the recipient's phone number
                    $message = "Your leave application has been accepted."; // Customize your message
                    $status = sendInfobipSMS($recipientNumber, $message);
                    echo $status; // Print the status of SMS sending
                }
            } else {
                echo "Error deducting leave credits: " . mysqli_error($conn);
            }
        } else {
            echo "Error updating leave application status: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['decline'])) {
        $la_id = $_POST['la_id'];
        $ako = $_POST['s_em_id'];

        // Update leave application status to Declined
        $query = "UPDATE leave_application SET la_status = 'Declined' WHERE la_id = '$la_id'";

        if (mysqli_query($conn, $query)) {
            // Send SMS notification
            $em_id_query = "SELECT em_phone FROM employee WHERE em_id = '$ako'";
            $result = mysqli_query($conn, $em_id_query);
            if ($result && mysqli_num_rows($result) > 0) {
                $row = mysqli_fetch_assoc($result);
                $em_phone = $row['em_phone'];
                $recipientNumber = $em_phone; // Replace this with the recipient's phone number
                $message = "Your leave application has been declined."; // Customize your message
                $status = sendInfobipSMS($recipientNumber, $message);
                echo $status; // Print the status of SMS sending
            }
        } else {
            echo "Error updating leave application status: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['cancel'])) { 
        $la_id = $_POST['la_id'];

        // Update leave application status to Cancelled
        $query = "UPDATE leave_application SET la_status = 'Cancelled' WHERE la_id = '$la_id'";

        if (mysqli_query($conn, $query)) {
            // Send SMS notification
            $message = "Your leave application has been cancelled."; // Customize your message
            $status = sendInfobipSMS($recipientNumber, $message);
            echo $status; // Print the status of SMS sending

            // Redirect after processing
            header("Location: Leave_app_list.php");
            exit;
        } else {
            echo "Error updating leave application status: " . mysqli_error($conn);
        }
    }
}
?>
