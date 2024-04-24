<?php
session_start();
// Connect to the database
$servername = "localhost";
$username = "ank";
$password = "abcd1234";
$dbname = "real_estate_db";

$conn = new mysqli($servername, $username, $password, $dbname);
$showErrorAlert = false;
$showSuccessAlert = false;
// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the form data
    $username = $_POST["username"];
    $email = $_POST["email"];
    $password = $_POST["password"];
    $confirmPassword = $_POST["confirmPassword"];
    // Hash the password for security
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);
 
    $errors = array();

    // Validate username
    if (empty($username)) {
        $errors[] = "Username is required";
    } elseif (!preg_match('/^[a-zA-Z0-9_]+$/', $username)) {
        $errors[] = "Username can only contain letters, numbers, and underscores";
    }

    
    if (empty($email)) {
        $errors[] = "Email is required";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Invalid email format";
    }

    
    if (empty($password)) {
        $errors[] = "Password is required";
    } elseif (strlen($password) < 8) {
        $errors[] = "Password must be at least 8 characters long";
    } elseif ($password != $confirmPassword) {
        $errors[] = "Passwords do not match";
    }
    
    $existSql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $existSql);
    $num = mysqli_num_rows($result);

    if ($num > 0){
        $errors[] = "Username already exists";
    }

    // Prepare and execute the SQL query
    if(empty($errors)){
        $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$hashed_password')";

        if ($conn->query($sql) === TRUE) {
            $showSuccessAlert = true;
            $_SESSION['success_message'] = "Account Created successfully.";
            header("Refresh: 0, URL=login.php");
            exit();
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        $showErrorAlert = true;
        $_SESSION['error_message'] = "Registration Failed";
        $_SESSION['errors'] = $errors; // Store errors in session
        header("Refresh: 0, URL=registration.php");
        exit();
    }   
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Registration Form</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
        if(isset($_SESSION['success-message'])){
                echo $_SESSION['success-message'];
            }
            unset($_SESSION['success_message']);
    ?>

    <?php 
        if(isset($_SESSION['error_message'])){
                echo $_SESSION['error_message'];

                    
                foreach ($_SESSION['errors'] as $error) { 
                    echo '<li>' . $error . '</li>';
                }

            unset($_SESSION['error_message']);
            unset($_SESSION['errors']); // Clear errors from session
    }
    ?>
    <div class="container">
        <h2>Registration Form</h2>
        <form action="registration.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="confirm-password">Confirm Password</label>
                <input type="password" id="confirmPassword" name="confirmPassword" required>
            </div>
            <div class="form-group">
                <p>Already have an account? <a href="login.php">Login</a></p>
            </div>
            <button type="submit" class="btn-submit">Register</button>
        </form>
    </div>
</body>
</html>
