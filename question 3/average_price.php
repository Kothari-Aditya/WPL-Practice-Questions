<?php
$serverName = "localhost";
$username = "ank";
$password = "abcd1234";
$dbName = "bookstore_db";
$conn = mysqli_connect($serverName, $username, $password, $dbName);

$query = "SELECT AVG(price) AS AvgPrice FROM books";
$countQuery = "SELECT COUNT(price) AS numOfRecords FROM books";
$result = mysqli_query($conn, $query);
$countResult = mysqli_query($conn, $countQuery);

if (($row = mysqli_fetch_assoc($result)) && ($newRow = mysqli_fetch_assoc($countResult))) {
    echo "Average Rating of " . $newRow['numOfRecords'] . " movies is: " . $row['AvgPrice'];
} else {
    echo "No books found.";
}

$menuPath = 'index.html';

echo "<br><br><button onclick=\"window.location.href= '$menuPath'\">Go To Menu</button>";
mysqli_close($conn);
?>
