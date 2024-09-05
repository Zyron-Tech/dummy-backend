<?php
// config/mail.php

require __DIR__ . '/../vendor/autoload.php';  // Ensure this path correctly points to your autoload.php

use SendinBlue\Client\Configuration;
use SendinBlue\Client\Api\TransactionalEmailsApi;
use GuzzleHttp\Client;
use SendinBlue\Client\Model\SendSmtpEmail;

// Configure API key authorization: api-key
$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// Create an instance of the API client
$apiInstance = new TransactionalEmailsApi(
    new Client(),
    $config
);

/**
 * Function to send an OTP email
 *
 * @param string $toEmail The recipient's email address
 * @param string $toName The recipient's name
 * @param string $otp The OTP to send
 * @return bool
 */
function sendOtpEmail($toEmail, $toName, $otp)
{
    global $apiInstance;

    // Define the email content
    $email = new SendSmtpEmail([
        'subject' => 'Your OTP Code',
        'sender' => ['name' => 'Your Company', 'email' => 'yourcompany@example.com'],
        'to' => [['email' => $toEmail, 'name' => $toName]],
        'htmlContent' => "<h1>Your OTP Code</h1><p>Your OTP is <strong>$otp</strong>. Please use this to complete your registration.</p>"
    ]);

    try {
        // Send the email
        $result = $apiInstance->sendTransacEmail($email);
        return true;
    } catch (Exception $e) {
        // Log the error
        error_log('Exception when sending OTP email: ' . $e->getMessage());
        return false;
    }
}

if (sendOtpEmail($testEmail, $testName, $testOtp)) {
    echo 'OTP email sent successfully.';
} else {
    echo 'Failed to send OTP email.';
}
?>
