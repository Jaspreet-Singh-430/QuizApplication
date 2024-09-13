<?php
include("connection.php");
if(isset($_POST["id"])) {
$id=$_POST['id'];
$fname=$_POST['fname'];
$lname=$_POST['lname'];
$eml=$_POST['eml'];
$pwd=$_POST['pwd'];
$cont=$_POST['cont'];
$hid=$_POST['hid'];
$upd="update participants set userId='$id', Firstname='$fname',Lastname='$lname',Email='$eml',
Password='$pwd',Contact='$cont' WHERE userId='$hid'";
mysqli_query($conn,$upd);
header("location:users.php");
}
?>
<?php
if(isset($_POST["hidName"])) {
$hid=$_POST['hidName'];
$life=$_POST['life'];
$slice=$_POST['slice'];
$time=$_POST['time'];
$date=date('Y-m-d H:i:s');
$qname=$_POST['qname'];
$noq=$_POST['noq'];
$upd="update quiz set quiz_name='$qname', no_of_questions='$noq',Date_Created='$date',Time='$time',time_slice='$slice',lives='$life' WHERE quiz_name='$hid'";
mysqli_query($conn,$upd);
header("location:adminDashboard.php");
}
?>