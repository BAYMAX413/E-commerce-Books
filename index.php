<?php
// Database connection parameters
$DB_HOST = 'localhost';  // Replace with your host
$DB_USER = 'root';       // Replace with your database username
$DB_PASS = '';           // Replace with your database password
$DB_NAME = 'bookstore';  // Replace with your database name

// Create a database connection
$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Handle adding to cart
if (isset($_POST['add_to_cart'])) {
    $book_id = $_POST['book_id'];

    // Check if the book is already in the cart
    $check_cart_sql = "SELECT * FROM cart WHERE book_id = $book_id";
    $result = $conn->query($check_cart_sql);
    
    if ($result->num_rows > 0) {
        // If book is already in the cart, increment the quantity
        $update_cart_sql = "UPDATE cart SET quantity = quantity + 1 WHERE book_id = $book_id";
        $conn->query($update_cart_sql);
    } else {
        // If book is not in the cart, add it with quantity 1
        $add_cart_sql = "INSERT INTO cart (book_id, quantity) VALUES ($book_id, 1)";
        $conn->query($add_cart_sql);
    }
}

// Handle removing from cart
if (isset($_POST['remove_from_cart'])) {
    $cart_id = $_POST['cart_id'];
    
    // Remove the book from the cart
    $remove_cart_sql = "DELETE FROM cart WHERE id = $cart_id";
    $conn->query($remove_cart_sql);
}

// Fetch books from the database including image path
$books_sql = "SELECT * FROM books";
$books_result = $conn->query($books_sql);

// Fetch cart items from the database
$cart_sql = "SELECT cart.id as cart_id, books.title, books.author, books.price, cart.quantity
             FROM cart
             JOIN books ON cart.book_id = books.id";
$cart_result = $conn->query($cart_sql);

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Book Store</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        #logOut{
            font-size: large; 
            text-decoration: none; 
            border: 1px solid darkslategray; 
            border-radius: 5px; 
            font-weight: bolder;
            color:darkcyan;
            background-color: white;
        }
        #logOut:hover{
            color:white;
            background-color: darkcyan;
        }
        .container{
            background-color:linen;
        }
    </style>
</head>
<body>
    <div class="container" style=" border-radius:10px;">
    <h1 style="text-align: center; font-family:'Times New Roman', Times, serif">WELCOME USER</h1>
    <div style="text-align: right;">
    <a href="./login.php" style="padding: 10px;" id="logOut">Log Out</a>
    </div><br><br>
        <h1 style="font-family: 'Times New Roman', Times, serif;">Book Store</h1>
        <div class="grid">
            <?php if ($books_result->num_rows > 0): ?>
                <?php while ($book = $books_result->fetch_assoc()): ?>
                    <div class="book-card">
                        <!-- Display the book image or a placeholder if not available -->
                        <img src="<?php echo htmlspecialchars($book['image_path'] ? $book['image_path'] : 'images/placeholder.svg'); ?>" alt="<?php echo htmlspecialchars($book['title']); ?>">
                        <div class="details">
                            <h3><?php echo htmlspecialchars($book['title']); ?></h3>
                            <p><?php echo htmlspecialchars($book['author']); ?></p>
                            <p class="price">$<?php echo htmlspecialchars($book['price']); ?></p>
                            <form method="post" action="">
                                <input type="hidden" name="book_id" value="<?php echo $book['id']; ?>">
                                <button type="submit" name="add_to_cart" <?php echo !$book['in_stock'] ? 'disabled' : ''; ?>>
                                    Add to Cart
                                </button>
                            </form>
                        </div>
                    </div>
                <?php endwhile; ?>
            <?php else: ?>
                <p>No books available.</p>
            <?php endif; ?>
        </div>

        <div class="cart-section">
            <h2>Cart</h2>
            <?php if ($cart_result->num_rows > 0): ?>
                <ul>
                    <?php while ($cart_item = $cart_result->fetch_assoc()): ?>
                        <li class="cart-item">
                            <span class="info">
                                <h3><?php echo htmlspecialchars($cart_item['title']); ?> by <?php echo htmlspecialchars($cart_item['author']); ?></h3>
                                <p>$<?php echo htmlspecialchars($cart_item['price']); ?> x <?php echo htmlspecialchars($cart_item['quantity']); ?></p>
                            </span>
                            <form method="post" action="" style="display:inline;">
                                <input type="hidden" name="cart_id" value="<?php echo $cart_item['cart_id']; ?>">
                                <button type="submit" name="remove_from_cart" class="remove-btn">Remove</button>
                            </form>
                        </li>
                    <?php endwhile; ?>
                </ul>
                <a href="checkout.html" class="checkout-btn">Checkout</a>
            <?php else: ?>
                <p>Your cart is empty.</p>
            <?php endif; ?>
        </div>
    </div>
</body>
</html>
