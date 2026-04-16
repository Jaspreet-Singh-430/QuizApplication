<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
require 'vendor/autoload.php';
include("../../connection.php");
?>
<?php
session_start();
$otp = rand(100000, 999999);
$_SESSION['otp'] = $otp;
$from = "jaspreet9322@gmail.com";
$to = $_SESSION['email'];
// echo $_SESSION['email'];
$headers = "From:" . $from;
$subject = "verify-account-otp";
$user = $_SESSION['fname'];
$message = "Dear $user Your OTP number is $otp";
// if (mail($to, $subject, $message, $headers)) {
    // } else
    //     echo ("mail send failed");
    $mail = new PHPMailer(true);
    try {
        $mail->isSMTP();
        $mail->Host       = 'smtp.gmail.com';
        $mail->SMTPAuth   = true;
        $mail->Username   = 'jaspreet9322@gmail.com';
        $mail->Password   = 'jneg phae blqx dazt'; // NOT normal password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = 587;
        
        $mail->setFrom('jaspreet9322@gmail.com', 'Quiz World');
        $mail->addAddress($to);
        
        $mail->isHTML(true);
        $mail->Subject = $subject;
        $mail->Body    = $message;
        
        $mail->send();
        echo 'Message sent';
        header("location:otp_verify.php");
} catch (Exception $e) {
    echo "Error: {$mail->ErrorInfo}";
}
?>