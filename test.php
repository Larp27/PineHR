<?php
use Infobip\Configuration;
use Infobip\Api\SmsApi;
use Infobip\Model\SmsDestination;
use Infobip\Model\SmsTextualMessage;
use Infobip\Model\SmsAdvancedTextualRequest;

require __DIR__ . "/vendor/autoload.php";

function sendInfobipSMS($number, $message) {
  $base_url = "https://9lxgdd.api.infobip.com";
  $api_key = "79e987825a231d71ba43c87d0c18832d-2ae83074-b9f3-4dbd-ba5b-cabc608f27df";

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
            echo "Message sent successfully.";
        } else {
            echo "Failed to send message: " . $response->getMessages()[0]->getStatus()->getDescription();
        }
    } catch (\Exception $e) {
        echo "Error: " . $e->getMessage();
    }
}

// Example usage:
$recipientNumber = "+639927816081"; // Replace this with the recipient's phone number
$message = "Hello, this is a test message."; // Replace this with your message
sendInfobipSMS($recipientNumber, $message);
?>
