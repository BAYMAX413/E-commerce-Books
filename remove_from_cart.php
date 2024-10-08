<?php
$servername = "localhost";
$username = "root"; // replace with your database username
$password = ""; // replace with your database password
$dbname = "bookstore";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    
    // Remove the item from the cart
    $delete_sql = "DELETE FROM cart WHERE id = $cart_id";
    $conn->query($delete_sql);
}

$conn->close();

header("Location: index.php");
exit();
?>
