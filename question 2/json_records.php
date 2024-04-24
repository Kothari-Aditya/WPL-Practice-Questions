<?php
$serverName = "localhost";
$username = "ank";
$password = "abcd1234";
$dbName = "movie_db";
$conn = mysqli_connect($serverName, $username, $password, $dbName);

$query = "SELECT * FROM movies";
$result = mysqli_query($conn, $query);

$rows = array();
if (mysqli_num_rows($result) > 0) {
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }
}


mysqli_close($conn);

// Convert array to JSON format
$jsonData = json_encode($rows);

// Set the appropriate header for JSON output
header('Content-Type: application/json');

// Output JSON data
echo $jsonData;
?>
