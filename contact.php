<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us - Quiz Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
    <style>
        label {
            font-weight:bold;
        }
        form {
            background:lightgreen;
            padding:2%;
            border-radius:5px;
        }
    </style>
</head>
<body>
        <?php
        if(isset($_POST["sub"]))
        {
        $from =$_POST['email'];
        $to='jaspreet9322@gmail.com';
        // echo $_SESSION['email'];
        $headers="From:" .$from;
        $subject=$_POST['subject'];
        $user=$_POST['name'];
        $message= "Hi I, $user from this side ".$_POST['message'];
        if(mail($to,$subject,$message,$headers)) {
        echo "<script>document.querySelector('.alert').style.visibility='visible'</script>";   
        }
        else 
        echo("mail send failed");
        }
        ?>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container-fluid">
        <img src="./images/quiz.webp" width="60px" height="60px" alt="" class="rounded-circle me-3">
            <a class="navbar-brand" href="#">Quiz World</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                    <li class="nav-item">
                        <a class="nav-link active" href="signup.php">Home <i class="fa-solid fa-home"></i></a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link active" href="about.php">Contact <i class="fa-solid fa-phone"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-center">Contact Us</h1>
        <p class="lead text-center">Have any questions or feedback? We'd love to hear from you!</p>
        
        <div class="row my-4">
            <div class="col-md-6">
                <h2>Get in Touch</h2>
                <p>If you have any questions, comments, or suggestions, feel free to reach out to us using the form below. We're here to help and always open to feedback to improve our quiz app.</p>
                <p><strong>Email:</strong> jaspreet9322@gmail.com</p>
                <p><strong>Phone:</strong> +91 951-863-6525</p>
                <p><strong>Address:</strong> 123, Sarojini Colony Part-1, Yamunanagar, Haryana, INDIA </p>
            </div>
            <div class="col-md-6">
                <form action="contact.php" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Your Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Enter your name" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Your Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="Enter your email" required>
                    </div>
                    <div class="mb-3">
                        <label for="subject" class="form-label">Subject</label>
                        <input type="text" class="form-control" id="subject" name="subject" placeholder="Enter subject" required>
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Your Message</label>
                        <textarea class="form-control" id="message" name='mesage' rows="5" placeholder="Type your message here..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary" name="sub">Send Message</button>
                </form>
                
                <div class="alert alert-success alert-dismissible mt-3" style="visibility:hidden;"><button type="button" class="btn-close" data-bs-dismiss="alert"></button>Your message is sent.</div>
                
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="text-bg-dark text-center py-4">
        <p class="mb-0">© 2024 Quiz Project. All rights reserved.</p>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
