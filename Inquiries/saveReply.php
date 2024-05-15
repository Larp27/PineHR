<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<?php
	session_start();
	include "../DBConnection.php";

	use Infobip\Configuration;
	use Infobip\Api\SmsApi;
	use Infobip\Model\SmsDestination;
	use Infobip\Model\SmsTextualMessage;
	use Infobip\Model\SmsAdvancedTextualRequest;

	require_once '..\vendor\autoload.php';

	function sendInfobipSMS($number, $message)
	{
    $reload_url = '';
    if ($_SERVER['HTTP_HOST'] == 'localhost') {
			$reload_url = "http://localhost/PINEHR/Inquiries.php"; // Localhost URL
    } else {
			$reload_url = "https://pinesolutions.com/Inquiries.php"; // GoDaddy hosting URL
    }

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
			from: "PINEHR"
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
							title: ' SMS SENT TO THE USER.',
							showConfirmButton: false,
							timer: 1500
						}).then(() => {
							window.location.href = '$reload_url';
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
		$inq_id = $_POST['inq_id'];
		$reply_message = $_POST['inq_reply'];

		$sql = "UPDATE inquiries SET inq_status = 'Answered', inq_reply = '$reply_message' WHERE inq_id = '$inq_id'";
		$result = mysqli_query($conn, $sql);

		if ($result) {
			// Retrieve contact number from the database
			$query = "SELECT inq_number FROM inquiries WHERE inq_id = '$inq_id'";
			$result = mysqli_query($conn, $query);

			if ($result && mysqli_num_rows($result) > 0) {
				$row = mysqli_fetch_assoc($result);
				$phone_number = $row['inq_number'];

				// Send SMS using Infobip if successfully updated on the database
				$inquiry_info = "Thank you for your inquiry. We have reviewed it and here is our response:\n\n$reply_message";
				$responseStatus = sendInfobipSMS($phone_number, $inquiry_info);

				if ($responseStatus !== false) {
					echo "SMS sent successfully.";
				} else {
					echo "Failed to send SMS: " . $responseStatus;
				}
			} else {
				echo "Error: Failed to retrieve contact number from the database." . $inq_id;
			}
		}
	}
?>