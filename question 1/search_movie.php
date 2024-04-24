<!DOCTYPE html>
<html>
<head>
    <title>Search Movies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Search Movies</h1>
        <form action="search_movie.php" method="POST">
            <label>Search by Release Year:</label>
            <input type="date" name="year" required>
            <button type="submit">Search</button>
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
    $year = $_POST['year'];
    $query = "SELECT * FROM movies WHERE release_year = '$year'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "Title: " . $row['title'] . "<br>";
            echo "Director: " . $row['director'] . "<br>";
            echo "Genre: " . $row['genre'] . "<br>";
            echo "Release Year: " . $row['release_year'] . "<br>";
            echo "Rating: " . $row['rating'] . "<br><br>";
        }
    } else {
        echo "No movies found for the specified year.";
    }
}

mysqli_close($conn);
?>
