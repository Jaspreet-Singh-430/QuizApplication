<?php
include("connection.php");
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Edit Profile</title>
  <!-- Bootstrap CSS -->
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
  <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
</head>
<body>
  <div class="container mt-5">
    <h2 style="text-align:center"><i class="fa-solid fa-user"></i>&nbsp;&nbsp;Profile Settings</h2>
    <div class="accordion" id="accordionExample">
      <!-- Accordion Item 1 -->
      <div class="card">
        <div class="card-header" id="headingOne">
          <h2 class="mb-0">
            <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
              View Profile
            </button>
          </h2>
        </div>

        <div id="collapseOne" class="collapse show" aria-labelledby="headingOne" data-parent="#accordionExample">
          <div class="card-body text-center">
           <img src="<?php echo $_SESSION['prof'];?>" class="rounded-circle d-block mx-auto" width="100px" height="100px" alt="">
           <br><p style="font-weight:bold;"><?php echo $_SESSION['em'];?></p>
           <p style="font-weight:bold;"><?php echo $_SESSION['user'];?></p>
           <p style="font-weight:bold;"><?php echo $_SESSION['userL'];?></p>
          </div>
        </div>
      </div>

      <!-- Accordion Item 2 -->
      <div class="card">
        <div class="card-header" id="headingTwo">
          <h2 class="mb-0">
            <button class="btn btn-link collapsed" type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
              Edit Profile
            </button>
          </h2>
        </div>

        <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordionExample">
          <div class="card-body">
          <form action="editProfile.php" method="POST" enctype="multipart/form-data">
      <!-- Name -->
      <div class="form-group">
        <label for="name">First Name</label>
        <input type="text" class="form-control" id="fname" name="fname" placeholder="Enter your firstname" value="<?php echo $_SESSION['user'];?>" required>
      </div>
      <div class="form-group">
        <label for="lname">Last Name</label>
        <input type="text" class="form-control" id="lname" name="lname" placeholder="Enter your lastname" value="<?php echo $_SESSION['userL'];?>" required>
      </div>
      <!-- Email -->
      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" value="<?php echo $_SESSION['em'];?>" required>
      </div>

      <!-- Password -->
      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" class="form-control" id="password" name="password" placeholder="Enter new password (optional)" value="<?php echo $_SESSION['pw'];?>">
      </div>

      <!-- Profile Picture Upload -->
      <div class="form-group">
        <label for="profilePicture">Profile Picture</label>
        <input type="file" class="form-control-file" id="profilePicture" name="profilePicture">
      </div>

      <!-- Submit Button -->
      <button type="submit" class="btn btn-primary">Save Changes</button>
    </form>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <!-- Bootstrap JS and dependencies -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
