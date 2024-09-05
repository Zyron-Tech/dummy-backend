<?php
require __DIR__ . '/../vendor/autoload.php';

use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Configuration;

// Your Brevo configuration
$config = Configuration::getDefaultConfiguration()->setApiKey('api-key', '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');

// Initialize the Brevo API client
$apiInstance = new TransactionalEmailsApi(
    new GuzzleHttp\Client(),
    $config
);

// Sample email variables (replace with actual values)
$testEmail = 'test@example.com'; // Replace with actual email
$testName = 'Test User'; // Replace with actual name
$testOtp = '123456'; // Replace with actual OTP

try {
    $result = $apiInstance->sendTransacEmail([
        'to' => [['email' => $testEmail, 'name' => $testName]],
        'subject' => 'Your OTP Code',
        'htmlContent' => '<p>Your OTP code is: ' . $testOtp . '</p>',
    ]);
    echo "OTP email sent successfully.";
} catch (Exception $e) {
    echo "Failed to send OTP email: " . $e->getMessage();
}
?>
