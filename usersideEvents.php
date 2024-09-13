<?php
include("connection.php");
date_default_timezone_set("Asia/Kolkata");
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Table Example</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="bg-warning p-3 fs-3 text-white"><i class="fa-solid fa-calendar-days fa-lg me-3"
            style="color: #ffffff;"></i><b>Events</b></nav>
    <div class="container">
        <h2 class="my-4">Upcoming Events and Contests</h2>
        <?php
        $sel = "select * from event";
        $data = mysqli_query($conn, $sel);
        if (mysqli_num_rows($data) != 0) {
            ?>
            <table id='table' class="table table-striped table-hover">
                <thead class="table-dark">
                    <tr>
                        <th scope="col">Event Name</th>
                        <th scope="col">Scheduled Date</th>
                        <th scope="col">Time Limit</th>
                        <th scope="col">Registration Fees</th>
                        <th scope="col">Last Date</th>
                        <th scope="col">Time Left</th>
                        <th scope="col">Status</th>
                        <th scope="col">Start in</th>
                        <th scope="col">Register</th>
                        <th scope="col">End in</th>
                    </tr>
                </thead>
                <tbody>
                    <?php

                    while ($row = mysqli_fetch_array($data)) {
                        ?>
                        <tr>
                            <th scope="row"><?php echo $row[1]; ?></th>
                            <td><?php echo $row[2]; ?></td>
                            <td><?php echo $row[5]; ?></td>
                            <td><?php echo $row[7]; ?></td>
                            <td><?php echo $row[8]; ?></td>
                            <td id="left"></td>
                            <td><?php if ($row[6] == 'Registered')
                                echo "$row[6].&check;";
                            else
                                echo $row[6];
                            ?></td>
                            <td></td>
                            <td>
                                <a
                                    href="eventRegistration.php?name=<?php echo $row[1]; ?>&fee=<?php echo $row[7]; ?>&stat=<?php echo $row[6];?>&order=<?php echo $row[9];?>">Click
                                    to
                                    Register</a>
                            </td>
                            <td></td>
                        </tr>
                        <?php
                    }
                    ?>
                </tbody>
            </table>
            <?php
        } else {
            ?>
            <p>No events and contests are available now.</p>
            <i class="fa-solid fa-calendar-days fa-2xl me-3 mt-5" style="color:orange;font-size:80px;"></i>
            <?php
        }
        ?>

    </div>

    <!-- Bootstrap JS and dependencies (Optional) -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    <script>
        count=0;
        function expired()
        {
            location.href="statechange.php?a=expired"
        }
        function started()
        {
            location.href="statechange.php?a=Started"
        }
        function finished()
        {
            location.href="statechange.php?a=finished"
        }
        if (document.getElementsByTagName('tbody')[0].children.length == 0)
            document.getElementsByTagName('table')[0].innerHTML = "No event created";

        clock = setInterval(function () {
            for (i = 0; i < table.children[1].children.length; i++) {
                child = table.children[1].children[i].children[4]
                const d = new Date();
                ch = child.innerText
                sec = Date.parse(ch) / 1000 - d.getTime() / 1000;
                if(table.children[1].children[i].children[6].innerText.startsWith('R') ||
                table.children[1].children[i].children[6].innerText.startsWith('S') ||
                table.children[1].children[i].children[6].innerText.startsWith('F'))
                {
                    table.children[1].children[i].children[5].innerText="";
                    childa = table.children[1].children[i].children[1].innerText
                    second = Date.parse(childa) / 1000 - d.getTime() / 1000;
                    timeLeft = Math.floor(second / 60 / 60 / 24) + ' days ' + Math.floor(second / 60 / 60 % 24) + ' hours ' + Math.floor(second / 60 % 60 % 60) + ' minutes ' + Math.floor(second % 60 % 60 % 60) + ' seconds'
                    if(second<=0)
                    {
                        table.children[1].children[i].children[7].innerText = ''
                        table.children[1].children[i].children[6].innerText = 'Started';
                        table.children[1].children[i].children[8].children[0].innerText='Play';
                        childb = table.children[1].children[i].children[2].innerText                         
                        const ndate=new Date(Date.parse(childa)+childb*60*1000)
                        mins=ndate/1000-d.getTime()/1000
                        <?php if(@$_GET['st']!=1) { ?>
                        started();
                        <?php } ?>
                        if(mins<=0)
                        {
                            table.children[1].children[i].children[6].innerText = 'Finished';
                        table.children[1].children[i].children[9].innerText="";
                        <?php if(@$_GET['st2']!=1) 
                        {
                        ?>
                        finished();
                        <?php } ?>
                        }
                        else
                        {
                        RemTime=Math.floor((mins)/60)+' minutes '+Math.floor((mins)%60)+' seconds'
                        table.children[1].children[i].children[9].innerText = RemTime
                        count++
                        }
                    }
                    else
                    table.children[1].children[i].children[7].innerText = timeLeft
                    continue;
                }
                else if (Math.floor(sec <= 0)) {
                    table.children[1].children[i].children[6].innerText = 'expired';
                    table.children[1].children[i].children[5].innerText="0 days 0 hours 0 minutes 0 seconds";
                    <?php if(@$_GET['st3']!=1)
                    {
                    ?>
                    expired();
                    <?php } ?>             
                }
                else
                {
                time = Math.floor(sec / 60 / 60 / 24) + ' days ' + Math.floor(sec / 60 / 60 % 24) + ' hours ' + Math.floor(sec / 60 % 60 % 60) + ' minutes ' + Math.floor(sec % 60 % 60 % 60) + ' seconds'
                table.children[1].children[i].children[5].innerText = time
                }
                
            }
        }, 1000)

    </script>
    <?php
    if(@$_GET['statCode']==1)
    {
        
        $sel="select * from registered_candidates ORDER BY Id DESC LIMIT 1";
        $data = mysqli_query($conn, $sel);
        $rec=mysqli_fetch_array($data);
        echo $rec[0]." ".$rec[1]." ".$rec[2];
        $upd1="update registered_candidates set status='Registered' where candidate_email='$rec[2]'";
        mysqli_query($conn,$upd1);
        $from ="jaspreet9322@gmail.com";
$to=$rec[2];
// echo $_SESSION['email'];
$headers="From:" .$from;
$subject="Event Registration";
$message= "Dear $rec[1] You have been successfully registered in $rec[3] event";
if(mail($to,$subject,$message,$headers)) {
 echo "mail sent successfully";   
}
else 
echo("mail send failed");
    }
    ?>
</body>
</html>