<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email   = htmlspecialchars($_POST['email']);
  $subject = "New Subscription";

  $mail = new PHPMailer(true);

  try {
    // SMTP Config
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'infonovangokkr@gmail.com';
    $mail->Password   = 'kwre rbdi ccpl uici';  // App password
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Email content
    $mail->setFrom($email, "Subscriber");
    $mail->addAddress('infonovangokkr@gmail.com');
    $mail->Subject = $subject;
    $mail->Body    = "New subscription: <$email>";

    $mail->send();
    echo "OK";

  } catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
  }
}
?>
