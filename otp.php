<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>OTP Verification</title>
  <link rel="stylesheet" href="./bootstrap-5.3.3-dist/css/bootstrap.min.css">
  <script src="./bootstrap-5.3.3-dist/js/bootstrap.bundle.min.js"></script>
  <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .otp-container {
      max-width: 400px;
      margin: 50px auto;
      padding: 20px;
      border: 1px solid #ccc;
      border-radius: 10px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    span {
      display: block;
      text-align: center;
      margin-block: 2%;
    }

    u,
    a {
      text-decoration: none;
      color: blue;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="otp-container">
      <h3 class="text-center">OTP Verification</h3>
      <form action="otp.php" method="post">
        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" class="form-control" id="email" placeholder="Enter the Email" readonly name="email"
            value="<?php echo $_SESSION['email']; ?>">
        </div>
        <div class="form-group">
          <label for="otp1">Enter OTP</label>
          <input type="text" class="form-control" id="otp1" placeholder="Enter the OTP" name="otp1">
        </div>
        <span class=text-danger id="error"><?php if (!isset($_SESSION['err'])) {
          $_SESSION['err'] = "OTP is not correct. Try again";
          echo " ";
        } else
          echo $_SESSION['err']; ?></span><br>
        <button type="submit" class="btn btn-primary btn-block" name='submit'>Verify</button>
        <span id='span'>OTP will expire in <u id='para'></u></span>
        <span><a href="./otp_ver.php" class="">Resend OTP</a></span>
      </form>
    </div>
    <button id='but' type="button" class="btn btn-primary btn-lg invisible" data-bs-toggle="modal"
      data-bs-target="#modalId">
      Launch
    </button>
    <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog"
      aria-labelledby="modalTitleId" aria-hidden="true">
      <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalTitleId">
              Registration Successful
            </h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body"><img src="./images/check.png" width=60% height=60% style="display:block;margin:auto;"
              alt=""><span class="d-block" style="text-align:center;"><br>You are successfully registered.</span></div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">
              OK
            </button>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php
include("connection.php");
if (@$_GET['a'] == 1)
  echo "<script>span=document.getElementById('span') 
    span.style.color='red'
    span.innerHTML=' Your otp is not valid anymore.Click resend OTP below'
    </script>";
  $otp = @$_POST['otp1'];
  $fname = $_SESSION['fname'];
  $lname = $_SESSION['lname'];
  $email = $_SESSION['email'];
  $pwd = $_SESSION['pwd'];
  $cont = $_SESSION['cont'];
  if ($_SESSION['otp'] == $otp) {
    echo "<script>
        but=document.getElementById('but')
        but.click();
        </script>";
    if (!isset($_COOKIE['username'])) {
      $del = "delete from participants where Email='$email'";
      mysqli_query($conn, $del);
    }
    $ins = "insert into participants values('$fname','$lname','$email','$pwd','$cont','','')";
    mysqli_query($conn, $ins);
    setcookie("usermail", $email, time() + 86400 * 40, "/");
    setcookie("fullname", $fname." ".$lname, time() + 86400 * 40, "/");
    session_destroy();
  } else {
    ;
  }
?>
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js">
  </script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
  <script>
    var close = document.getElementById("close")
    close.onclick = function () {
      location.href = "userLogin.php"
    }
    h = '05';
    s = '00';
    para.textContent = h + " : " + s;
    timer = setInterval(function () {
      if (s == 0) {
        h = h - 1;
        if (h < 10)
          h = "0" + h;
        s = 59;
      }
      else
        s = s - 1;
      if (s < 10)
        s = "0" + s;
      para.textContent = h + " : " + s;
      if (h == 0 && s == 0) {
        clearInterval(timer);
        location.href = "unset.php";
      }
    }, 1000)
  </script>
</body>

</html>
