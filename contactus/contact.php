<?php
// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$database = "contact_form_db";

// Create connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Define variables to hold success and error messages
$success_message = "";
$error_message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Collect form data
    $name = $_POST['name'] ?? ''; // Using null coalescing operator
    $email = $_POST['email'] ?? '';
    $message = $_POST['message'] ?? '';
    
    // Prepare and execute SQL statement to insert data into the table
    $sql = "INSERT INTO form_submissions (name, email, message) VALUES ('$name', '$email', '$message')";
    
    if ($conn->query($sql) === TRUE) {
        // Set success message
        $success_message = "Your message has been submitted successfully. We will get back to you shortly.";
    } else {
        // Set error message
        $error_message = "Oops! Something went wrong. Please try again later.";
    }
    
    // Close connection
    $conn->close();
}
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact us</title>
    <link rel="stylesheet" href="style.css">
</head>

<body>
<form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
<!-- Display success message -->
<?php if (!empty($success_message)) { ?>
        <div class="success-message"><?php echo $success_message; ?></div>
    <?php } ?>

    <!-- Display error message -->
    <?php if (!empty($error_message)) { ?>
        <div class="error-message"><?php echo $error_message; ?></div>
    <?php } ?>


    <div class="container">
        <div class="slider-container">
            <div class="slider">
                <div class="list">
                    <div class="item">
                        <video autoplay muted loop>
                            <source src="new.mp4" type="video/mp4">
                            Your browser does not support the video tag.
                        </video>
                    </div>
                </div>
                
            </div>
            </div>
        

        <div class="content-container">
            <div class="content">

                <div class="card">
                    <section>
                        <header>
                            <h1>
                                Contact us
                            </h1>
                        </header>
                    </section>
                    <hr>
                    <section>
                        <main class="main">
                            <form action=""></form>
                            <div class="form-item">
                                <label for="name"></label>
                                <input type="text" id="email" name="email" placeholder="Name" autocomplete="ofF">
                            </div>
                            <div class="form-item">
                                <label for="email"></label>
                                <input type="email" id="password" name="email" placeholder="Email" autocomplete="off">
                            </div>
                            <div class="form-item">
                                <label for="message"></label>
                                <textarea type="message" id="message" name="message" placeholder="Message"
                                    rows="4"></textarea>
                            </div>




                            
                        </main>
                        
                    </section>
                    
                    
                    <div class="login-button">
                        <input type="submit" value="Submit">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        // Function to remove messages after 3 seconds
        setTimeout(function() {
            document.querySelectorAll('.success-message, .error-message').forEach(function(message) {
                message.style.display = 'none';
            });
        }, 2000);
    </script>
</body>

</html>