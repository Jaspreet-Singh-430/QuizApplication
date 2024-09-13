<?php
include("connection.php");

date_default_timezone_set("Asia/Kolkata");
$hid=$_POST['hid'];
$qname = $_POST['qname'];
$time=$_POST['time'];
$schedule = $_POST['datetime'];
$fees=$_POST['fees'];
$due=$_POST['due'];
echo $hid."<br>";
echo $fees."<br>";
echo $time;
$upd="update event set quiz_name='$qname', Date_of_Contest='$schedule',Time_limit='$time',Registration_Fees='$fees',Last_Date='$due' where ser_no='$hid'";
mysqli_query($conn, $upd);
echo "<script>alert('event parameters have been updated')</script>";
$sel="select * from registered_candidates where event_name='$qname'";
        $data = mysqli_query($conn, $sel);
        $rec=mysqli_fetch_array($data);
        while($rec=mysqli_fetch_array($data)) {
        
        $from ="jaspreet9322@gmail.com";
$to=$rec[2];
// echo $_SESSION['email'];
$headers="From:" .$from;
$subject="Schedule changed for $qname event";
$message= "Dear candidates You are all informed that the $qname event schedule has been modified as: <br>
<b>Date of Contest: </b> $schedule <br>
<b>Time Limit: </b> $time <br>
<b>Last Date of registration: </b> $due" ;
if(mail($to,$subject,$message,$headers)) {
 echo "mail sent successfully";   
}
else 
echo("mail send failed");
}
header("location:manageEvents.php");
?>