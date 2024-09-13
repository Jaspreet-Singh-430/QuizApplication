<?php
include("connection.php");
$ques = $_POST['no_of_ques'];
$event = $_POST['evname'];
$cname=$_POST['cname'];
$cmail=$_POST['cmail'];
$score = 0;
$correct = 0;
$incorrect = 0;
$unattended = 0;
$total=$ques*4;
for ($i = 0; $i < $ques; $i++) {
    if (@$_POST['options-outlined' . $i] == @$_POST['corr' . $i]) {
        $correct++;
        $score += 4;
    } else if (@$_POST['options-outlined' . $i] == '')
        $unattended++;
    else {
        $incorrect++;
        $score -= 1;
    }
}
$ins="insert into leaderboard values('$cname','$cmail','$event','$score','','')";
mysqli_query($conn,$ins);
?>
<?php
$sel="select * from leaderboard where event='$event'";
$data = mysqli_query($conn, $sel);
$rec=mysqli_fetch_array($data);
while($rec=mysqli_fetch_array($data)) {

$from ="jaspreet9322@gmail.com";
$to=$rec[1];
// echo $_SESSION['email'];
$headers="From:" .$from;
$subject="Result of $qname event";
$message= "Dear $rec[0], Your score is $score out of $total <br>Best regards from Quiz World";
if(mail($to,$subject,$message,$headers)) {
echo "mail sent successfully";   
}
else 
echo("mail send failed");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Thank You for Participating</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
        /* background:black; */
    }
  </style>
</head>
<body>
  <div class="container text-center" style="margin-top: 100px;">
    <div class="card">
      <div class="card-body">
        <h1 class="display-4">Thank You!</h1>
        <p class="lead">We appreciate your participation in the quiz.</p>
        <p>Your performance is valuable to us, and we hope you enjoyed the experience.</p>
        <p><b>Your result has been sent to your email.</b></p>
        <a href="dashboard.php" class="btn btn-primary">Go Back to Dashboard</a>
      </div>
    </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
