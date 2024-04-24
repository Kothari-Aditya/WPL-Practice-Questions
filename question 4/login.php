<?php 
    session_start();
    // Connect to the database
    $servername = "localhost";
    $username = "ank";
    $password = "abcd1234";
    $dbname = "food_bridge";

    $conn = new mysqli($servername, $username, $password, $dbname);
    $loginStatus = false;
    $showErrorAlert = false;
    $isAdmin = false;

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Get the form data
        $username = $_POST["username"];
        $password = $_POST["password"];
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        $sql = "SELECT * FROM users WHERE username='$username'";
        $result = mysqli_query($conn, $sql);
        $num = mysqli_num_rows($result);

        if ($num == 1) {
            while($row = mysqli_fetch_assoc($result)){
                if (password_verify($password, $row['password'])){
                    $loginStatus = true;
                    $_SESSION['loggedIn'] = true;
                    $_SESSION['username'] = $username;
                    $_SESSION['email'] = $email;

                    // check if the user is admin 
                    if($row['user_type'] == 'admin'){
                        $_SESSION['isAdmin'] = true;
                        $isAdmin = true;
                    }
                    header('location: welcome.php');
                } else {
                    $showErrorAlert = "Invalid Credentials";
                }
            }
        } else {
            $showErrorAlert = "Invalid Credentials";
        }
    }
?>






<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Login Form</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
<?php 
        if(isset($_SESSION['success_message'])){
                echo '<strong>Registration Successful</strong> '. $_SESSION['success_message'];
            }
            unset($_SESSION['success_message']);
    ?>
    <?php 
        if($loginStatus){
                echo '<strong>You are logged in!</strong>';

            }
    ?>
    <?php 
        if($showErrorAlert){
                echo  $showErrorAlert;
            }
    ?>
    <div class="container">
        <h2>Login Form</h2>
        <form action="login.php" method="POST">
            <div class="form-group">
                <label for="username">Username</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <p>Don't Have a account? <a href="registration.php">Register</a></p>
            </div>
            <button type="submit" class="btn-submit">Login</button>
        </form>
    </div>
</body>
</html>
