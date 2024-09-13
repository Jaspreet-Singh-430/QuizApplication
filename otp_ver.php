<?php
include("connection.php");
?>
<?php
session_start();
$otp=rand(100000,999999);
$_SESSION['otp']=$otp;
$from ="jaspreet9322@gmail.com";
$to=$_SESSION['email'];
// echo $_SESSION['email'];
$headers="From:" .$from;
$subject="verify-account-otp";
$user=$_SESSION['fname'];
$message= "Dear $user Your OTP number is $otp";
if(mail($to,$subject,$message,$headers)) {
header("location:otp.php");    
}
else 
echo("mail send failed");
?>
