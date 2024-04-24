<!DOCTYPE html>
<html>
<head>
    <title>Add Movie</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Add Movie</h1>
        <form action="add_movie.php" method="POST">
            <label>Title:</label>
            <input type="text" name="title" required>
            <label>Director:</label>
            <input type="text" name="director" required>
            <label>Genre:</label>
            <input type="text" name="genre" required>
            <label>Release Year:</label>
            <input type="date" name="release_year" required>
            <label>Rating:</label>
            <input type="number" name="rating" min="1" max="10" step="0.1" required>
            <button type="submit">Add Movie</button>
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
    $title = $_POST['title'];
    $director = $_POST['director'];
    $genre = $_POST['genre'];
    $release_year = $_POST['release_year'];
    $rating = $_POST['rating'];

    $query = "INSERT INTO movies (title, director, genre, release_year, rating) VALUES ('$title', '$director', '$genre', '$release_year', $rating)";
    $result = mysqli_query($conn, $query);

    if ($result) { // can also be written as conn->query($query) === true
        echo "Movie added successfully.";
    } else {
        echo "Error adding movie: " . mysqli_error($conn);
    }
}



mysqli_close($conn);
?>

