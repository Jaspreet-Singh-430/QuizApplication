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
        
        $mail->Host       = $_ENV['HOST'];
        $mail->SMTPAuth   = true;
        $mail->Username   = $_ENV['USER_NAME'];
        $mail->Password   = $_ENV['PASSWORD']; // NOT normal password
        $mail->SMTPSecure = 'tls';
        $mail->Port       = $_ENV['PORT'];
        
        $mail->setFrom($_ENV['USER_NAME'], 'Quiz World');
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