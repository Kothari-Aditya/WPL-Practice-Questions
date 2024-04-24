<!DOCTYPE html>
<html>
<head>
    <title>Search Movies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Search Books</h1>
        <form action="search_book.php" method="POST">
            <label>Search by ISBN:</label>
            <input type="text" name="isbn" required>
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
$dbName = "bookstore_db";
$conn = mysqli_connect($serverName, $username, $password, $dbName);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $isbn = $_POST['isbn'];
    $query = "SELECT * FROM books WHERE isbn = '$isbn'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "ISBN: ". $row["isbn"] . "<br>";
            echo "Title: " . $row['title'] . "<br>";
            echo "Author: " . $row['author'] . "<br>";
            echo "Genre: " . $row['genre'] . "<br>";
            echo "Price: " . $row['price'] . "<br>";
        }
    } else {
        echo "No movies found for the specified year.";
    }
}

mysqli_close($conn);
?>