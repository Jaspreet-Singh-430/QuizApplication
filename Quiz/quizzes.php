<?php
include("../connection.php");
$qname = $_POST['qname'];
$category = $_POST['category'];
$level = $_POST['level'];
$time = $_POST['time'] . " minutes";
$slice = $_POST['time_slice'] . " seconds";
$lives = $_POST['lives'];
$count = $_POST['questions'];
$date = date('y/m/d h:i:s:a');
$ins1 = "insert into quiz values('$qname','$count','$level','$category','$time','$slice','$lives','$date')";
mysqli_query($conn, $ins1);
header("location:createQuizes.php?succ=1")
    ?>