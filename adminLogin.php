<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
    <style>
        body {
            background-image:linear-gradient(to right,red,blue);
        }
        h3 {
            font-family:tahoma;
            margin-bottom:15px;
        }
        form {
            background:black;
            margin:auto;
            color:white;
            border-radius:10px;
            margin:10% 35%;
            text-align:center;
            padding:3%;
        }
        input {
            border-radius:20px;
            height:25px;
            margin-bottom:15px;
        }
        p {
            font-size:13px;
            color:rgb(201, 188, 188);
        }
        #err {
            color:red;
            font-size:16px;
        }
    </style>
</head>
<body>
    <form action="checkAdmin.php" method="POST" autocomplete="off">
        <h3>ADMIN LOGIN</h3>
        <p>please enter your login id and password</p>
        <label for="">Username: </label>
        <input type="text" name='adminUser'><br>
        <label for="">Password: </label>
        <input type="text" name='adminPwd'><br>
        <button class="btn btn-success rounded-4" type="submit">Login</button>
        <p id='err'><?php echo @$_GET['mess'];?></p>
    </form>
</body>
</html>