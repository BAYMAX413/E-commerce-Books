<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['book_id'])) {
    $book_id = intval($_POST['book_id']);
    
    // Check if the book is already in the cart
    $check_sql = "SELECT * FROM cart WHERE book_id = $book_id";
    $check_result = $conn->query($check_sql);

    if ($check_result->num_rows > 0) {
        // If the book is already in the cart, update the quantity
        $update_sql = "UPDATE cart SET quantity = quantity + 1 WHERE book_id = $book_id";
        $conn->query($update_sql);
    } else {
        // If the book is not in the cart, insert a new record
        $insert_sql = "INSERT INTO cart (book_id, quantity) VALUES ($book_id, 1)";
        $conn->query($insert_sql);
    }
}

$conn->close();

header("Location: index.php");
exit();
?>
