<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require 'phpmailer/vendor/autoload.php'; // PHPMailer


// Setup mailer
$mail = new PHPMailer(true);


    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'abd.albasaleh.123@gmail.com'; // Your Gmail
    $mail->Password = 'khxy wcaq dzsk uglo';    // App password from Google
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;
    // Content
    $mail->isHTML(true);
    $mail->CharSet = "UTF-8"; 


 ?>

