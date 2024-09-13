<?php
include("connection.php");
session_start();
$id = $_SESSION['orderId'];
$a = $_GET['a'];
$upd = "update event set Status='$a' where order_id='$id'";
mysqli_query($conn, $upd);
header("location:usersideEvents.php?st=1&st2=1&st3=1");
?>