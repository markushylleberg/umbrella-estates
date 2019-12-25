<?php

    $newUserName = $_GET['name'];
    $newUserId = $_GET['key'];
    $newUserEmail = $_GET['email'];
    $newUserActivationKey = $_GET['activationkey'];
    $newSignupType = $_GET['type'];

// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Load Composer's autoloader
require 'src/PHPMailer.php';
require 'src/Exception.php';
require 'src/SMTP.php';

// Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

try {
    //Server settings
    $mail->SMTPDebug = 2;                                       // Enable verbose debug output
    $mail->isSMTP();                                            // Set mailer to use SMTP
    $mail->Host       = 'smtp.gmail.com';                       // Specify main and backup SMTP servers
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'marktestmailmark@gmail.com';           // SMTP username
    $mail->Password   = 'Mackh123';                             // SMTP password
    $mail->SMTPSecure = 'tls';                                  // Enable TLS encryption, `ssl` also accepted
    $mail->Port       = 587;                                    // TCP port to connect to

    //Recipients
    $mail->setFrom('marktestmailmark@gmail.com', 'TEST MAIL');
    $mail->addAddress("$newUserEmail", 'KEA');     // Add a recipient
    // $mail->addAddress('ellen@example.com');               // Name is optional
    // $mail->addReplyTo('info@example.com', 'Information');
    // $mail->addCC('cc@example.com');
    // $mail->addBCC('bcc@example.com');

    // Attachments
    // $mail->addAttachment('/var/tmp/file.tar.gz');         // Add attachments
    // $mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name
    $sPath = "http://localhost:8888/5.%20semester/exam-project/api-activate-account.php?id=$newUserId&key=$newUserActivationKey&name=$newUserName&type=$newSignupType";
    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = "Welcome $newUserName! Please verify your account";
    $mail->Body    = '<b>Welcome</b> <br> <a href="'.$sPath.'">Click here to verify your account</a>';
    // $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
    header('Location: welcome.php');
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    header('Location: index.php');
}