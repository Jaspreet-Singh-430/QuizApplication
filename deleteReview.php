<?php
include("connection.php");
$em=$_GET['em'];
$del="delete from feedback where email='$em'";
mysqli_query($conn, $del);
header("location:adminDashboard.php?a=admin&b=123");
?>