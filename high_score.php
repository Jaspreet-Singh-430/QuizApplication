<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
    <script src="./jquery/dist/jquery.min.js"></script>
    <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
    <title>Document</title>
</head>
<body>
<nav class="bg-warning p-3 fs-3 text-white"><img src="./images/score.png" alt="" width="7%" height="7%"><b>High Score</b></nav>
<div class="text-center mt-5">
    <img src="./images/high.avif" alt="" height="200px" width="200px">
<h3 class="display-3">Your Overall high score is</h3>
<h5 class="display-5"><b><?php echo $_SESSION['score'];?></b></h5>
</div>
</body>
</html>