<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Directory where the uploaded files will be saved
    $target_dir = "uploads/";
    // Create the uploads directory if it doesn't exist
    if (!is_dir($target_dir)) {
        mkdir($target_dir, 0755, true);
    }

    // Target file path
    $target_file = $target_dir . basename($_FILES["file"]["name"]);

    // Get file extension
    $fileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if the file is a PDF
    if ($fileType != "pdf") {
        echo "Sorry, only PDF files are allowed.";
        exit;
    }

    // Check for upload errors
    if ($_FILES["file"]["error"] !== UPLOAD_ERR_OK) {
        echo "An error occurred during the file upload.";
        exit;
    }

    // Move the file to the target directory
    if (move_uploaded_file($_FILES["file"]["tmp_name"], $target_file)) {
        echo "The file " . htmlspecialchars(basename($_FILES["file"]["name"])) . " has been uploaded.";
    } else {
        echo "Sorry, there was an error uploading your file.";
    }
} else {
    echo "Invalid request.";
}
