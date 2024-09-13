<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>About Us - Quiz Project</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://kit.fontawesome.com/e526f264d5.js" crossorigin="anonymous"></script>
</head>
<body>

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
                        <a class="nav-link active" href="contact.php">Contact <i class="fa-solid fa-address-card"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <div class="container my-5">
        <h1 class="text-center">About Us</h1>
        <p class="lead text-center">Learn more about the Quiz Project and the team behind it.</p>
        
        <div class="row my-4">
            <div class="col-md-6">
                <h2>Our Mission</h2>
                <p>Our mission is to create an engaging and educational platform where users can test their knowledge on a variety of subjects. We believe that learning should be fun and accessible to everyone, and our quiz app is designed with that in mind.</p>
            </div>
            <div class="col-md-6">
                <img src="./images/mission.jpeg" height="200px"  alt="Our Mission">
                </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6 order-md-2">
                <h2>Our Team</h2>
                <p>We are a group of passionate developers, designers, and educators who came together to build this quiz platform. Our diverse backgrounds and expertise allow us to create a well-rounded and user-friendly application.</p>
            </div>
            <div class="col-md-6 order-md-1">
                <img src="./images/team2.png" height="200px"  alt="Our Team">
            </div>
        </div>

        <div class="row my-4">
            <div class="col-md-6">
                <h2>Our Vision</h2>
                <p>We envision a world where knowledge is easily accessible, and everyone has the opportunity to learn and grow. Our platform is just the beginning, and we are constantly working to improve and expand our offerings.</p>
            </div>
            <div class="col-md-6">
                <img src="./images/vision.jpeg" height="200px"  alt="Our Vision">
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
