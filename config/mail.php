<?php
// config/mail.php

require 'vendor/autoload.php';

use SendinBlue\Client\Api\TransactionalEmailsApi;
use SendinBlue\Client\Configuration;
use GuzzleHttp\Client;


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
        'sender' => ['email' => 'mthwpeace@gmail.com'] // Your sender email
    ]);

    try {
        $result = $apiInstance->sendTransacEmail($sendSmtpEmail);
        echo "Email sent successfully!";
    } catch (ApiException $e) {
        echo "Error sending email: ", $e->getMessage();
    }
}
?>
