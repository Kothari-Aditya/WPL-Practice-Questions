<!DOCTYPE html>
<html>
<head>
    <title>Search Movies</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Delete Movies</h1>
        <form action="delete_movie.php" method="POST">
            <label>Delete using Movie Id:</label>
            <input type="text" name="id" required>
            <button type="submit">Delete</button>
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
    $query = "SELECT * FROM movies WHERE id = '$id'";
    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            echo "The deleted Movie is: <br>";
            echo "Title: " . $row['title'] . "<br>";
            echo "Director: " . $row['director'] . "<br>";
            echo "Genre: " . $row['genre'] . "<br>";
            echo "Release Year: " . $row['release_year'] . "<br>";
            echo "Rating: " . $row['rating'] . "<br><br>";
        }
        $deleteQuery = "DELETE FROM movies WHERE id = '$id'";
        if(mysqli_query($conn, $deleteQuery)){
            echo "Movie delete succesfully";
        } else {
            echo "Error Delete movie" . mysqli_error($conn);
        }
    } else {
        echo "No movies found for the specified id.";
    }
}

mysqli_close($conn);
?>
