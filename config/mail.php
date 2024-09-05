<?php
require __DIR__ . '/../vendor/autoload.php'; // Adjust the path as necessary

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;
use Brevo\Client\Model\SendSmtpEmail;

// Brevo configuration
$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// Initialize the Brevo API client
$apiInstance = new TransactionalEmailsApi(
    new GuzzleHttp\Client(),
    $config
);

function sendOtpEmail($email, $name, $otp) {
    global $apiInstance;

    $emailContent = [
        'to' => [['email' => $email, 'name' => $name]],
        'subject' => 'Your OTP Code',
        'htmlContent' => '<p>Your OTP code is: ' . $otp . '</p>',
    ];

    try {
        $result = $apiInstance->sendTransacEmail($emailContent);
        echo "OTP email sent successfully.";
    } catch (Exception $e) {
        echo "Failed to send OTP email: " . $e->getMessage();
    }
}
?>
