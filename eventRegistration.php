<?php
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Responsive Registration Form</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <style>
        /* Basic CSS Reset */
        <?php
        session_start();
        if (@$_GET['stat'] != 'expired' && @$_GET['stat'] != 'Started') {
            ?>
            * {
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }

            body {
                font-family: 'Roboto', sans-serif;
                background-color: #f7f7f7;
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .container {
                width: 100%;
                max-width: 500px;
                padding: 20px;
                background-color: #ffffff;
                border-radius: 8px;
                box-shadow: 0 0 15px rgba(0, 0, 0, 0.1);
            }

            .registration-form {
                display: flex;
                flex-direction: column;
            }

            .registration-form h2 {
                margin-bottom: 20px;
                text-align: center;
                color: #333;
            }

            .form-group {
                margin-bottom: 15px;
                display: flex;
                flex-direction: column;
            }

            .form-group label {
                margin-bottom: 5px;
                color: #555;
            }

            .form-group input {
                padding: 10px;
                border: 1px solid #ccc;
                border-radius: 4px;
                font-size: 16px;
                transition: border-color 0.3s ease;
            }

            .form-group input:focus {
                border-color: #007bff;
                outline: none;
            }

            button {
                padding: 12px;
                border: none;
                border-radius: 4px;
                background-color: #007bff;
                color: #ffffff;
                font-size: 16px;
                cursor: pointer;
                transition: background-color 0.3s ease;
                margin-top: 10px;
            }

            button:hover {
                background-color: #0056b3;
            }

            /* Responsive Styles */
            @media (max-width: 768px) {
                .container {
                    padding: 15px;
                }

                .form-group label,
                .form-group input,
                button {
                    font-size: 14px;
                }
            }

            @media (max-width: 480px) {
                .container {
                    padding: 10px;
                }

                .form-group label,
                .form-group input,
                button {
                    font-size: 12px;
                }
            }

            p {
                text-align: center;
            }

            <?php
        } else if(@$_GET['stat']!='Started') {
            ?>
            /* Reset some default styles */
            body,
            h1,
            p {
                margin: 0;
                padding: 0;
            }

            /* Style the body */
            body {
                font-family: Arial, sans-serif;
                display: flex;
                align-items: center;
                justify-content: center;
                height: 100vh;
                background-color: #f0f0f0;
            }

            /* Container to hold the content */
            .container {
                background-color: white;
                padding: 30px;
                border-radius: 10px;
                box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
                text-align: center;
                max-width: 400px;
                width: 100%;
            }

            /* Styling the heading */
            h1 {
                color: #e63946;
                font-size: 2em;
                margin-bottom: 20px;
            }

            /* Styling the paragraph */
            p {
                color: #333;
                font-size: 1.2em;
                margin-bottom: 10px;
            }

            /* Make the page responsive */
            @media (max-width: 600px) {
                .container {
                    padding: 20px;
                }

                h1 {
                    font-size: 1.5em;
                }

                p {
                    font-size: 1em;
                }
            }

            <?php
        }
        ?>
    </style>
</head>

<body>
    <?php
    
    if ($_GET['stat'] == 'Unregistered') {
        $em=$_SESSION['em'];
        $username=$_SESSION['user'];
        $name=$_GET['name'];
        include("connection.php");
        $ins2="insert into registered_candidates values('','$username','$em','$name','unregistered')";
        mysqli_query($conn, $ins2);
        if (isset($_POST["submit"])) {
            $em = @$_POST['email'];
            $userId = @$_POST['userId'];
            $phn = @$_POST['phn'];
            $sel = "select * from participants where Email='$em' AND userID='$userId' AND Contact='$phn'";
            $data = mysqli_query($conn, $sel);
            if (mysqli_num_rows($data) == 0) {
                $err = "<br>You are not registered. <a href='register.php'>Click here to create your account</a>";
            } else {
            }
        }
        ?>
        <div class="container">
            <form class="registration-form" action="./checkout/start.php" method="post">
                <h2>Registration Form for <?php echo @$_GET['name']; ?></h2>
                <div class="form-group">
                    <label for="fulname">Fullname</label>
                    <input type="text" id="fulname" name="fname" value="<?php echo $_COOKIE['fullname'];?>" required>
                </div>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" value="<?php echo $_COOKIE['usermail'];?>" required>
                </div>

                <div class="form-group">
                    <label for="userId">User ID</label>
                    <input type="number" id="userId" name="userId" placeholder="enter user ID" required>

                </div>
                <div class="form-group">
                    <label for="orderId">Order ID</label>
                    <input type="text" id="orderId" name="orderId" readonly value="<?php echo @$_GET['order'];?>" required>

                </div>
                <div class="form-group">
                    <label for="userId">Phone Number</label>
                    <input type="number" id="phn" name="phn" placeholder="enter phone number" required>

                </div>
                <div class="form-group">
                    <label for="cname">Contest Name</label>
                    <input type="text" id="cname" name="cname" readonly value="<?php echo @$_GET['name'];
                    ?>" required>
                <?php
                $_SESSION['event']=@$_GET['name'];
                ?>
                </div>
                <div class="form-group">
                    <label for="pay">Payment Amount</label>
                    <input type="number" id="pay" name="pay" readonly value="<?php echo @$_GET['fee']; ?>" required>

                </div>
                <button type="submit" name="submit">Proceed to Pay</button>
            </form>
            <p><?php echo @$err; ?></p>
        </div>
        <?php
    } else if (@$_GET['stat'] == 'expired') {
        ?>
            <div class="container">
                <div class="content">
                    <h1>Registration Closed</h1>
                    <p>We're sorry, but registration for this event is now closed.</p>
                    <p>Thank you for your interest!</p>
                </div>
            </div>
        <?php
    } else if(@$_GET['stat']=='Registered') {
        ?>
            <!DOCTYPE html>
            <html lang="en">

            <head>
                <meta charset="UTF-8">
                <meta name="viewport" content="width=device-width, initial-scale=1.0">
                <title>Registration Success</title>
                <style>
                    body {
                        font-family: Arial, sans-serif;
                        background-color: #f4f4f4;
                        display: flex;
                        justify-content: center;
                        align-items: center;
                        height: 100vh;
                        margin: 0;
                    }

                    .success-container {
                        background-color: #fff;
                        padding: 20px;
                        border-radius: 8px;
                        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
                        text-align: center;
                    }

                    .success-container h1 {
                        color: #4CAF50;
                        font-size: 24px;
                        margin-bottom: 10px;
                    }

                    .success-container p {
                        color: #333;
                        font-size: 16px;
                        margin: 0;
                    }
                </style>
            </head>

            <body>
                <div class="success-container">
                    <h1>Registration Successful!</h1>
                    <img src="./images/R.png" alt="" width="100px" height="100px"><br><br>
                    <p>You have successfully registered.</p>
                </div>
            </body>

            </html>
        <?php
    }
    else if (@$_GET['stat']=='Started') {
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Start Game</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container my-5">
        <img src="./images/contest.png" class='mx-auto d-block'alt="" width="50%">
        <h1 class="display-4" style="text-align:center;">Welcome to the Event!</h1>
        <p class="lead mx-auto" style="text-align:center;">Test your knowledge and score big.</p>
        <hr class="my-4">
        <form class="bg-secondary p-4 rounded-2" action="mainevent.php" method="post" id="play">
        <div class="form-group">
            <label class='form-label text-white' for="">Enter Name:</label>
            <input type="text" class="form-control" name="cname">
         </div>
         <div class="form-group">
         <label for="" class="text-white">Enter Email:</label>
         <input type="email" class="form-control" name="cmail">
         </div>       
         <input type="text" name="event_name"  value="<?php echo $_GET['name'];?>">
         <?php
         $orderId=$_GET['order'];
         $sel3="select Time_limit from event where order_id='$orderId' LIMIT 1";
         $data=mysqli_query($conn,$sel3);
         $row3=mysqli_fetch_array($data);
         ?>
         <input type="text" name="limit" value="<?php echo $row3[0];?>">
        </form>
        <br>
        <p style="text-align:center;">Click the button below to start the contest.</p>
        <button type="submit" class="btn btn-primary btn-lg mx-auto d-block" name='sub' form="play">Start Game</button>
        <p style="color:red;"><?php echo @$_GET['err'];?></p>
        </div>

    <!-- Bootstrap JS (optional) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

    <?php
    }
    else if(@$_GET['stat']=='finished')
    {
    ?>
    <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contest Unavailable</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <div class="alert alert-danger text-center" role="alert">
            <h4 class="alert-heading">Contest Unavailable</h4>
            <p>We're sorry, but this contest is no longer available. Please check back later for new contests.</p>
            <hr>
            <p class="mb-0">Thank you for your understanding.</p>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
    <?php
    }
    ?>
</body>

</html>