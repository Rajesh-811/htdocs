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
    // SMTP Config
    $mail->isSMTP();
    $mail->Host       = 'smtp.gmail.com';
    $mail->SMTPAuth   = true;
    $mail->Username   = 'infonovangokkr@gmail.com';      // 🔁 Replace with your Gmail
    $mail->Password   = 'kwre rbdi ccpl uici';         // 🔁 App password from Google
    $mail->SMTPSecure = 'tls';
    $mail->Port       = 587;

    // Email content
    $mail->setFrom($email, $name);
    $mail->addAddress('infonovangokkr@gmail.com');       // 🔁 Same as above (receiving address)
    $mail->Subject = $subject;
    $mail->Body    = "From: $name\n\n E-mail <$email>\n\n$message";

    $mail->send();
    // echo "Message sent successfully!";
    echo "OK";

  } catch (Exception $e) {
    // echo "Message could not be sent. Error: {$mail->ErrorInfo}";
  }
}
?>
