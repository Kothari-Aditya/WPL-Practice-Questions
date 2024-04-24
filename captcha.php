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

// Handle CAPTCHA regeneration
if (isset($_POST['regenerate'])) {
    $_SESSION['captcha'] = generateRandomString();
    // Return the new CAPTCHA text
    echo $_SESSION['captcha'];
    exit();
}

// Validate user input against the CAPTCHA string
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $userInput = isset($_POST['captcha_input']) ? $_POST['captcha_input'] : '';
    $userInput = trim($userInput);

    if (isset($_SESSION['captcha']) && !empty($_SESSION['captcha'])) {
        $captchaString = $_SESSION['captcha'];
        if (preg_match('/^[a-zA-Z0-9]{6}$/', $userInput) && strtolower($userInput) == strtolower($captchaString)) {
            $validationMessage = "CAPTCHA validation successful!";
        } else {
            $validationMessage = "CAPTCHA validation failed!";
        }
    } else {
        $validationMessage = "CAPTCHA session data not set!";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>CAPTCHA Form</title>
    <script>
        function regenerateCaptcha() {
            // Create an AJAX object
            var xhttp = new XMLHttpRequest();
            // Define the function to handle the response
            xhttp.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    // Update the CAPTCHA text
                    document.getElementById("captcha_text").textContent = this.responseText;
                }
            };
            // Send an AJAX request to regenerate CAPTCHA
            xhttp.open("POST", "<?php echo $_SERVER['PHP_SELF']; ?>", true);
            xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhttp.send("regenerate=1");
        }
    </script>
</head>
<body>
    <h1>CAPTCHA Form</h1>
    <p id="captcha_text">CAPTCHA: <?php echo isset($_SESSION['captcha']) ? $_SESSION['captcha'] : ''; ?></p>
    <?php if (isset($validationMessage)) : ?>
        <p><?php echo $validationMessage; ?></p>
    <?php endif; ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="POST">
        <label for="captcha_input">Enter CAPTCHA:</label>
        <input type="text" id="captcha_input" name="captcha_input" required>
        <button type="submit">Submit</button>
    </form>
    <button onclick="regenerateCaptcha()">Regenerate CAPTCHA</button>
</body>
</html>


