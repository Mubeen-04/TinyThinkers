<?php
// session_start();

// Redirect if the user is already logged in
// if (isset($_SESSION["user"])) {
//     header("Location: /index.php");
//     exit();
// }

// Function to display an alert message
function showAlert($message, $type = 'danger') {
    echo "<div class='alert alert-$type'>$message</div>";
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>LOGIN</title>
    <link rel="stylesheet" href="./login.css">
</head>

<body>
    <div class="container">
        <div class="photo"></div>
        <div class="content">
            <div class="card">
                <section>
                    <header>
                        <h1>LOGIN</h1>
                    </header>
                </section>
                <hr>
                <section>
                    <main class="main">
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-item">
                                <input type="email" id="email" name="email" placeholder="Email" autocomplete="off" required>
                            </div>
                            <div class="form-item">
                                <input type="password" id="password" name="password" placeholder="Password" autocomplete="off" required>
                            </div>
                            <div class="login-button">
                                <input type="submit" name="login" value="Continue">
                            </div>
                        </form>
                        
                    </main>
                </section>
                <section>
                    <div class="create-account">
                        <p>Don't have an Account? <a href="/sign up/signup.php">Create Account</a></p>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <?php
// Start session
session_start();

// Database configuration
$servername = "localhost";
$username = "root";
$password = "";
$database = "login_register";

// Establish database connection
$conn = new mysqli($servername, $username, $password, $database);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle login form submission
if (isset($_POST["login"])) {
    $email = $_POST["email"];
    $password = $_POST["password"];

    // Prepare and execute the SQL query
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result && $result->num_rows > 0) {
        $user = $result->fetch_assoc();
        if (password_verify($password, $user["password"])) {
            // Store user's email in session
            $_SESSION["email"] = $user["email"];
            // Redirect to index.php or any other page
            header("Location: /index.php");
            exit();
        } else {
            echo "Password does not match.";
        }
    } else {
        echo "Email does not exist.";
    }
}

// Close database connection
$conn->close();
?>


    

</body>

</html>
