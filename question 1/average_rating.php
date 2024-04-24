<?php
$serverName = "localhost";
$username = "ank";
$password = "abcd1234";
$dbName = "movie_db";
$conn = mysqli_connect($serverName, $username, $password, $dbName);

$query = "SELECT AVG(rating) AS AvgRating FROM movies";
$countQuery = "SELECT COUNT(rating) AS numOfRating FROM movies";
$result = mysqli_query($conn, $query);
$countResult = mysqli_query($conn, $countQuery);

if (($row = mysqli_fetch_assoc($result)) && ($newRow = mysqli_fetch_assoc($countResult))) {
    echo "Average Rating of " . $newRow['numOfRating'] . " movies is: " . $row['AvgRating'];
} else {
    echo "No movies found.";
}

$menuPath = 'index.html';

echo "<br><br><button onclick=\"window.location.href= '$menuPath'\">Go To Menu</button>";
mysqli_close($conn);
?>
