<?php 
    session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Welcome</title>
<link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Welcome <?php echo $_SESSION['username']; ?></h1>
        <form action="welcome.php" method="POST">
            <div class="form-group">
                <label for="city">Select a city:</label>
                <select id="city" name="city" required>
                    <option value="city1">City 1</option>
                    <option value="city2">City 2</option>
                    <option value="city3">City 3</option>
                    <option value="city4">City 4</option>
                    <option value="city5">City 5</option>
                    <!-- Add more options as needed -->
                </select>
            </div>
            <div class="form-group">
                <label for="area">Choose an area:</label>
                <input type="text" id="area" name="area" required>
            </div>
            <div class="form-group">
                <label for="budget">Specify your budget:</label>
                <input type="number" id="budget" name="budget" min="0" step="100" required>
            </div>
            <button onclick="window.location.href='welcome.php'" class="btn-submit">Search Accommodations</button>
        </form>
        <br>
        <a href="logout.php" class="btn-submit">Logout</a>
    </div>
</body>
</html>

<?php 
    $serverName = "localhost";
    $username = "ank";
    $password = "abcd1234";
    $dbName = "real_estate_db";
    $conn = mysqli_connect($serverName, $username, $password, $dbName);

    if (!$conn) {
        die("Connection failed: " . mysqli_connect_error());
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Retrieve form data
        $city = $_POST['city'];
        $area = $_POST['area'];
        $budget = $_POST['budget'];
    
        // Construct SQL query to fetch accommodations based on user's criteria
        $query = "SELECT * FROM accommodations WHERE city = '$city' AND area = '$area' AND price <= $budget";
    
        // Execute the query
        $result = mysqli_query($conn, $query);
    
        if ($result) {
            // Check if any accommodations were found
            if (mysqli_num_rows($result) > 0) {
                while ($row = mysqli_fetch_assoc($result)) {
                    echo "City: " . $row['city'] . "<br>";
                    echo "Area: " . $row['area'] . "<br>";
                    echo "Type: " . $row['type'] . "<br>";
                    echo "Price: " . $row['price'] . "<br><br>";
                }
            } else {
                echo "No accommodations found.";
            }
        } else {
            // Display error message if query execution fails
            echo "Error executing query: " . mysqli_error($conn);
        }
    }


    mysqli_close($conn);

?>

