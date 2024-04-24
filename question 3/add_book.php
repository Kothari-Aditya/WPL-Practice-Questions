<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Book</h1>
        <form action="add_book.php" method="POST">
            <label>ISBN:</label>
            <input type="text" name="isbn" required>
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>author:</label>
            <input type="text" name="author" required>
            <br>
            <label>Genre:</label>
            <input type="text" name="genre" required>
            <label>Price:</label>
            <input type="text" name="price" required>
            <button type="submit">Add Book</button>
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
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];

    $query = "INSERT INTO books (isbn, title, author, genre, price) VALUES ('$isbn', '$title', '$author', '$genre', '$price')";
    $result = mysqli_query($conn, $query);

    if ($result) { // can also be written as conn->query($query) === true
        echo "Movie added successfully.";
    } else {
        echo "Error adding movie: " . mysqli_error($conn);
    }
}



mysqli_close($conn);
?>

