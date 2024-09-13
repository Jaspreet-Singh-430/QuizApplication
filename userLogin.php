<?php
include("connection.php");
session_start();
?>
<?php
$capt = @$_POST['capt'];
$captHid = @$_POST['captHid'];
if (isset($capt)) {
    if ($capt == '')
        $captErr = "please enter captcha";
    else if ($capt != $captHid)
        $captErr = "Captcha is not matching";
    else {
        $captErr = '';
        if (isset($_POST['sub'])) {

            $em = $_POST['user'];
            $pw = $_POST['pass'];
            $sel1 = "select * from participants where Email='$em'";
            $sel2 = "select * from participants where Password='$pw'";
            $num1 = mysqli_query($conn, $sel1);
            $num2 = mysqli_query($conn, $sel2);
            if (mysqli_num_rows($num1) == 0 && mysqli_num_rows($num2) == 0) {
                $emErr = "Email entered is not correct";
                $pwErr = "Your password is not correct or Invalid password";
            } else if (mysqli_num_rows($num1) == 0) {
                $pwErr = '';
                $emErr = "Email entered is not correct";
            } else if (mysqli_num_rows($num2) == 0) {
                $emErr = '';
                $pwErr = "Your password is not correct or Invalid password";
            } else {
                $_SESSION['em'] = $em;
                $_SESSION['pw'] = $pw;
                $_SESSION['prof'] = './images/demprof.webp';
                $_SESSION['score'] = 0;
                $_SESSION['badge'] = 0;
                $sel = "select * from loggedin_users where email='$em' and Password='$pw'";
                $data = mysqli_query($conn, $sel);
                $selUser = "select Firstname,Lastname from participants where Email='$em'";
                $data1 = mysqli_query($conn, $selUser);
                $rec = mysqli_fetch_array($data1);
                $_SESSION['user'] = $rec[0];
                $_SESSION['userL'] = $rec[1];
                if (mysqli_num_rows($data) == 0) {
                    $ins = "insert into loggedin_users values('','$rec[0]','$em','$pw')";
                    mysqli_query($conn, $ins);
                }
                header("location:dashboard.php");
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            background-color: rgb(133, 133, 133);
        }

        input {
            margin-top: 4px;
            margin-bottom: 10px;
            width: 98.1%;
        }

        div {
            margin: 12% auto;
            width: 40%;
        }

        @media screen and (max-width:892px) {
            div {
                width: 100%;
                margin: 0%;
            }
        }

        form {
            padding: 6% 4%;
            border-radius: 5px;
            background-color: white;
        }

        input[type='submit'] {
            background: blue;
            border: none;
            padding: 3%;
            border-radius: 3px;
        }

        span {
            display: block;
            color: red;
        }

        h4 {
            font-family: tahoma;
            text-align: center;
            color: white;
            font-family: sans-serif;
            font-size: 20px;
        }

        a {
            text-decoration: none;
            /* display:block; */
            color: rgb(36, 120, 247);
        }
    </style>
</head>

<body>
    <div>
        <?php
        if (@$_GET['flag'] == 1)
            echo "<script>alert('Your Password has changed successfully')</script>";
        ?>
        <h4> USER LOGIN FORM</h4>
        <form action="./userLogin.php" method="post">
            <label for="user">Email:</label><br>
            <input type="text" name="user" id="user">
            <span><?php echo @$emErr; ?></span>
            <label for="pass">Password</label><br>
            <input type="password" name="pass" id="pass">
            <span><?php echo @$pwErr; ?></span><?php if (@$pwErr != '')
                  echo "<br>"; ?>
            <label for="cont">Captcha: </label>&nbsp;
            <b>
                <p style="display:inline;background:orange; padding:3px 10px;" id="captcha"></p>
            </b>
            <input type="text" hidden id="captHid" name="captHid">
            <input type="text" class="form-control" id="capt" placeholder="Enter Captcha" name="capt" maxlength="5"
                style="margin-top:10px;">
            <p style="color:red;font-size:12px;"><?php echo @$captErr; ?></p>
            <input type="submit" value='Login' name='sub' style="display:block;color:white;width:100%;">
            <div style="width:100%;margin-top:30px;">
                <span style="color:red;">New Participant?</span><a style="float:left;" href="signup.php">Go to
                    registration page</a>
                <a style="float:right;" href="forgot.php">Forgot Password?</a>
            </div>
        </form>
    </div>
    <?php
    $seed = str_split('abcdefghijklmnopqrstuvwxyz' . 'ABCDEFGHIJKLMNOPQRSTUVWXYZ' . '0123456789!@#$%^&*()');
    shuffle($seed);
    $rand = '';
    foreach (array_rand($seed, 5) as $i) {
        $rand .= $seed[$i];
    }
    echo "<script>captcha.innerHTML='$rand'
  captHid.value='$rand'
  </script>";
    ?>
</body>

</html>