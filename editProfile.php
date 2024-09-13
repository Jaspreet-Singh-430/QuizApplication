<?php
include("connection.php");
session_start();
$user_id = $_SESSION['em']; // Example
// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Sanitize and get form inputs
    $fname = htmlspecialchars(trim($_POST['fname']));
    $lname = htmlspecialchars(trim($_POST['lname']));
    $email = htmlspecialchars(trim($_POST['email']));
    $password = !empty($_POST['password']) ? password_hash($_POST['password'], PASSWORD_DEFAULT) : null; // Hash new password
    $profilePicture = $_FILES['profilePicture'];

    // File upload logic for profile picture
    if ($profilePicture['name']) {
        $targetDirectory = "uploads/"; // Ensure this folder exists and is writable
        $targetFile = $targetDirectory . basename($profilePicture["name"]);
        $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

        // Validate the file type
        if ($imageFileType === "jpg" || $imageFileType === "jpeg" || $imageFileType === "png" || $imageFileType === "webp" || $imageFileType === "avif") {
            move_uploaded_file($profilePicture["tmp_name"], $targetFile);
            // Update the user's profile picture in the database
            $profilePicturePath = $targetFile;
        } else {
            echo "Invalid file type for profile picture.";
        }
    }

    // SQL query to update user profile in the database (this is a simple example, make sure to adjust for your needs)
    // Assuming you have a database table called 'users'
    $sql = "UPDATE participants SET Firstname = '$fname', Lastname='$lname', Email = '$email',Password='$password',profilePath='$profilePicturePath' WHERE Email = '$user_id'";
    // Execute the query (assuming you have a $db connection)
    if (mysqli_query($conn, $sql)) {
        echo "Profile updated successfully!";
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
    $sql1 = "UPDATE loggedin_users SET Name = '$fname', email='$email', Password = '$password' WHERE email='$user_id'";
    mysqli_query($conn, $sql1);
    $_SESSION['em'] = $email;
    $_SESSION['prof'] = $profilePicturePath;
}
?>