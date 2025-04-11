<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/PHPMailer.php';
require 'PHPMailer/SMTP.php';
require 'PHPMailer/Exception.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $name    = htmlspecialchars($_POST['name']);
  $email   = filter_var($_POST['email'], FILTER_SANITIZE_EMAIL);
  $subject = htmlspecialchars($_POST['subject']);
  $message = htmlspecialchars($_POST['message']);

  $mail = new PHPMailer(true);

  try {
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'infonovangokkr@gmail.com';
    $mail->Password   = 'kwre rbdi ccpl uici';
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    $mail->setFrom($email, $name);
    $mail->addAddress('infonovangokkr@gmail.com');
    $mail->Subject = $subject;
    $mail->Body    = "From: $name\n\nE-mail: <$email>\n\n$message";

    $mail->send();
    echo "OK"; // This is what your JS checks for
  } catch (Exception $e) {
    echo "Message could not be sent. Error: {$mail->ErrorInfo}";
  }
}
?>
