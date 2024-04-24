<?php
$serverName = "localhost";
$username = "ank";
$password = "abcd1234";
$dbName = "movie_db";
$conn = mysqli_connect($serverName, $username, $password, $dbName);
$query = "SELECT * FROM movies ORDER BY release_year ASC";
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
    echo "No movies found.";
}

$menuPath = 'index.html';

echo "<br><br><button onclick=\"window.location.href= '$menuPath'\">Go To Menu</button>";
mysqli_close($conn);
?>
