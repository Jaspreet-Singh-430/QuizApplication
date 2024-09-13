<?php
include("connection.php");
session_start();
$ques = $_POST['no_of_ques'];
$quizname = $_POST['quizname'];
$category = $_POST['category'];
$level = $_POST['level'];
$type = $_POST['type'];
$ttaken = $_POST['timetaken'];
$tt_per_q = $ttaken / $ques;
if ($type == 'Time Duration')
    $case = 1;
else if ($type == 'Time Slice')
    $case = 2;
else
    $case = 3;
$score = 0;
$correct = 0;
$incorrect = 0;
$unattended = 0;
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
$total = $ques * 4;
$perc = ($score / $total) * 100;
$date = date('d-m-Y h:i:s a');
$user = $_SESSION['user'];
$mail = $_SESSION['em'];
$accuracy = ($ques - $incorrect-$unattended) / $ques * 100;
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Results</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <div class="container mt-5">
        <!-- Result Header -->
        <div class="text-center">
            <h1 class="display-4">Quiz Results</h1>
            <p class="lead">Thank you for completing the quiz!</p>
        </div>

        <!-- Score Section -->
        <div class="card my-4">
            <div class="card-body text-center">
                <h2>Your Score is <?php echo $score; ?></h2>
                <p class="display-2 text-primary"><?php echo number_format($perc, 2) . '%'; ?></p>
                <p>You got :</p>
                <p><?php echo $correct; ?> out of <?php echo $ques; ?> questions correct.</p>
                <p><?php echo $incorrect; ?> out of <?php echo $ques; ?> questions incorrect.</p>
                <p><?php echo $unattended; ?> out of <?php echo $ques; ?> questions unattended.</p>
            </div>
        </div>

        <!-- Feedback Section -->
        <div class="alert alert-info text-center" role="alert">
            <p>
                <?php
                if ($perc >= 80) {
                    $comm = "excellent, you are really intelligent";
                    $grade = 'A+';
                } else if ($perc >= 70) {
                    $comm = "Nice job. Keep practising to achieve expertise";
                    $grade = 'A';
                } else if ($perc >= 55) {

                    $comm = "Well played. You can do more better";
                    $grade = "B";
                } else if ($perc >= 35) {

                    $comm = "Fair result. Still an amateur ";
                    $grade = "C";
                } else {
                    $grade = 'D';
                    $comm = "Poor result. Improve your self with hard work";
                }
                echo "<b>$comm</b>";
                if ($_SESSION['score'] < $score)
                    $_SESSION['score'] = $score;
                ?>
            </p>
            <p><?php echo "You got $grade grade." ?></p>
        </div>
        <?php
        $ins = "insert into results values('$user','$mail','$category','$quizname',$case,'$level',$score,$correct,$incorrect,$total,$perc,'$grade','$date')";
        mysqli_query($conn, $ins);
        ?>
        <hr>
        <div class="text-center ">
            <h2><img src="./images/analys.jpeg" width="200px" height="200px">Performance Analysis</h2>
            <button type="submit" class="btn btn-primary" form="statistics">View Analytics</button>
        </div>
        <hr>
        <!-- Detailed Results Table -->
        <div class="card my-4">
            <div class="card-header">
                <h3>Detailed Results</h3>
            </div>
            <form action="statistics.php" method="post" id="statistics">
                <input type="text" name="correct" value="<?php echo $correct; ?>">
                <input type="text" name="wrong" value="<?php echo $incorrect; ?>">
                <input type="text" name="unattended" value="<?php echo $unattended; ?>">
                <input type="text" name="score" value="<?php echo $score; ?>">
                <input type="text" name="total" value="<?php echo $total; ?>">
                <input type="text" name="ttaken" value="<?php echo $tt_per_q; ?>">
                <input type="text" name="accuracy" value="<?php echo $accuracy; ?>">
            </form>
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Question No.</th>
                            <th>Question</th>
                            <th>Your Answer</th>
                            <th>Correct Answer</th>
                            <th>Result</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        for ($i = 0; $i < $ques; $i++) {
                            ?>
                            <tr>
                                <td><?php echo $i; ?></td>
                                <td><?php echo $_POST['que' . $i]; ?></td>
                                <td><?php echo @$_POST['options-outlined' . $i]; ?></td>
                                <td><?php echo $_POST['corr' . $i]; ?></td>
                                <td><span class="<?php if (@$_POST['options-outlined' . $i] == @$_POST['corr' . $i])
                                    echo 'badge bg-success';
                                else if (@$_POST['options-outlined' . $i] == '')
                                    echo 'badge bg-warning';
                                else
                                    echo 'badge bg-danger';
                                ?>"><?php
                                if (@$_POST['options-outlined' . $i] == @$_POST['corr' . $i])
                                    echo 'Correct';
                                else if (@$_POST['options-outlined' . $i] == '')
                                    echo 'Unattempted';
                                else
                                    echo 'Wrong';
                                ?></span></td>
                            </tr>
                            <?php
                        }
                        ?>
                        <!-- More rows as needed -->
                    </tbody>
                </table>
            </div>
        </div>
        <?php
        if ($_SESSION['score'] >= 600) {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='6Xscorer' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
                echo "<script>
            alert('Congratulations, You have won <b>6Xscorer badge.</b>')
            </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='6Xscorer'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
            
        } else if ($_SESSION["score"] >= 400) {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='4Xscorer' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            echo "<script>
             alert('Congratulations, You have won <b>4Xscorer badge.</b>')
             </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='4Xscorer'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        } else if ($_SESSION["score"] >= 200) {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='4Xscorer' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            echo "<script>
              alert('Congratulations, You have won <b>2Xscorer badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='2Xscorer'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        } else if ($_POST['islifeUsed'] == 0 && ($level == 'easy' || $level == 'medium')) {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='champ' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            echo "<script>
              alert('Congratulations, You have won <b>Champ badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='champ'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;  
        } 
        if ($_POST['islifeUsed'] == 0 && $level == 'hard') {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='superchamp' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
                echo "<script>
              alert('Congratulations, You have won <b>SuperChamp badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='superchamp'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        }
        } else if ($perc >= 70 && $level == 'medium') {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='grademaster' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            echo "<script>
              alert('Congratulations, You have won <b>GradeMaster badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='grademaster'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        } else if ($perc >= 70 && $level == 'hard') {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='gradeseniormaster' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
                echo "<script>
              alert('Congratulations, You have won <b>GradeSeniorMaster badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='gradeseniormaster'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
            
        } else if ($_POST['islifeLost'] == 0 && $perc > 60 && $type == 'No of lives') {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='liferounder' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            echo "<script>
              alert('Congratulations, You have won <b>LifeRounder badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='liferounder'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        } else if ($perc >= 65 && $level == "medium" && $type == 'No of lives' && $_POST['islifeLost'] <= 1) {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='ultrasurviver' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
        else
        {
            echo "<script>
              alert('Congratulations, You have won <b>UltraSurviver badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='ultrasurviver'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
        }
            
        } else if ($perc >= 65 && $level == "hard" && $type == 'No of lives' && $_POST['islifeLost'] <= 2) {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='megasurviver' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            echo "<script>
              alert('Congratulations, You have won <b>MegaSurviver badge.</b>')
              </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='megasurviver'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        }
        if ($type == 'Time Duration') {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='meritorious' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            $selEasy = "select * from results where percentage>60 AND difficulty='easy' AND Quiz_Type=1 AND Candidate_email='$mail'";
            $selMed = "select * from results where percentage>60 AND difficulty='medium' AND Quiz_Type=1 AND Candidate_email='$mail'";
            $selHard = "select * from results where percentage>60 AND difficulty='hard' AND Quiz_Type=1 AND Candidate_email='$mail'";
            if (mysqli_num_rows(mysqli_query($conn, $selEasy)) != 0 && mysqli_num_rows(mysqli_query($conn, $selMed)) != 0 && mysqli_num_rows(mysqli_query($conn, $selHard)) != 0) {
                echo "<script>
         alert('Congratulations, You have won <b>Meritorious badge.</b>')
          </script>";
                $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        }
    }
        $selc="select badge_status from badge_winner where email='$mail' AND badge_title='multitaker' AND badge_status='won'";
        $datac=mysqli_query($conn,$selc);
        if(mysqli_num_rows($datac)>0)
        ;
        else
        {
            $selWin = "select DISTINCT category from results where Quiz_Type=1 AND Difficulty='easy' AND Grade='A+'";
            if (mysqli_num_rows(mysqli_query($conn, $selWin))) {
                echo "<script>
         alert('Congratulations, You have won <b>MultiTaker badge.</b>')
          </script>";
                $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='multitaker'";
                mysqli_query($conn, $upd);
                $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        }
        if ($type == 'Time Slice') {
            $selb="select badge_status from badge_winner where email='$mail' AND badge_title='speedster' AND badge_status='won'";
            $datab=mysqli_query($conn,$selb);
            if(mysqli_num_rows($datab)>0)
            ;
            else
            {
            $selEasy = "select * from results where percentage>60 AND difficulty='easy' AND Quiz_Type=2 AND Candidate_email='$mail'";
            $selMed = "select * from results where percentage>60 AND difficulty='medium' AND Quiz_Type=2 AND Candidate_email='$mail'";
            $selHard = "select * from results where percentage>60 AND difficulty='hard' AND Quiz_Type=2 AND Candidate_email='$mail'";
            if (mysqli_num_rows(mysqli_query($conn, $selEasy)) != 0 && mysqli_num_rows(mysqli_query($conn, $selMed)) != 0 && mysqli_num_rows(mysqli_query($conn, $selHard)) != 0)
                echo "<script>
         alert('Congratulations, You have won <b>Speedster badge.</b>')
          </script>";
            $upd = "update badge_winner set badge_status='won' where email='$mail' AND badge_title='speedster'";
            mysqli_query($conn, $upd);
            $_SESSION['badge'] = $_SESSION['badge'] + 1;
            }
        }
        ?>
        <!-- Action Buttons -->
        <div class="text-center">
            <a href="quizplay.php" class="btn btn-primary">Retake Quiz</a>
            <a href="dashboard.html" class="btn btn-secondary">Back to Dashboard</a>
        </div>
    </div>
    <?php

    ?>
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>