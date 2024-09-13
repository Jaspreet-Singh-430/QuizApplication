<?php
include("connection.php");

date_default_timezone_set("Asia/Kolkata");
$qname = $_POST['qname'];
$category = $_POST['category'];
$question = $_POST['questions'];
$schedule = $_POST['datetime'];
$incorrect = $_POST['options'];
$correct = $_POST['correct'];
print_r($correct);
print_r($incorrect);
$fees = $_POST['fees'];
$due = $_POST['due'];
echo $schedule;
$schedule1 = (int) $schedule;
$milsec = mktime($schedule1) - mktime((int) date("d/m/Y h:i:s:a"));
if ($milsec <= 0) {
    echo "<script>alert('Please enter date of future'</script>";
    sleep(3);
    header("location:createEvents.php");
}
$time = $_POST['time'] . " minutes";
$count = count($_POST['questions']);
$rand = "ORDER-" . rand(1000, 9999);
$ins1 = "insert into event values('','$qname','$schedule','$count','$category','$time','Unregistered','$fees','$due','$rand')";
mysqli_query($conn, $ins1);
for ($i = 0; $i < $count; $i++) {
    $ques = str_replace(array('"', "'"), '', substr($question[$i], 4));
    $inco = str_replace(array('"', "'"), '', substr($incorrect[$i], 4));
    $co = str_replace(array('"', "'"), '', substr($correct[$i], 4));
    echo $ques;
    $ins2 = "insert into questions values('$qname','$category','$ques','$co','$inco','$rand')";
    mysqli_query($conn, $ins2);
}
// header("location:createEvents.php?succ=1");
?>