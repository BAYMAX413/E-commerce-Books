<?php
session_start();
include("db.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['fname'];
    $lastname = $_POST['lname'];
    $Gender = $_POST['gender'];
    $num = $_POST['number'];
    $address = $_POST['add'];
    $gmail = $_POST['mail'];
    $password = $_POST['pass'];

    // Basic validation
    if (!empty($gmail) && !empty($password) && !is_numeric($gmail)) {
        // Directly using user input in SQL query (not recommended)
        $query = "INSERT INTO form (fname, lname, gender, cnum, address, email, pass) VALUES ('$firstname', '$lastname', '$Gender', '$num', '$address', '$gmail', '$password')";

        // Execute the query
        if (mysqli_query($conn, $query)) {
            echo "<script type='text/javascript'> alert('Successfully Registered'); </script>";
        } else {
            echo "<script type='text/javascript'> alert('Registration Failed: " . mysqli_error($conn) . "'); </script>";
        }
    } else {
        echo "<script type='text/javascript'> alert('Enter Valid Information'); </script>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Login and Register</title>
    <link rel="stylesheet" href="./style.css">
</head>
<body>
    <div class="signup">
        <h1>Sign Up</h1>
        <h4>It's free and only takes a minute</h4>
        <form action="" method="POST">
            <label for="First_name">First Name</label>
            <input type="text" name="fname" id="First_name" required>
            <label for="Last_name">Last Name</label>
            <input type="text" name="lname" id="Last_name" required>
            <label for="Gender">Gender</label>
            <input type="text" name="gender" id="Gender" required>
            <label for="Contact_address">Contact Address</label>
            <input type="tel" name="number" id="Contact_address" required>
            <label for="Address">Address</label>
            <input type="text" name="add" id="Address" required>
            <label for="Email">Email</label>
            <input type="email" name="mail" id="Email" required>
            <label for="Password">Password</label>
            <input type="password" name="pass" id="Password">
            <input type="submit" name="" value="Submit">
        </form>
        <p>
            By clicking the Sign Up button, you agree to our <br>
            <a href="">Terms and Conditions</a> and <a href="">Privacy Policy</a>
        </p>
        <p>Already have an Account? <a href="./login.php">Login Here</a></p>
    </div>
</body>
</html>