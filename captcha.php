<?php
session_start();

// Generate a random string for the CAPTCHA
function generateRandomString($length = 6) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $randomString;
}

// Create a random CAPTCHA string and store it in session
if (!isset($_SESSION['captcha'])) {
    $_SESSION['captcha'] = generateRandomString();
}

// Validate user input against the CAPTCHA string
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = isset($_POST['captcha_input']) ? $_POST['captcha_input'] : '';
    $userInput = trim($userInput);

    if (isset($_SESSION['captcha']) && !empty($_SESSION['captcha'])) {
        $captchaString = $_SESSION['captcha'];
        if (strtolower($userInput) == strtolower($captchaString)) {
            $_SESSION['message'] = "CAPTCHA validation successful!";
        } else {
            $_SESSION['message'] = "CAPTCHA validation failed!";
        }
    } else {
        $_SESSION['message'] = "CAPTCHA session data not set!";
    }

    // Regenerate CAPTCHA after form submission
    $_SESSION['captcha'] = generateRandomString();
    // Redirect to refresh the page
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CAPTCHA Form</title>
</head>
<body>
    <h1>CAPTCHA Form</h1>
    <?php if (isset($_SESSION['message'])) : ?>
        <p><?php echo $_SESSION['message']; ?></p>
        <?php unset($_SESSION['message']); ?>
    <?php endif; ?>
    <p>CAPTCHA: <?php echo isset($_SESSION['captcha']) ? $_SESSION['captcha'] : ''; ?></p>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="captcha_input">Enter CAPTCHA:</label>
        <input type="text" id="captcha_input" name="captcha_input" required>
        <button type="submit">Submit</button>
    </form>
</body>
</html>
