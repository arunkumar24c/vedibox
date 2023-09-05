<?php
//require_once 'PHPMailer/vendor/phpmailer/phpmailer/src/PHPMailer.php';
//require_once 'PHPMailer/vendor/phpmailer/phpmailer/src/SMTP.php';
//require_once 'PHPMailer/vendor/phpmailer/phpmailer/src/Exception.php';
// Import PHPMailer classes into the global namespace
// These must be at the top of your script, not inside a function
// use\PHPMailer\vendor\phpmailer\phpmailer\src\PHPMailer.php;
// use PHPMailer\vendor\phpmailer\src\SMTP;
// use PHPMailer\vendor\phpmailer\src\Exception;

// // Load Composer's autoloader
// //require 'vendor/autoload.php';
// require './PHPMailer/vendor/autoload.php';
// // require_once 'C:\xampp\htdocs\working\PhpEmail\PHPMailer\vendor\autoload.php';
// // Instantiation and passing `true` enables exceptions
// $mail = new PHPMailer(true);

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;


require 'library\composer\vendor\autoload.php';
// require 'PHPMailer/vendor/phpmailer/src/Exception.php';
// require 'PHPMailer/vendor/phpmailer/src/PHPMailer.php';
// require 'PHPMailer/vendor/phpmailer/src/SMTP.php';
/* Exception class. */
require 'library\composer\vendor\phpmailer\phpmailer\src\Exception.php';

/* The main PHPMailer class. */
require 'library\composer\vendor\phpmailer\phpmailer\src\PHPMailer.php';

/* SMTP class, needed if you want to use SMTP. */
require 'library\composer\vendor\phpmailer\phpmailer\src\SMTP.php';

require 'PHPMailerAutoload.php';

$mail = new PHPMailer();
try {
    //Server settings
    $mail->SMTPDebug = 0;// Enable verbose debug output
    $mail->isSMTP();                                            // Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                    // Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
    $mail->Username   = 'sivakumar.smilemobility@gmail.com';                     // SMTP username
    $mail->Password   = 'Sivakumar@20';                               // SMTP password
    $mail->SMTPSecure = 'tls';         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
    $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above

    //Recipients
  
    $mail->setFrom('sivakumar.smilemobility@gmail.com', 'Mailer');
    $mail->addAddress('balusiva1299@gmail.com', 'Joe User');     // Add a recipient
    $mail->addAddress('balusiva1299@gmail.com');               // Name is optional
    $mail->addReplyTo('info@example.com', 'Information');
    $mail->addCC('cc@example.com');
    $mail->addBCC('bcc@example.com');

    // // Attachments
    // $mail->addAttachment('C:\xampp\htdocs\working\PhpEmail\image.jpeg');         // Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    // Optional name

    // Content
    $mail->isHTML(true);                                  // Set email format to HTML
    $mail->Subject = 'Here is the subject';
    $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
    $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}