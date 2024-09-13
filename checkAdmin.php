<?php
include("connection.php");
$user = $_POST['adminUser'];
$pwd = $_POST['adminPwd'];
if ($user == 'admin' && $pwd == '123')
    header("location:adminDashboard.php?a=$user&b=$pwd");
else {
    $mess = "Admin credentials are incorrect. Admin login Failed";
    header("location:adminLogin.php?mess=$mess");
}
?>