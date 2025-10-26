<?php
session_start();
unset($_SESSION['otp']);
header("location:../Registration/OTP/otp_verify.php?a=1");
?>