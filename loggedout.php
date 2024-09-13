<?php
include("connection.php");
?>
<?php
session_start();
$user=$_SESSION['user'];
$eml=$_SESSION['em'];
echo $eml." ".$user;
echo "";
$upd="update badge_winner set badge_status='Pending' where email='$eml'";
mysqli_query($conn,$upd);
$del="delete from loggedin_users where email='$eml'";
$del1="delete from results where Candidate_email='$eml'";
$del2="delete from badge_winner where email='$eml'";
mysqli_query($conn, $del);
mysqli_query($conn, $del1);
mysqli_query($conn, $del2);
session_destroy();
header("location:userlogin.php");
?>