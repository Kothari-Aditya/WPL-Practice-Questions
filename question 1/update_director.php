<!DOCTYPE html>
<html>
<head>
    <title>Update Director</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Director</h1>
        <form action="update_director.php" method="POST">
            <label>Movie ID:</label>
            <input type="text" name="id" required>
            <label>New Director:</label>
            <input type="text" name="director" required>
            <button type="submit">Update Director</button>
        </form>
        <br><br><button onclick="window.location.href= 'index.html'">Go To Menu</button>
    </div>
</body>
</html>

<?php
$serverName = "localhost";
$username = "ank";
$password = "abcd1234";
$dbName = "movie_db";
$conn = mysqli_connect($serverName, $username, $password, $dbName);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id = $_POST['id'];
    $director = $_POST['director'];

    $query = "UPDATE movies SET Director = '$director' WHERE ID = $id";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Director updated successfully.";
    } else {
        echo "Error updating director: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
