<?php
include("connection.php");
if(isset($_POST["id"])) {
$id=$_POST['id'];
$del="delete from participants where userId='$id'";
mysqli_query($conn,$del);
header("location:users.php");
}
?>
<?php
if(isset($_POST["hidname"])) {
$hid=$_POST['hidName'];
$del="delete from quiz where quiz_name='$hid'";
mysqli_query($conn,$del);
header("location:adminDashboard.php");
}
?>