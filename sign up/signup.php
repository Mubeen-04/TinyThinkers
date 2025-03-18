<?php
session_start();
if (isset($_SESSION["user"])) {
    header("Location: /index.php");
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIGNUP</title>
    <link rel="stylesheet" href="signup.css">
    <script>
        // Function to hide the alert after 3 seconds
        // JavaScript to show and hide the alert after a delay
        document.addEventListener('DOMContentLoaded', function() {
            var alert = document.querySelector('.alert');
            if (alert) {
                alert.classList.add('show'); // Show the alert
                setTimeout(function() {
                    alert.classList.remove('show'); // Hide the alert after 3 seconds
                }, 3000);
            }
        });
    </script>
</head>

<body>
    <div class="container">
        <div class="content">
            <div class="card">
                <section>
                    <header>
                        <h1>
                            SIGN UP
                        </h1>
                    </header>
                    <hr>
                    <section>
                        <main class="main">
                            <div>
                                <p>
                                    REGISTER WITH YOUR EMAIL
                                </p>
                            </div>
                            <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                                <div class="form-item">
                                    <input type="text" id="fullname" name="fullname" placeholder="Full Name" autocomplete="off">
                                </div>
                                <div class="form-item">
                                    <input type="email" id="email" name="email" placeholder="Email" autocomplete="off">
                                </div>
                                <div class="form-item">
                                    <input type="password" id="password" name="password" placeholder="Password" autocomplete="off">
                                </div>
                                <div class="form-item">
                                    <input type="password" id="repeat_password" name="repeat_password" placeholder="Repeat Password" autocomplete="off">
                                </div>
                                <div class="checkbox">
                                    <div class="terms-and-Conditions">
                                        <input type="checkbox" id="terms-and-Conditions" name="terms-and-Conditions">
                                        <label for="terms-and-Conditions">I have Agree to All <a href="/terms.html">Terms and
                                                Conditions</a></label>
                                    </div>
                                </div>
                                <div class="login-button">
                                    <input type="submit" name="submit" value="Continue">
                                </div>
                            </form>
                        </main>
                    </section>

                    <section>
                        <footer>
                            <div class="login">
                                <p>Already have an Account? <a href="/login/login.php">Login</a></p>
                            </div>
                        </footer>
                    </section>
                </section>
            </div>
        </div>
        <div class="photo">
            <img src="/sign up/images/sinup.png" alt="Photo">
        </div>
    </div>
    </div>
    <?php


    if (isset($_SESSION['status'])) {
    ?>
        <div class="alert alert-warning alert-dismissible fade show" role="alert">
            <strong>Hey!</strong> <?= $_SESSION['status']; ?>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    <?php
        unset($_SESSION['status']);
    }
    ?>


    <?php
    // Error reporting
    error_reporting(E_ALL);
    ini_set('display_errors', 1);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["submit"])) {
            $fullName = $_POST["fullname"];
            $email = $_POST["email"];
            $password = $_POST["password"];
            $passwordRepeat = $_POST["repeat_password"];

            $passwordHash = password_hash($password, PASSWORD_DEFAULT);

            $errors = array();

            if (empty($fullName) || empty($email) || empty($password) || empty($passwordRepeat)) {
                array_push($errors, "All fields are required");
            }
            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                array_push($errors, "Email is not valid");
            }
            if (strlen($password) < 8) {
                array_push($errors, "Password must be at least 8 characters long");
            }
            if ($password !== $passwordRepeat) {
                array_push($errors, "Password does not match");
            }
            if (!isset($_POST["terms-and-Conditions"])) {
                array_push($errors, "You must agree to the Terms and Conditions");
            }

            require_once "database.php";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $errors = array();

                // Assuming $email, $fullName, and $passwordHash are properly sanitized and assigned before this point

                $sql = "SELECT * FROM users WHERE email = '$email'";
                $result = mysqli_query($conn, $sql);
                if (!$result) {
                    die("Query failed: " . mysqli_error($conn));
                }
                $rowCount = mysqli_num_rows($result);
                if ($rowCount > 0) {
                    array_push($errors, "Email already exists!");
                }
                if (count($errors) > 0) {
                    echo "<div class='alert alert-danger'>"; // Start error messages container
                    foreach ($errors as  $error) {
                        echo "<p>$error</p>"; // Display each error message
                    }
                    echo "</div>"; // End error messages container
                } else {
                    $sql = "INSERT INTO users (full_name, email, password) VALUES (?, ?, ?)";
                    $stmt = mysqli_stmt_init($conn);
                    if (!$stmt) {
                        die("Statement preparation failed: " . mysqli_error($conn));
                    }
                    $prepareStmt = mysqli_stmt_prepare($stmt, $sql);
                    if ($prepareStmt) {
                        mysqli_stmt_bind_param($stmt, "sss", $fullName, $email, $passwordHash);
                        $executeStmt = mysqli_stmt_execute($stmt);
                        if (!$executeStmt) {
                            die("Statement execution failed: " . mysqli_error($conn));
                        }
                        $_SESSION['email'] = $email;
                        // Redirect to index.php after successful registration
                        header("Location: /index.php");
                        exit(); // Ensure that no other output is sent
                    } else {
                        die("Statement preparation failed: " . mysqli_error($conn));
                    }
                }
            }
        }
    }
    ?>

</body>

</html>