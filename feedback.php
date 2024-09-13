<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form Example</title>
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body>
    <nav class="p-3 fs-3 text-white" style="background:purple;"><i class="fa-solid fa-comments fa-lg me-3"
            style="color: #ffffff;"></i><b>Send a Feedback</b></nav>
    <div class="container mt-5 ">
        <div class="row">
            <div class="col-md-5">
                <img src="./images/feed.png" width="80%" height="80%" alt="">
            </div>
            <div class="col-md-7">
                <h2 class="text-center mb-4">Feedback Form</h2>
                <form action='feedback.php' method='post' class='mx-auto shadow-lg mb-4 rounded-2 text-bg-dark p-3'
                    style="width:100%;">
                    <!-- Name Input -->
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" name='name'
                            placeholder="Enter your full name">
                    </div>

                    <!-- Email Input -->
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name='email' readonly
                            value="<?php echo $_SESSION['em']; ?>">
                    </div>
                    <!-- Password Input -->
                    <!-- Gender Radio Buttons -->
                    <div class="mb-3">
                        <label class="form-label">Quality</label>
                        <div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="quality" id="good" value="good">
                                <label class="form-check-label" for="good">Good</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="quality" id="moderate"
                                    value="moderate">
                                <label class="form-check-label" for="moderate">Moderate</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input class="form-check-input" type="radio" name="quality" id="poor" value="poor">
                                <label class="form-check-label" for="poor">Poor</label>
                            </div>
                        </div>
                    </div>

                    <!-- Country Select -->
                    <div class="mb-3">
                        <label for="star" class="form-label">Rating</label>
                        <select class="form-select" id="star" name="rate">
                            <option value="1">&starf;</option>
                            <option value="2">&starf;&starf;</option>
                            <option value="3">&starf;&starf;&starf;</option>
                            <option value="4">&starf;&starf;&starf;&starf;</option>
                            <option value="5">&starf;&starf;&starf;&starf;&starf;</option>

                            <!-- Add more options as needed -->
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="desc" class="form-label">Description</label>
                        <textarea name="desc" class="form-control"></textarea>
                    </div>
                    <!-- Submit Button -->
                    <button type="submit" name='sub' class="btn btn-warning w-100">Send</button>
                </form>
            </div>

        </div>

    </div>
    <?php
    include("connection.php");
    if (isset($_POST["sub"])) {
        $name = $_POST['name'];
        $email = $_POST['email'];
        $quality = $_POST['quality'];
        $rate = $_POST['rate'];
        $desc = $_POST['desc'];
        $ins = "insert into feedback values('','$name','$email','$quality','$rate','$desc')";
        mysqli_query($conn, $ins);
    }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>