<!-- <?php
session_start();
if (isset($_COOKIE['username']))
{
    if (isset($_SESSION["em"]))
    header("location:dashboard.php");
}
?>  -->
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <title>Document</title>
    <style>
         .carousel {
            margin-top: 0%;
        }
        ul {
            list-style-type: none;
        }
        body {
            padding:0px;
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-sm navbar-light bg-dark px-3 ">
        <img src="./images/quiz.webp" width="60px" height="60px" alt="" class="rounded-circle me-3">
        <a class="navbar-brand text-info" href="#">Quiz World</a>
        <button
            class="navbar-toggler d-lg-none"
            type="button"
            data-bs-toggle="collapse"
            data-bs-target="#collapsibleNavId"
            aria-controls="collapsibleNavId"
            aria-expanded="false"
            aria-label="Toggle navigation"
        ></button>
        <div class="collapse navbar-collapse" id="collapsibleNavId">
            <ul class="navbar-nav me-auto mt-2 mt-lg-0">
                <li class="nav-item px-2">
                    <a class="nav-link active text-info" href="signup.php" aria-current="page"
                        >Home <i class="fa-solid fa-house"></i><span class="visually-hidden"></span></a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link active text-info" href="adminLogin.php">Admin <i class="fa-solid fa-user-tie"></i></a>
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link active text-info" href="about.php">About Us <i class="fa-solid fa-address-card"></i></a>
                </li>
            </ul>
            <div class=" navbar-nav d-flex my-2 my-lg-0">
                <li class="nav-item px-2">
                    <a class="nav-link active text-info" href="userLogin.php">Login <i class="fa-solid fa-right-to-bracket"></i></a>                    
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link active text-info" href="register.php">SignUp <i class="fa-solid fa-user-plus"></i></a>                    
                </li>
                <li class="nav-item px-2">
                    <a class="nav-link active text-info" href="contact.php">Contact Us <i class="fa-solid fa-phone"></i></a>                    
                </li>
            </div>
        </div>
    </nav>
    <div class="carousel slide carousel-fade" data-bs-ride="carousel" id="myCar">
        <ul class="carousel-indicators">
            <li data-bs-target="#myCar" data-bs-slide-to="0" class="active"></li>
            <li data-bs-target="#myCar" data-bs-slide-to="1"></li>
            <li data-bs-target="#myCar" data-bs-slide-to="2"></li>
        </ul>
        <div class="carousel-inner">
            <div style="margin-top:1.5%;" class="carousel-item active" data-bs-interval="3000"><img src="./images/quiz_pmg.png" style="height:300px;" alt="" class="d-block w-100"></div>
            <div class="carousel-item" data-bs-interval="3000"><img src="./images/quiz_frame.jpg" style="height:300px;" class="d-block w-100"></div>
            <div class="carousel-item" data-bs-interval="3000"><img src="./images/quiz_sign.avif" style="height:300px;" class="d-block w-100"></div>
        </div>
    </div>
    <h1 class="text-center display-1 text-info mt-4">Let's Quiz</h1>
    <p class="display-4 text-center">Test your skills and become a master</p>
    <p class="text-center" style="font-size:18px;">We organize quizes on various topics.</p>
    <p class="text-center" style="font-size:18px;">Sign up if you have'nt already and get access to variety of quizes on the topic of your interest.</p>
    <p class="text-center" style="font-size:14px;"><b>Start your journey here</b></p>
    <div class="text-center">
        <a href="./register.php"class="btn btn-lg btn-info text-white"><i class="fa-solid fa-user-plus" style="color: #ffffff;"></i> Sign Up</a>
        <a href="./userlogin.php"class="btn btn-lg btn-success text-white ms-1"><i class="fa-solid fa-right-to-bracket" style="color: #ffffff;"></i> Login</a>
    </div>
    <div class="footer container-fluid text-white mt-5 p-2">
    <div class="row bg-dark justify-content-center py-3">
    <p class="text-center text-warning" style="font-size:30px;font-family:'sans-serif';">Quiz World</p>
    <div class= col-3 offset-1>
    <p>DESCRIPTION</p>
    <span class=text-secondary>This webpage allow individual to take interest in mind sport in which players attempt to answer correctly on one or several specific topics.It can be used as brief assessment in education and similar fields to measure growth in knowledge and skills.</span>
    </div>
    <div class="col-3 offset-1" >
    <p>CONTACT INFORMATION</p>
    <span class=text-secondary>jaspreet9322@gmail.com<br>+91 95186-36525<br>135001, Yamunanagar, Haryana INDIA</span>
    </div>
    <div class="col-3 offset-1" >
    <p>ABOUT US</p>
    <div class=text-secondary list-group>
    <a class=list-group-item list-group-item-action>Terms and Conditions</a>
    <a class=list-group-item list-group-item-action>Privacy Policy</a>
    </div>
    <p class=mt-2>Register for Free <button class="btn btn-danger rounded-pill ms-3">SIGN UP</button></p>
    </div>
    </div>
    <div class='row'>
    <div style="background:black;" class="col text-light text-center p-2"><small>This site is intended for all visitors.Copyright 2024 All rights reserved</small></div>
    </div>
    </div>
</body>
</html>