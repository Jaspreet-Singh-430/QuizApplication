<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .change-container {
            max-width: 400px;
            margin: 50px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <?php
    include("connection.php");
    if (isset($_POST['submit'])) {
        $em = $_POST['email'];
        $pass1 = $_POST['pass1'];
        $pass2 = $_POST['pass2'];
        if ($pass1 == $pass2) {
            $upd = "update participants set Password='$pass1' where Email='$em'";
            mysqli_query($conn, $upd);
            $sel="select * from loggedin_users where Email='$em'";
            $data=mysqli_query($conn, $sel);
            if(mysqli_num_rows($data)!=0) {
            $upd2="update loggedin_users set Password='$pass1' where Email='$em'";
            mysqli_query($conn, $upd2);
            }
            header("location:userLogin.php?flag=1");
        } else
            $err = "Passwords does not match. Try again";
    }
    ?>
    <div class="container">
        <div class="change-container">
            <h3 class="text-center">Change Password</h3>
            <form action="forgot.php" method="post">
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" class="form-control" id="email" placeholder="Enter the Email" readonly
                        name="email" value="<?php echo $_COOKIE['username']; ?>">
                </div>
                <div class="form-group">
                    <label for="pass1">Enter New Password</label>
                    <input type="text" class="form-control" id="otp1" placeholder="Enter new password" name="pass1">
                </div>
                <div class="form-group">
                    <label for="pass2">Confirm Password</label>
                    <input type="text" class="form-control" id="pass2" placeholder="Confirm password" name="pass2">
                </div>
                <span class=text-danger><?php if (!isset($err))
                    echo " ";
                else
                    echo $err; ?></span><br>
                <button type="submit" class="btn btn-primary btn-block" name='submit'>Change</button>
            </form>
        </div>
    </div>
</body>

</html>