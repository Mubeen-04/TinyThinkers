<?php

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "image_upload_db";

ini_set('upload_max_filesize', '10M');
ini_set('post_max_size', '12M');

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle image upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES["image"])) {
    // Get email from the form
    $email = $_POST['email'];

    // Validate email if needed

    $target_dir = "upload-images/";
    $target_file = $target_dir . basename($_FILES["image"]["name"]);
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));

    // Check if image file is a actual image or fake image
    $check = getimagesize($_FILES["image"]["tmp_name"]);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check if file already exists
    if (file_exists($target_file)) {
        echo "Sorry, file already exists.";
        $uploadOk = 0;
    }

    // Check file size (12MB)
    if ($_FILES["image"]["size"] > 12 * 1024 * 1024) {
        echo "Sorry, your file is too large. Maximum size allowed: 12MB.";
        $uploadOk = 0;
    }

    // Allow certain file formats
    $allowedFormats = ["jpg", "jpeg", "png", "gif"];
    if (!in_array($imageFileType, $allowedFormats)) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "<div style='color: red;'>Sorry, there was an error uploading your file.</div>";
        // Refresh the page after 2 seconds
        echo "<meta http-equiv='refresh' content='2;url=image-dropzone.php'>";
    } else {
        // Attempt to upload the file
        if (move_uploaded_file($_FILES["image"]["tmp_name"], $target_file)) {
            // Insert image details into database
            $filename = basename($_FILES["image"]["name"]);
            $path = "upload-images/" . $filename; // Update the path for the uploaded file
            
            // Prepare SQL statement to insert image details including the user's email
            $sql = "INSERT INTO images (filename, path, user_email) VALUES ('$filename', '$path', '$email')";

            // Check if the SQL query executed successfully
            if ($conn->query($sql) === TRUE) {
                echo "<div style='color: green;'>The file " . htmlspecialchars($filename) . " has been uploaded successfully.</div>";
                // Refresh the page after 2 seconds
                echo "<meta http-equiv='refresh' content='2;url=image-dropzone.php'>";
                exit(); // Stop further execution
            } else {
                // If inserting into the database fails, delete the uploaded file
                unlink($target_file); // Delete the uploaded file
                echo "<div style='color: red;'>Error: Unable to insert image details into database.</div>";
                // Refresh the page after 2 seconds
                echo "<meta http-equiv='refresh' content='2;url=image-dropzone.php'>";
            }
        } else {
            echo "<div style='color: red;'>Sorry, there was an error uploading your file.</div>";
            // Refresh the page after 2 seconds
            echo "<meta http-equiv='refresh' content='2;url=image-dropzone.php'>";
        }
    }
}

$conn->close();
?>
