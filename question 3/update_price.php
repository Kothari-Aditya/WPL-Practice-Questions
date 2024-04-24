<!DOCTYPE html>
<html>
<head>
    <title></title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <h1>Update Price</h1>
        <form action="update_price.php" method="POST">
            <label>Book ISBN:</label>
            <input type="text" name="isbn" required>
            <label>New Price:</label>
            <input type="text" name="price" required>
            <button type="submit">Update Price</button>
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
    $price = $_POST['price'];

    $query = "UPDATE books SET price = '$price' WHERE isbn = $isbn";
    $result = mysqli_query($conn, $query);

    if ($result) {
        echo "Price updated successfully.";
    } else {
        echo "Error updating price: " . mysqli_error($conn);
    }
}

mysqli_close($conn);
?>
