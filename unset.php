<?php
session_start();
unset($_SESSION['otp']);
header("location:otp.php?a=1");
?>
