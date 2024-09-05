<?php
// config/mail.php

require 'vendor/autoload.php'; // Ensure Brevo SDK is installed via Composer

use Brevo\Client\ApiException;
use Brevo\Client\Api\TransactionalEmailsApi;
use Brevo\Client\Model\SendSmtpEmail;
use Brevo\Client\Configuration;
use Brevo\Client\ApiClient;

function sendOtpEmail($email, $otp) {
    $apiKey = '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'; // Replace with your Brevo API key

    $config = Configuration::getDefaultConfiguration()->setApiKey('api-key', $apiKey);
    $apiInstance = new TransactionalEmailsApi(
        new ApiClient($config)
    );

    $sendSmtpEmail = new SendSmtpEmail([
        'to' => [['email' => $email]],
        'subject' => 'Your OTP Code',
        'htmlContent' => "<p>Your OTP code is: <b>$otp</b></p>",
        'sender' => ['email' => 'your-email@example.com'] // Your sender email
    ]);

    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        echo "Email sent successfully!";
    } catch (ApiException $e) {
        echo "Error sending email: ", $e->getMessage();
    }
}
?>
