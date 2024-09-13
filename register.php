<?php
session_start();
include("connection.php");
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <title>Document</title>
  <style>
    label {
      font-weight: bold;
    }

    form {
      margin: 0% 20%;
      background: white;
      padding: 1%;
      box-shadow: 3px 3px 30px 5px grey;
    }
    @media screen and (max-width:768px)
    {
      form {
        width:100%;
        margin:0%;
      }
    }

    /* body {
            background:black;
            color:white;
        } */
  </style>
</head>

<body>
  <?php
  $regex = '/^[A-Za-z]*$/';
  $pattern = '/^\d{10}$/';
  $pattern2 = '/^\d/';
  $pattern3 = '/[A-Z]/';
  $pattern4 = '/[a-z]/';
  $pattern5 = '/\W/';
  if (isset($_POST['sub'])) {
    $email = @$_POST['email'];
    $fname = @$_POST['fname'];
    $lname = @$_POST['lname'];
    $pwd = @$_POST['pwd'];
    $cont = @$_POST['cont'];
    $capt = @$_POST['capt'];
    $captHid = @$_POST['captHid'];
    if (isset($fname)) {
      if ($fname == '')
        $fnameErr = "firstname required";
      else if (!preg_match($regex, $fname))
        $fnameErr = 'name should contain only alphabets';
      else
        $fnameErr = '';
    }
    if (isset($lname)) {
      if ($lname == '')
        $lnameErr = "lastname required";
      else if (!preg_match($regex, $lname))
        $lnameErr = 'name should contain only alphabets';
      else
        $lnameErr = '';
    }
    if (isset($cont)) {
      if ($cont == '')
        $contErr = "phone required";
      else if (!preg_match($pattern, $cont))
        $contErr = "phone no. is not valid number of digits must be 10 ";
      else
        $contErr = '';
    }
    if (isset($email)) {
      if ($email == '')
        $emailErr = "email required";
      else if (!filter_var($email, FILTER_VALIDATE_EMAIL) || preg_match($pattern2, $email))
        $emailErr = "Invalid email format";
      else
        $emailErr = '';
    }
    if (isset($pwd)) {
      if (empty($pwd))
        $pwdErr = "Password is Required *<br>";
      else if (strlen($pwd) < 8)
        $pwdErr = "Your password must contain atleast 8 characters";
      else if (!preg_match($pattern3, $pwd))
        $pwdErr = "Your password must contain atleast 1 Capital letter";
      else if (!preg_match($pattern4, $pwd))
        $pwdErr = "Your password must contain atleast 1 Lowercase letter";
      else if (!preg_match($pattern5, $pwd))
        $pwdErr = "Your password must contain atleast 1 special character";
      else
        $pwdErr = '';
    }
    if (isset($capt)) {
      if ($capt == '')
        $captErr = "please enter captcha";
      else if ($capt != $captHid)
        $captErr = "Captcha is not matching";
      else
        $captErr = '';
    }
  }
  ?>

  <div class="container mt-3">
    <h2 class="text-center">User Registration</h2><br>
    <form action="./register.php" class="rounded-1 mb-5" method="post" name=f1>
      <div class="mb-3 mt-3">
        <label for="fname">Firstname:</label>
        <input type="text" class="form-control" id="fname" placeholder="Enter firstname" name="fname">
        <p style="color:red;font-size:12px;"><?php echo @$fnameErr; ?></p>
      </div>
      <div class="mb-3">
        <label for="lname">Lastname:</label>
        <input type="text" class="form-control" id="lname" placeholder="Enter Lastname" name="lname">
        <p style="color:red;font-size:12px;"><?php echo @$lnameErr; ?></p>
      </div>
      <div class="mb-3">
        <label for="email">Email:</label>
        <input type="text" class="form-control" id="email" placeholder="Enter email" name="email">
        <p style="color:red;font-size:12px;"><?php echo @$emailErr; ?></p>
      </div>
      <div class="mb-3">
        <label for="pwd">Password:</label>
        <input type="password" class="form-control" id="pwd" placeholder="Enter password" name="pwd">
        <p style="color:red;font-size:12px;"><?php echo @$pwdErr; ?></p>
      </div>
      <div class="mb-3">
        <label for="cont">Contact:</label>
        <input type="number" class="form-control" id="cont" placeholder="Enter Phone number" name="cont">
        <p style="color:red;font-size:12px;"><?php echo @$contErr; ?></p>
      </div>
      <div class="mb-3">
        <label for="cont">Captcha: </label>&nbsp;&nbsp;
        <b>
          <p style="display:inline;" id="captcha" class="bg-warning px-3 py-1"></p>
        </b>
        <input type="text" hidden id="captHid" name="captHid">
        <input type="text" class="form-control mt-2" id="capt" placeholder="Enter Captcha" name="capt" maxlength="5">
        <p style="color:red;font-size:12px;"><?php echo @$captErr; ?></p>
      </div>
      <div class="text-center">
        <button class="btn btn-primary btn-lg" type="submit" id='sub' name='sub'>Submit</button>
        <!-- Modal trigger button -->
        <button id='but' type="button" class="btn btn-primary btn-lg invisible" data-bs-toggle="modal"
          data-bs-target="#modalId">
          Launch
        </button>
      </div>
      <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false"
        role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalTitleId">
                First Step Completed
              </h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body"><img src="./images/check.png" width=50% height=50%
                style="display:block;margin:auto;" alt=""><span>For security reason we have sent an One Time
                Password(OTP) to your email. Kindly check your email and use the provided OTP to log in.Note the OTP
                will expire after 5 minutes.</span></div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-bs-dismiss="modal" id="close">
                Next
              </button>
            </div>
          </div>
        </div>
      </div>
    </form>
    <?php
    if (isset($_POST['sub'])) {
    if ($fnameErr == '' && $lnameErr == '' && $emailErr == '' && $pwdErr == '' && $captErr == '') {
      $sel = "select * from Participants where Email='$email' OR Password='$pwd'";
      $res = mysqli_query($conn, $sel);
      if (mysqli_num_rows($res) == 0) {
        echo "<script>
        close=document.getElementById('close');
  if(close.classList.contains('reject'))
  {
  close.classList.remove('reject');
  close.innerHTML='Next';
  but=document.getElementById('but')
  but.click();
  }
  </script>";
      } else {
        echo "<script>
    close=document.getElementById('close');
    if(!close.classList.contains('reject'))
    {
    close.classList.add('reject');
    close.innerHTML='Close';
   }
    document.getElementsByClassName('modal-title')[0].innerHTML='Registration Rejected'
    document.getElementsByClassName('modal-body')[0].children[0].src='./images/cross.jpg'
    document.getElementsByClassName('modal-body')[0].children[1].textContent='The email you are trying to register with is already associated to any other account. Please try a valid and non replicating email.'
    but=document.getElementById('but')
    but.click();
    </script>";
      }
    }
  }
    ?>
  </div>
  <script>
    var close = document.getElementById("close")
    close.onclick = function () {
      if (close.classList.contains('reject') == false) {
        console.log(close.classList.contains('reject'))
        location.href = "otp_ver.php"
      }
    }  
  </script>
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
  <?php
  if (isset($_POST['sub'])) {
    if ($emailErr == '' && $contErr == '' && $pwdErr == '' && $fnameErr == '' && $lnameErr == '') {
      $_SESSION['email'] = $email;
      $_SESSION['pwd'] = $pwd;
      $_SESSION['fname'] = $fname;
      $_SESSION['lname'] = $lname;
      $_SESSION['cont'] = $cont;
      $sel = "select * from Participants where Email='$email' OR Password='$pwd'";
      $res = mysqli_query($conn, $sel);
      if (mysqli_num_rows($res) == 0) {
        echo "<script>
        but=document.getElementById('but');
  if(close.classList.contains('reject'))
  close.classList.remove('reject');
  close.innerHTML='Next';
  but.click()</script>";
      } else {
        echo
          "<script>
    close=document.getElementById('close')
    if(!close.classList.contains('reject'))
    close.classList.add('reject');
    close.innerHTML='Close';
    document.getElementsByClassName('modal-title')[0].innerHTML='Registration Rejected'
    document.getElementsByClassName('modal-body')[0].children[0].src='./images/cross.jpg'
    document.getElementsByClassName('modal-body')[0].children[1].textContent='The email you are trying to register with is already associated to any other account. Please try a valid and non replicating email.'
    but.click()
    </script>";
      }
    }
  }
  ?>

</body>

</html>